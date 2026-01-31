<?php

namespace App\Livewire\Analysis;

use App\Actions\Analysis\CategoryRatingAction;
use App\Actions\Analysis\DomainRatingAction;
use App\Actions\Analysis\FinalScoreAction;
use App\Enums\NomEnum;
use App\Exports\ApplicationResponsesExport;
use App\Exports\ApplicationShowResponsesExport;
use App\Exports\ApplicationShowResponsesNom2Export;
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
    public ?array $domain_rating = null;
    public ?array $category_rating = null;
    public ?string $department_analysis = null;
    public ?string $user_analysis = null;
    public ?array $final_score = null;

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

        $this->application_data['questionnaire_responses'] = collect($this->application_data['questionnaire_responses'])
                ->transform(function ($response) {
                    $final_score = collect($response['response_data'])->sum(fn ($response) => (int) $response['value']);
                    $classification = match (true) {
                        $final_score < 20  => 'Nulo o despreciable',
                        $final_score < 45  => 'Bajo',
                        $final_score < 70  => 'Medio',
                        $final_score < 90  => 'Alto',
                        default            => 'Muy alto',
                    };
                    $response['classification'] = $classification;
                    return $response;
                })->toArray();

        $this->table_items = $this->application_data['questionnaire_responses'];
        $this->search_fields = ['user.name', 'uuid'];
        $this->headers = [
            ['label' => __('ID')],
            ['label' => __('Nivel de Riesgo'), 'field' => 'classification', 'sortable' => true],
            ['label' => __('Nombre de empleado')],
            ['label' => __('Respuestas')],
            ['label' => __('Alertas')],
            ['label' => __('Ai - departamento')],
            ['label' => __('Ai - empleado')],
            ['label' => __('Calificación por Dominio')],
            ['label' => __('Calificación por Categoría')],
            ['label' => __('Calificación Final')],
            ['label' => __('Fecha de Respuesta'), 'field' => 'created_at', 'sortable' => true],
        ];
         $this->refreshTableData();

         Flux::modal('select-application')->close();
    }

    public function downloadResults(): BinaryFileResponse
    {
        $export_name =  $this->application_data['slug'] . '_responses.xlsx';
        return Excel::download(new ApplicationResponsesExport($this->application_data['questionnaire_responses']), $export_name);
    }

    public function downloadResponses(): BinaryFileResponse
    {
        $export_name =  $this->application_data['slug'] . '_detailed_responses.xlsx';
        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            $export_name =  $this->application_data['slug'] . '_guia_referencia_ii_responses.xlsx';
            $this->all_responses = collect($this->all_responses)->transform(function ($theme) {
                $theme['questions'] = collect($theme['questions'])->transform(function ($question) {
                    $item = (int) preg_replace('/\D/', '', $question['id']);
                    $resolve = $this->resolveDomainAndCategory($item);

                    return array_merge($question, [
                        'domain'   => $resolve['domain'],
                        'category' => $resolve['category'],
                    ]);
                })->toArray();

                return $theme;
            })->toArray();

            return Excel::download(new ApplicationShowResponsesNom2Export($this->all_responses), $export_name);
        }


        return Excel::download(new ApplicationShowResponsesExport($this->all_responses), $export_name);
    }

    public function resolveDomainAndCategory(int $item): array
    {
        $domain_map = [
            'Condiciones en el ambiente de trabajo' => [
                'category' => 'Ambiente de trabajo',
                'items' => [1, 2, 3],
            ],
            'Carga de trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [4,5,6,7,8,9,10,11,12,13,42,43,44],
            ],
            'Falta de control sobre el trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [18,19,20,21,22,26,27],
            ],
            'Jornada de trabajo' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [14,15],
            ],
            'Interferencia en la relación trabajo-familia' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [16,17],
            ],
            'Liderazgo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [23,24,25,28,29],
            ],
            'Relaciones en el trabajo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [30,31,32,44,46,47,48],
            ],
            'Violencia' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [33,34,35,36,37,38,39,40],
            ],
        ];

        foreach ($domain_map as $domain => $config) {
            if (in_array($item, $config['items'], true)) {
                return [
                    'domain' => $domain,
                    'category' => $config['category'],
                ];
            }
        }

        return [
            'domain' => null,
            'category' => null,
        ];
    }

    public function showResponses(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];
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
                    'id' => isset($q['id']) ? substr($q['id'], strrpos($q['id'], '_') + 1) : null,
                    'question' => $q['text'] ?? null,
                    'answer' => $answer_label ?? $user_response['value'],
                    'value' => $user_response['value'] ?? null,
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
        $item = collect($this->application_data['questionnaire_responses']) ->firstWhere('id', $response_id);
        $alerts = $item['ai_response']['questions_alert'] ?? [];
        $themes = $this->questionnaire['metadata']['themes'] ?? [];

        $grouped = [];
        foreach ($themes as $theme) {
            $theme_alerts = [];
            foreach ($theme['questions'] as $q) {
                $alert = collect($alerts)->firstWhere('question_id', $q['id']);
                if (! $alert) {
                    continue;
                }

                $theme_alerts[] = [
                    'id' => isset($q['id']) ? substr($q['id'], strrpos($q['id'], '_') + 1) : null,
                    'question' => $alert['question'] ?? $q['text'] ?? null,
                    'label'    => $alert['label'] ?? null,
                    'value'    => $alert['value'] ?? null,
                ];
            }

            if (count($theme_alerts)) {
                $grouped[] = [
                    'theme_name'        => $theme['name'] ?? '',
                    'theme_description' => $theme['description'] ?? '',
                    'questions'         => $theme_alerts,
                ];
            }
        }

        $this->alert_responses = $grouped;
        Flux::modal('show-alerts-modal')->show();
    }

    public function showDomainRating(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        $this->domain_rating = (new DomainRatingAction)->execute(responses: $responses);
        Flux::modal('show-domain-rating-modal')->show();
    }

    public function showCategoryRating(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        $domain_rating = (new DomainRatingAction)->execute(responses: $responses);
        $this->category_rating = (new CategoryRatingAction)->execute(domain_scores: $domain_rating);
        Flux::modal('show-category-rating-modal')->show();
    }

    public function showFinalScore(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        $this->final_score = (new FinalScoreAction)->execute(responses: $responses);
        Flux::modal('show-final-score-modal')->show();
    }

    public function showAnalysisDepartment(int $response_id): void
    {
        $item  = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $this->department_analysis = $item['ai_response']['recommendation_for_department'] ?? 'No hay análisis disponible para esta respuesta.';
        Flux::modal('show-department-analysis-modal')->show();
    }

    public function showAnalysisUser(int $response_id): void
    {
        $item  = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $this->user_analysis = $item['ai_response']['recommendation_for_user'] ?? 'No hay análisis disponible para esta respuesta.';
        Flux::modal('show-user-analysis-modal')->show();
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
