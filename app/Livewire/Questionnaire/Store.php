<?php

namespace App\Livewire\Questionnaire;

use App\Exports\QuestionnaireTemplateExport;
use App\Imports\QuestionnaireImport;
use App\Models\Questionnaire;
use App\Models\QuestionnaireCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Str;

class Store extends Component
{
    use WithFileUploads;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $subtitle = null;

    #[Validate(['required', 'string'])]
    public ?string $instructions = null;

    #[Validate(['required', 'array'])]
    public ?array $objectives = [''];

    #[Validate(['required', 'array'])]
    public ?array $yellow_risk_evaluation = [
        ['label' => '', 'criteria' => '']
    ];

    #[Validate(['required', 'array'])]
    public ?array $red_risk_evaluation = [
        ['label' => '', 'criteria' => '']
    ];

    #[Validate(['required', 'file', 'mimes:xlsx,csv'])]
    public $questionnaire_file;

    #[Validate(['required', 'integer'])]
    public ?int $questionnaire_category = null;

    public $import_errors = null;
    public ?array $questionnaire_categoires = [];

    public function mount()
    {
        $this->questionnaire_categoires = QuestionnaireCategory::all()->toArray();
    }

    public function submit(): void
    {
        $this->validate();
        if (!$this->questionnaire_file || !$this->questionnaire_file->isValid()) {
            $this->dispatch('toast', message: __('El archivo aún se está subiendo. Por favor, espera a que termine la carga.'), type: 'warning');
            return;
        }
        DB::beginTransaction();
        try {
            $rows = Excel::toArray(new QuestionnaireImport(), $this->questionnaire_file->getRealPath())[0];
            $metadata = $this->buildMetadata($rows);

            Questionnaire::create([
                'questionnaire_category_id' => $this->questionnaire_category,
                'organization_id' => Auth::user()->organization->id,
                'company_id' => Auth::user()->company->id,
                'name' => $this->title,
                'description' => $this->subtitle,
            ]);

            DB::commit();
            $this->dispatch('toast', message: __('El archivo pasó las validaciones correctamente. Se te notificará cuando el proceso termine.'), type: 'success');
            $this->reset();
            $this->import_errors = null;
        } catch (ValidationException $e) {
            DB::rollBack();
            $this->reset(['questionnaire_file']);
            $failure = $e->failures()[0] ?? null;
            if ($failure) {
                $row = $failure->row();
                $identificador = 'Fila ' . $row;
                $error = $failure->errors()[0] ?? $e->getMessage();
                $this->import_errors = __('Error al guardar el cuestionario: ') . $error . " ($identificador)";
                $this->dispatch('toast', message: $this->import_errors, type: 'error');
            } else {
                $this->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
                $this->dispatch('toast', message: $this->import_errors, type: 'error');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->reset(['questionnaire_file']);
            $this->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
            $this->dispatch('toast', message: $this->import_errors, type: 'error');
        }
    }

    public function buildMetadata(array $rows): array
    {
        $themes = [];
        foreach ($rows as $row) {
            $theme = trim($row['tema']);
            $description = trim($row['descripcion']);
            $type = strtolower(trim($row['tipo_de_respuesta']));
            $question = [
                'id' => Str::uuid()->toString(),
                'text' => trim($row['pregunta']),
                'type' => $type,
                'options' => null,
                'month' => $row['mes'] ?? null,
                'week' => $row['semana'] ?? null,
                'is_fixed' => false,
                'critical_values' => null,
                'weight' => $row['peso_de_pregunta'],
            ];

            if ($type === 'select') {
                $opts = preg_split('/\.\s*/', $row['opciones_y_valores'] ?? '', -1, PREG_SPLIT_NO_EMPTY);
                $question['options'] = [];
                foreach ($opts as $opt) {
                    [$value, $label] = explode(':', $opt, 2);
                    $question['options'][] = [
                        'value' => (int)trim($value),
                        'label' => trim($label),
                    ];
                }
                $question['critical_values'] = isset($row['valores_criticos']) && $row['valores_criticos'] !== ''
                    ? array_map('intval', explode(',', str_replace(' ', '', $row['valores_criticos'])))
                    : null;
            }

            $theme_key = $theme . '|' . $description;
            if (!isset($themes[$theme_key])) {
                $themes[$theme_key] = [
                    'name' => $theme,
                    'description' => $description,
                    'questions' => [],
                ];
            }
            $themes[$theme_key]['questions'][] = $question;
        }

        $themes = array_values($themes);

        $risk_evaluation = [
            'green' => [["label" => __("Bienestar alto"), "criteria" => __("promedio mayor o igual a 4.0 y sin respuestas críticas")]],
            'yellow' => $this->yellow_risk_evaluation,
            'red' => $this->red_risk_evaluation,
        ];

        $metadata = [
            'questionnaire_id' => Str::replace(' ', '_', strtolower($this->title)) . '_' . time(),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'instructions' => $this->instructions,
            'objectives' => $this->objectives,
            'themes' => $themes,
            'risk_evaluation' => $risk_evaluation,
        ];

        return $metadata;
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new QuestionnaireTemplateExport(with_data: false), 'neura_questionnaire_template.xlsx');
    }

    public function downloadExample(): BinaryFileResponse
    {
        return Excel::download(new QuestionnaireTemplateExport(with_data: true), 'neura_questionnaire_example.xlsx');
    }

    public function render()
    {
        return view('livewire.questionnaire.store');
    }
}
