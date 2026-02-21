<?php

declare(strict_types=1);

namespace App\Livewire\Analysis;

use App\Actions\Analysis\GenerateAiPromptAction;
use App\Actions\Application\GenerateAiAlertAction;
use App\Enums\NotificationTypesEnum;
use App\Models\Application;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Ai extends Component
{
    public array $months = [];
    public array $questionnaires = [];

    #[Validate(['required', 'int'])]
    public int $month = 1;

    #[Validate(['required', 'int'])]
    public int $questionnaire_id = 0;

    #[Validate(['nullable', 'string', 'max:1000'])]
    public string $prompt = '';

    public array $prompt_suggestions = [
        '¿Cuál usuario sería el más propenso psicológicamente?',
        '¿Cuál es el mayor foco de riesgo?',
        '¿Recomendación para el mayor problema?',
        '¿Qué acciones legales podría enfrentar la empresa?',
        '¿Qué preguntas generan más alertas?'
    ];

    public function mount(): void
    {
        $this->months = [
            ['value' => 1, 'label' => 'Enero'],
            ['value' => 2, 'label' => 'Febrero'],
            ['value' => 3, 'label' => 'Marzo'],
            ['value' => 4, 'label' => 'Abril'],
            ['value' => 5, 'label' => 'Mayo'],
            ['value' => 6, 'label' => 'Junio'],
            ['value' => 7, 'label' => 'Julio'],
            ['value' => 8, 'label' => 'Agosto'],
            ['value' => 9, 'label' => 'Septiembre'],
            ['value' => 10, 'label' => 'Octubre'],
            ['value' => 11, 'label' => 'Noviembre'],
            ['value' => 12, 'label' => 'Diciembre'],
        ];
        $this->month = Carbon::now()->month;

        $companyId = Auth::user()->company?->id;
        $this->questionnaires = Questionnaire::where(function ($query) use ($companyId) {
            $query->where('is_base', true)
                ->orWhere('company_id', $companyId);
        })->get(['id', 'name', 'description'])->toArray();
    }

    public $ai_result = null;

    public function searchAnalysis(): void
    {
        $this->validate();

        $user = Auth::user();
        $companyId = $user->company?->id;
        if (! $companyId || $this->questionnaire_id === 0) {
            $this->dispatch('toast', message: __('Debe seleccionar un cuestionario y tener una compañía asociada.'), type: NotificationTypesEnum::ERROR->value);
            return;
        }

        $year = now()->year;
        $startOfMonth = now()->setMonth($this->month)->startOfMonth();
        $endOfMonth = now()->setMonth($this->month)->endOfMonth();
        $applications = Application::where('company_id', $companyId)
            ->where('questionnaire_id', $this->questionnaire_id)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        $responses = [];
        foreach ($applications as $app) {
            $app_responses = $app->questionnaireResponses()->where('risk_level', 'red')->get()->toArray();
            $responses = array_merge($responses, $app_responses);
        }

        if(count($responses) === 0) {
            $this->dispatch('toast', message: __('No se encontraron respuestas con alertas para el período seleccionado.'), type: NotificationTypesEnum::WARNING->value);
            $this->ai_result = null;
            return;
        }

        $questionnaire = Questionnaire::find($this->questionnaire_id);
        $questionnaireArr = $questionnaire ? $questionnaire->toArray() : [];

        $promptAction = new GenerateAiPromptAction();
        $prompt = $promptAction->execute($responses, $questionnaireArr, $this->prompt);

        try {
            $aiAction = new GenerateAiAlertAction();
            $aiResponse = $aiAction->execute($prompt);

            session()->put('last_ai_response', $aiResponse);
            if (is_array($aiResponse)) {
                $this->ai_result = $this->formatAiResponse($aiResponse);
            } elseif (is_string($aiResponse)) {
                if (preg_match('/Análisis de Alertas|Conclusión|Pasos a mejorar|Usuarios más propensos|Focos de riesgo|Preguntas que generan más alertas/i', $aiResponse)) {
                    $this->ai_result = '<div class="prose dark:prose-invert">'.nl2br($aiResponse).'</div>';
                } else {
                    $this->ai_result = nl2br(e($aiResponse));
                }
            } else {
                $this->ai_result = __('Respuesta IA inválida');
            }

            Flux::modal('show-questionnaire-analysis-modal')->show();
        } catch (\Throwable $e) {
            $this->ai_result = 'Error al consultar la IA: ' . $e->getMessage();
        }
    }

    private function formatAiResponse(array $data): string
    {
        $out = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $out .= '<strong>' . ucfirst(str_replace('_', ' ', $key)) . ':</strong><ul>';
                foreach ($value as $item) {
                    $out .= '<li>' . (is_array($item) ? json_encode($item, JSON_UNESCAPED_UNICODE) : e($item)) . '</li>';
                }
                $out .= '</ul>';
            } else {
                $out .= '<strong>' . ucfirst(str_replace('_', ' ', $key)) . ':</strong> ' . e($value) . '<br>';
            }
        }
        return $out;
    }

    public function addSuggestion(string $suggestion): void
    {
        if (!str_contains($this->prompt, $suggestion)) {
            $this->prompt = trim($this->prompt . ($this->prompt ? ' ' : '') . $suggestion);
        }
    }

    public function clearAll(): void
    {
        $this->prompt = '';
        $this->month = 1;
        $this->questionnaire_id = 0;
    }

    public function render()
    {
        return view('livewire.analysis.ai');
    }
}
