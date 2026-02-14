<?php

namespace App\Livewire\Analysis;

use App\Actions\Analysis\CategoryRatingAction;
use App\Actions\Analysis\CategoryRatingNom3Action;
use App\Actions\Analysis\DomainRatingAction;
use App\Actions\Analysis\DomainRatingNom3Action;
use App\Actions\Analysis\FinalScoreAction;
use App\Actions\Analysis\FinalScoreNom3Action;
use App\Actions\Analysis\GetAlertResponsesAction;
use App\Enums\NomEnum;
use App\Exports\ApplicationResponsesExport;
use App\Exports\MainBaseExport;
use App\Exports\Nom035\MainNomExport;
use App\Livewire\Traits\LimitItems;
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
    use LimitItems;

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
    public ?array $employee_data = null;
    public ?array $general_analysis = null;

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
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
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

        if($this->questionnaire['name'] == NomEnum::NOM_1->value){
            $this->application_data['questionnaire_responses'] = collect($this->application_data['questionnaire_responses'])
                    ->transform(function ($response) {
                        $alert = (bool) $response['ai_response']['alert'] ?? false;
                        $response['classification'] = $alert ? 'Alto' : 'Nulo';
                        return $response;
                    })->toArray();

            $this->headers = [
                ['label' => __('ID')],
                ['label' => __('Nivel de Riesgo'), 'field' => 'classification', 'sortable' => true],
                ['label' => __('Nombre de empleado')],
                ['label' => __('Respuestas')],
                ['label' => __('Alertas')],
                ['label' => __('Ai - departamento')],
                ['label' => __('Ai - empleado')],
                ['label' => __('Calificación Final')],
                ['label' => __('Fecha de Respuesta'), 'field' => 'created_at', 'sortable' => true],
                ['label' => __('Información del empleado')],
                ['label' => __('Descarga excel')],
            ];
        } else if($this->questionnaire['name'] == NomEnum::NOM_2->value){
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
                ['label' => __('Información del empleado')],
                ['label' => __('Descarga excel')],
            ];
        } else if($this->questionnaire['name'] == NomEnum::NOM_3->value) {
            $this->application_data['questionnaire_responses'] = collect($this->application_data['questionnaire_responses'])
                    ->transform(function ($response) {
                        $final_score = collect($response['response_data'])->sum(fn ($response) => (int) $response['value']);
                        $classification = match (true) {
                            $final_score < 50  => 'Nulo o despreciable',
                            $final_score < 75  => 'Bajo',
                            $final_score < 99  => 'Medio',
                            $final_score < 140  => 'Alto',
                            default            => 'Muy alto',
                        };
                        $response['classification'] = $classification;
                        return $response;
                    })->toArray();

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
                ['label' => __('Información del empleado')],
                ['label' => __('Descarga excel')],
            ];
        } else {
            $this->headers = [
                ['label' => __('ID')],
                ['label' => __('Nombre de empleado')],
                ['label' => __('Respuestas')],
                ['label' => __('Alertas')],
                ['label' => __('Ai - departamento')],
                ['label' => __('Ai - empleado')],
                ['label' => __('Fecha de Respuesta'), 'field' => 'created_at', 'sortable' => true],
                ['label' => __('Información del empleado')],
                ['label' => __('Descarga excel')],
            ];
        }

        $this->table_items = $this->application_data['questionnaire_responses'];
        $this->search_fields = ['employee_data.name', 'uuid'];
        $this->refreshTableData();

        Flux::modal('select-application')->close();
    }

    public function showGeneralAnalysis(): void
    {
        $responses = collect($this->application_data['questionnaire_responses']);
        $result = [];
        $result['total_responses'] = $responses->count();
        $result['start_date'] = $this->application_data['start_date'] ?? null;
        $result['expiration_date'] = $this->application_data['expiration_date'] ?? null;
        $key_labels = [
            'sex' => 'Sexo',
            'age' => 'Rango de edad',
            'marital_status' => 'Estado civil',
            'education_level' => 'Nivel de estudios',
            'status_education_level' => 'Estado del nivel de estudios',
            'department' => 'Departamento, Sección o Área',
            'job_title' => 'Puesto de trabajo',
            'job_type' => 'Tipo de puesto',
            'contract_type' => 'Tipo de contratación',
            'personnel_type' => 'Tipo de personal',
            'work_schedule_type' => 'Tipo de jornada de trabajo',
            'shift_rotation' => 'Realiza rotación de turnos',
            'experience_current_job' => 'Experiencia (años). Tiempo en el puesto actual',
            'total_experience' => 'Experiencia (años). Tiempo experiencia laboral',
        ];

        if (($this->application_data['employee_data_required'] ?? false) && $responses->count() > 0) {
            $employee_keys = collect($responses->first()['employee_data'] ?? [])->keys()->filter(fn($k) => $k !== 'name' && $k !== 'questionnaire_name');
            $employee_stats = [];
            foreach ($employee_keys as $key) {
                $counts = $responses->map(fn($r) => $r['employee_data'][$key] ?? null)
                    ->filter()
                    ->countBy();
                $label = $key_labels[$key] ?? ucfirst(str_replace('_', ' ', $key));
                $employee_stats[$label] = $counts->toArray();
            }
            $result['employee_data_stats'] = $employee_stats;
        }

        $this->general_analysis = $result;

        Flux::modal('general-analysis-modal')->show();
    }

    public function downloadAllResults(): BinaryFileResponse
    {
        $export_name =  $this->application_data['slug'] . '_responses.xlsx';
        return Excel::download(new ApplicationResponsesExport($this->application_data['questionnaire_responses']), $export_name);
    }

    public function downloadResults(int $response_id): BinaryFileResponse
    {
        $response = collect($this->application_data['questionnaire_responses']) ->firstWhere('id', $response_id);
        $responses = $response['response_data'] ?? [];
        $themes = $this->questionnaire['metadata']['themes'];
        $format_responses = $this->setFormatResponses($themes, $responses);
        $export_name =  $this->application_data['slug'] . '_detailed_responses.xlsx';

        /* Analysis Ai */
        $analysis_ai = [[
            'recommendation_for_user' => $response['ai_response']['recommendation_for_user'] ?? null,
            'recommendation_for_department' => $response['ai_response']['recommendation_for_department'] ?? null,
            'ticket_title' => $response['ai_response']['ticket_data']['ticket_title'] ?? null,
            'ticket_description' => $response['ai_response']['ticket_data']['ticket_description'] ?? null,
        ]];

        /* User data */
        $user_data = [
            ['Nombre completo', 'chris'],
            ['Sexo', 'masculino'],
            ['Edad', '30'],
            ['Estado civil', 'soltero'],
            ['Nivel de estudios', 'licenciatura'],
            ['Puesto de trabajo', 'desarrollador'],
            ['Departamento', 'tecnología'],
            ['Tipo de puesto', 'senior'],
            ['Tipo de contratación', 'tiempo completo'],
            ['Tipo de personal', 'permanente'],
            ['Tipo de jornada', 'diurna'],
            ['Realiza rotación de turnos', 'no'],
            ['Experiencia en el puesto actual (años)', '5'],
            ['Experiencia laboral total (años)', '10'],
            ['Questionario aplicado', $this->questionnaire['name']],
        ];

        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            /*  Responses */
            $export_name =  $this->application_data['slug'] . '_guia_referencia_ii_responses.xlsx';
            $all_responses = $this->setDomainAndCategory($format_responses);

            /* Alert responses */
            $alerts = (new GetAlertResponsesAction)->execute(response: $response, themes: $themes);
            $alert_responses = $this->setDomainAndCategory($alerts);

            /* Domain data */
            $domain_scores = (new DomainRatingAction)->execute(responses: $responses);
            $domain_data = [];
            foreach ($domain_scores as $domain => $score) {
                $domain_data[] = [
                    $domain,
                    (string) $score['score'] ?? (string) 0,
                    $score['classification'] ?? null,
                    $score['category'] ?? null,
                ];
            }

            /* Category data */
            $category = (new CategoryRatingAction)->execute(domain_scores: $domain_scores);
            $category_data = [];
            foreach ($category as $category_name => $score) {
                $category_data[] = [
                    $category_name,
                    (string) $score['score'] ?? (string) 0,
                    $score['classification'] ?? null,
                ];
            }

            /* Final data */
            $final = (new FinalScoreAction)->execute(responses: $responses);
            $final_data = [
                ['Questionario', $this->questionnaire['name']],
                ['Puntaje final', $final['final_score']],
                ['Clasificación', $final['classification']['label']],
                ['Acción', $final['classification']['description']]
            ];

            return Excel::download(new MainNomExport(
                    responses: $all_responses,
                    user_data: $user_data,
                    alert_responses: $alert_responses,
                    analysis_ai: $analysis_ai,
                    domain_data: $domain_data,
                    category_data: $category_data,
                    final_data: $final_data
                ), $export_name);
        }

        if($this->questionnaire['name'] == NomEnum::NOM_3->value){
            /*  Responses */
            $export_name =  $this->application_data['slug'] . '_guia_referencia_iii_responses.xlsx';
            $all_responses = $this->setDomainAndCategory($format_responses);

            /* Alert responses */
            $alerts = (new GetAlertResponsesAction)->execute(response: $response, themes: $themes);
            $alert_responses = $this->setDomainAndCategory($alerts);

            /* Domain data */
            $domain_scores = (new DomainRatingNom3Action)->execute(responses: $responses);
            $domain_data = [];
            foreach ($domain_scores as $domain => $score) {
                $domain_data[] = [
                    $domain,
                    (string) $score['score'] ?? (string) 0,
                    $score['classification'] ?? null,
                    $score['category'] ?? null,
                ];
            }

            /* Category data */
            $category = (new CategoryRatingNom3Action)->execute(domain_scores: $domain_scores);
            $category_data = [];
            foreach ($category as $category_name => $score) {
                $category_data[] = [
                    $category_name,
                    (string) $score['score'] ?? (string) 0,
                    $score['classification'] ?? null,
                ];
            }

            /* Final data */
            $final = (new FinalScoreNom3Action)->execute(responses: $responses);
            $final_data = [
                ['Questionario', $this->questionnaire['name']],
                ['Puntaje final', $final['final_score']],
                ['Clasificación', $final['classification']['label']],
                ['Acción', $final['classification']['description']]
            ];

            return Excel::download(new MainNomExport(
                    responses: $all_responses,
                    user_data: $user_data,
                    alert_responses: $alert_responses,
                    analysis_ai: $analysis_ai,
                    domain_data: $domain_data,
                    category_data: $category_data,
                    final_data: $final_data
                ), $export_name);
        }

        $alerts = (new GetAlertResponsesAction)->execute(response: $response, themes: $themes);


        return Excel::download(new MainBaseExport(
            responses: $format_responses,
            user_data: $user_data,
            alert_responses: $alerts,
            analysis_ai: $analysis_ai
        ), $export_name);
    }

    public function setDomainAndCategory(array $responses): array
    {
        return collect($responses)->transform(function ($theme) {
                $theme['questions'] = collect($theme['questions'])->transform(function ($question) {
                    $item = (int) preg_replace('/\D/', '', $question['id']);
                    if($this->questionnaire['name'] == NomEnum::NOM_2->value){
                        $resolve = $this->resolveDomainAndCategory($item);
                    }
                    if($this->questionnaire['name'] == NomEnum::NOM_3->value){
                        $resolve = $this->resolveDomainAndCategoryNom3($item);
                    }

                    return array_merge($question, [
                        'domain'   => $resolve['domain'],
                        'category' => $resolve['category'],
                    ]);
                })->toArray();

                 return $theme;
            })->toArray();
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

    public function resolveDomainAndCategoryNom3(int $item): array
    {
        $domain_map = [
            'Condiciones en el ambiente de trabajo' => [
                'category' => 'Ambiente de trabajo',
                'items' => [1,2,3,4,5],
            ],

            'Carga de trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [6,7,8,9,10,11,12,13,14,15,16,66,67,68,69],
            ],

            'Falta de control sobre el trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [23,24,25,26,27,28,29,30,35,36],
            ],

            'Jornada de trabajo' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [17,18],
            ],

            'Interferencia en la relación trabajo-familia' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [19,20,21,22],
            ],

            'Liderazgo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [31,32,33,34,37,38,39,40,41],
            ],

            'Relaciones en el trabajo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [42,43,44,45,46,71,72,73,74],
            ],

            'Violencia' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [57,58,59,60,61,62,63,64],
            ],

            'Reconocimiento del desempeño' => [
                'category' => 'Entorno organizacional',
                'items' => [47,48,49,50,51,52],
            ],

            'Insuficiente sentido de pertenencia e inestabilidad' => [
                'category' => 'Entorno organizacional',
                'items' => [53,54,55,56],
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
        $this->all_responses = $this->setFormatResponses($themes, $responses);

        Flux::modal('show-responses-modal')->show();
    }

    public function setFormatResponses(array $themes, array $responses): array
    {
        $format_responses = [];
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
                $format_responses[] = [
                    'theme_name' => $theme['name'] ?? '',
                    'theme_description' => $theme['description'] ?? '',
                    'questions' => $theme_questions,
                ];
            }
        }

        return $format_responses;
    }

    public function showAlerts(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses']) ->firstWhere('id', $response_id);
        $themes = $this->questionnaire['metadata']['themes'] ?? [];
        $this->alert_responses = (new GetAlertResponsesAction)->execute(
            response: $item,
            themes: $themes
        );

        Flux::modal('show-alerts-modal')->show();
    }

    public function showDomainRating(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            $this->domain_rating = (new DomainRatingAction)->execute(responses: $responses);
        }

        if($this->questionnaire['name'] == NomEnum::NOM_3->value){
            $this->domain_rating = (new DomainRatingNom3Action)->execute(responses: $responses);
        }

        Flux::modal('show-domain-rating-modal')->show();
    }

    public function showCategoryRating(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            $domain_rating = (new DomainRatingAction)->execute(responses: $responses);
            $this->category_rating = (new CategoryRatingAction)->execute(domain_scores: $domain_rating);
        }

        if($this->questionnaire['name'] == NomEnum::NOM_3->value){
            $domain_rating = (new DomainRatingNom3Action)->execute(responses: $responses);
            $this->category_rating = (new CategoryRatingNom3Action)->execute(domain_scores: $domain_rating);
        }

        Flux::modal('show-category-rating-modal')->show();
    }

    public function showFinalScore(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $responses = $item['response_data'] ?? [];

        if($this->questionnaire['name'] == NomEnum::NOM_1->value){
            $alert = $item['ai_response']['alert'] ?? false;
            $final_score = collect($responses)->sum(fn ($response) => (int) $response['value']);
            $this->final_score = [
                'final_score' => $final_score,
                'classification' => [
                    'label' => $alert ? 'Alto' : 'Nulo',
                    'risk_level' => '',
                    'description' => $alert ?
                        'Se requiere una valoración clinica detallada para determinar las áreas de riesgo y las intervenciones necesarias.' :
                        'No se identificaron riesgos significativos. Se recomienda mantener las condiciones actuales y promover un ambiente de trabajo saludable.',
                ],
            ];
        }

        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            $this->final_score = (new FinalScoreAction)->execute(responses: $responses);
        }

        if($this->questionnaire['name'] == NomEnum::NOM_3->value){
            $this->final_score = (new FinalScoreNom3Action)->execute(responses: $responses);
        }

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

    public function showEmployeeData(int $response_id): void
    {
        $item = collect($this->application_data['questionnaire_responses'])->firstWhere('id', $response_id);
        $this->employee_data = $item['employee_data'] ?? [];

        Flux::modal('show-employee-data-modal')->show();
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
