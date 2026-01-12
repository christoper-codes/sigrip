<?php

namespace App\Livewire\Analysis;

use App\Exports\ApplicationResponsesExport;
use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use Table;

    public array $departments = [];
    public ?array $application_data = [];
    public ?array $applications = [];
    public ?array $questionnaire = [];
    public ?string $application_error = null;
    public bool $search_responses = false;
    public ?array $all_responses = null;
    public ?array $alert_responses = null;
    public ?string $department_analysis = null;
    public ?string $user_analysis = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['nullable', 'int'])]
    public ?int $application = null;

    public function mount(): void
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
    }

    public function searchApplications(): void
    {
        $this->validate();
        $this->applications = Application::where('executing_department_id', $this->department)
            ->orderByDesc('start_date')
            ->get()
            ->toArray();

        Flux::modal('select-application')->show();
    }

    public function resultApplication(): void
    {
        if(! $this->application){
            $this->application_error = __('Por favor, seleccione una aplicación para ver los resultados.');
            return;
        }

        $this->search_responses = true;

        $this->application_data = Application::where('id', $this->application)
            ->with('questionnaireResponses.user')
            ->first()
            ->toArray();

        $this->questionnaire = Questionnaire::where('id', $this->application_data['questionnaire_id'])
            ->first()
            ->toArray();

        $this->table_items = $this->application_data['questionnaire_responses'];
        $this->search_fields = ['user.name', 'uuid'];
        $this->headers = [
            ['label' => __('ID')],
            ['label' => __('Fecha de Respuesta'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Nivel de Riesgo'), 'field' => 'risk_level', 'sortable' => true],
            ['label' => __('Nombre de empleado')],
            ['label' => __('Respuestas')],
            ['label' => __('Alertas')],
            ['label' => __('Promedio')],
            ['label' => __('Ai - departamento')],
            ['label' => __('Ai - empleado')],
        ];
         $this->refreshTableData();

         Flux::modal('select-application')->close();
    }

    public function downloadResults(): BinaryFileResponse
    {
        $export_name =  $this->application_data['slug'] . '_responses.xlsx';
        return Excel::download(new ApplicationResponsesExport($this->application_data['questionnaire_responses']), $export_name);
    }

    public function showResponses(int $response_id): void
    {
        $responses = $this->application_data['questionnaire_responses'][$response_id - 1]['response_data'];
        $themes = $this->questionnaire['metadata']['themes'];

        $grouped = [];
        foreach ($themes as $theme) {
            $theme_questions = [];
            foreach ($theme['questions'] as $q) {
                $user_response = collect($responses)->firstWhere('question_id', $q['id']);
                if (!$user_response) {
                    continue;
                }
                $answer_label = null;
                if (!empty($q['options'])) {
                    foreach ($q['options'] as $option) {
                        if ((string)$option['value'] === (string)$user_response['value']) {
                            $answer_label = $option['label'];
                            break;
                        }
                    }
                }
                $theme_questions[] = [
                    'question' => $q['text'] ?? null,
                    'answer' => $answer_label ?? $user_response['value'],
                ];
            }
            if (count($theme_questions)) {
                $grouped[] = [
                    'theme_name' => $theme['name'] ?? '',
                    'theme_description' => $theme['description'] ?? '',
                    'questions' => $theme_questions,
                ];
            }
        }

        $this->all_responses = $grouped;
        Flux::modal('show-responses-modal')->show();
    }

    public function showAlerts(int $response_id): void
    {
        $this->alert_responses = $this->application_data['questionnaire_responses'][$response_id - 1]['ai_response']['questions_alert'] ?? [];
        Flux::modal('show-alerts-modal')->show();
    }

    public function showAnalysisDepartment(int $response_id): void
    {
        $this->department_analysis = $this->application_data['questionnaire_responses'][$response_id - 1]['ai_response']['recommendation_for_department'] ?? 'No hay análisis disponible para esta respuesta.';
        Flux::modal('show-department-analysis-modal')->show();
    }

    public function showAnalysisUser(int $response_id): void
    {
        $this->user_analysis = $this->application_data['questionnaire_responses'][$response_id - 1]['ai_response']['recommendation_for_user'] ?? 'No hay análisis disponible para esta respuesta.';
        Flux::modal('show-user-analysis-modal')->show();
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
