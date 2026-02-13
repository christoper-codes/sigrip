<?php

namespace App\Livewire\Application;

use App\Enums\NomEnum;
use App\Enums\NotificationTypesEnum;
use App\Jobs\AiAlertJob;
use App\Livewire\Forms\EmployeeDataForm;
use App\Models\Application;
use App\Models\QuestionnaireResponse;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Show extends Component
{
    public EmployeeDataForm $form;

    public Application $application;
    public bool $is_visitor;
    public ?string $company_name = null;
    public ?string $department_name = null;
    public ?array $questionnaire = null;
    public int $current_theme_step = 0;
    public array $themes = [];
    public ?array $current_theme = null;
    public int $theme_count = 0;
    public int $theme_index = 0;
    public array $answers = [];
    public ?string $error_message = null;
    public ?int $total_questions = null;
    public ?int $current_questions = null;
    public int $theme_change = 0;

    public function mount(): void
    {
        $this->questionnaire = $this->application->questionnaire->toArray();
        $this->company_name = $this->application->issuingDepartment->company->name;
        $this->department_name = $this->application->executingDepartment->name;
        $this->current_theme_step = 0;
        $this->setThemesAndCurrentTheme();
    }

    public function submit()
    {
        $this->error_message = null;
        $this->saveProgress();
        if ($this->error_message) {
            return;
        }

        if($this->is_visitor){
            $this->dispatch('toast', message: __('Esta aplicación no puede ser enviada por un visitante.'), type: NotificationTypesEnum::WARNING->value);
            return;
        }

        if($this->application->employee_data_required){
            $this->validate();
        }

        $allAnswers = $this->getAllAnswers();
        $this->answers = $allAnswers;
        $this->validateNom2SpecialCases();
        $this->validateNom3SpecialCases();

        DB::beginTransaction();
        try{
            $responses = [];
            foreach ($this->themes as $theme) {
                foreach ($theme['questions'] as $question) {
                    $qid = $question['id'];
                    if (isset($this->answers[$qid])) {
                        $responses[] = [
                            'question_id' => $qid,
                            'value' => $this->answers[$qid],
                            'critical_values' => $question['critical_values'] ?? null,
                            'weight' => $question['weight'] ?? null,
                        ];
                    }
                }
            }

            $questionnaire_response = QuestionnaireResponse::create([
                'uuid' => str_pad(mt_rand(0, 999999), 8, '0', STR_PAD_LEFT),
                'application_id' => $this->application->id,
                'questionnaire_id' => $this->questionnaire['id'],
                'user_id' => $this->application->auth_required ? Auth::id() : null,
                'department_id' => $this->application->executing_department_id,
                'response_data' => $responses,
                'ai_response' => null,
                'average_score' => null,
                'risk_level' => null,
            ]);

            if($this->application->auth_required){
                $user_application = Auth::user()->applications()->where('application_id', $this->application->id)->first();
                $user_application->pivot->is_active = false;
                $user_application->pivot->save();
            }

            AiAlertJob::dispatch(
                responses: $responses,
                questionnaire: $this->questionnaire,
                auth_required: $this->application->auth_required,
                application_id: $this->application->id,
                user_id: $this->application->auth_required ? Auth::id() : 0,
                application: $this->application,
                questionnaire_response: $questionnaire_response,
            );

            DB::commit();
            for ($i = 0; $i < $this->theme_count; $i++) {
                $theme_key = 'answers-' . $this->application->slug . '-theme-' . $i;
                session()->forget($theme_key);
            }
            return redirect(route('application.thanks'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: __('Ocurrió un error al enviar la aplicación. Por favor, intenta nuevamente.'), type: NotificationTypesEnum::ERROR->value);
        }
    }

    public function validateNom3SpecialCases(): void
    {
        if($this->questionnaire['name'] == NomEnum::NOM_3->value){
            if($this->answers['gr3_q65'] == 1){
                $this->answers['gr3_q65'] = 2;
                unset($this->answers['gr3_q66']);
                unset($this->answers['gr3_q67']);
                unset($this->answers['gr3_q68']);
                unset($this->answers['gr3_q69']);
            }

            if ($this->answers['gr3_q65'] == 0){
                $this->answers['gr3_q65'] = 1;
            }
            if($this->answers['gr3_q70'] == 1){
                $this->answers['gr3_q70'] = 2;
                unset($this->answers['gr3_q71']);
                unset($this->answers['gr3_q72']);
                unset($this->answers['gr3_q73']);
                unset($this->answers['gr3_q74']);
            }

            if ($this->answers['gr3_q70'] == 0){
                $this->answers['gr3_q70'] = 1;
            }
        }
    }

    public function validateNom2SpecialCases(): void
    {
        if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            if ($this->answers['gr2_q41'] == 3){
                $this->answers['gr2_q41'] = 2;
                unset($this->answers['gr2_q42']);
                unset($this->answers['gr2_q43']);
                unset($this->answers['gr2_q44']);
            }
            if ($this->answers['gr2_q41'] == 4){
                $this->answers['gr2_q41'] = 1;
            }
            if ($this->answers['gr2_q45'] == 3){
                $this->answers['gr2_q45'] = 2;
                unset($this->answers['gr2_q46']);
                unset($this->answers['gr2_q47']);
                unset($this->answers['gr2_q48']);
            }
            if ($this->answers['gr2_q45'] == 4){
                $this->answers['gr2_q45'] = 1;
            }
        }
    }

    public function getAvailableThemes(): array
    {
        $themes = $this->questionnaire['metadata']['themes'] ?? [];
        if ($this->questionnaire['metadata']['questionnaire_id'] === 'plan_escaneo_emocional_mensual') {
            $result = [];
            if (isset($themes[0])) {
                $result[] = $themes[0];
            }
            $month = Carbon::now()->month;
            foreach ($themes as $idx => $theme) {
                foreach ($theme['questions'] as $question) {
                    if (isset($question['month']) && $question['month'] == $month) {
                        if ($idx !== 0) {
                            $result[] = $theme;
                        }
                        break 2;
                    }
                }
            }
            return $result;
        }
        return $themes;
    }

    public function setThemesAndCurrentTheme(): void
    {
        $this->themes = $this->getAvailableThemes();
        $this->theme_count = count($this->themes);
        $this->theme_index = $this->current_theme_step;
        $this->current_theme = $this->themes[$this->current_theme_step] ?? null;

        $total = 0;
        foreach ($this->themes as $theme) {
            $total += isset($theme['questions']) ? count($theme['questions']) : 0;
        }
        $this->total_questions = $total;

        $current = 0;
        for ($i = 0; $i <= $this->current_theme_step; $i++) {
            $current += isset($this->themes[$i]['questions']) ? count($this->themes[$i]['questions']) : 0;
        }
        $this->current_questions = $current;

        $theme_key = 'answers-' . $this->application->slug . '-theme-' . $this->current_theme_step;
        $this->answers = session($theme_key, []);
    }

    public function nextTheme()
    {
        $this->error_message = null;
        $this->saveProgress();
        if ($this->error_message) {
            return;
        }

        if ($this->current_theme_step < $this->theme_count - 1) {
            $this->current_theme_step++;
            $this->setThemesAndCurrentTheme();
            $this->theme_change++;
        }
        if ($this->questionnaire['name'] == NomEnum::NOM_1->value) {
            $allAnswers = $this->getAllAnswers();
            if(isset($allAnswers['gr1_q1'])){
                $submit = true;
                collect($allAnswers)->each(function ($answer, $question_id) use (&$submit) {
                    if (Str::startsWith($question_id, 'gr1_q') && $answer == 1) {
                        $submit = false;
                    }
                });
                if($submit){
                    $this->submit();
                }
            }
        }

        if ($this->questionnaire['name'] == NomEnum::NOM_2->value) {
            $allAnswers = $this->getAllAnswers();
            if(isset($allAnswers['gr2_q45'])){
                $skip = true;
                if($allAnswers['gr2_q45'] == 1){
                    $skip = false;
                }
            }
        }
    }

    public function getAllAnswers(): array
    {
        $allAnswers = [];
        for ($i = 0; $i < $this->theme_count; $i++) {
            $theme_key = 'answers-' . $this->application->slug . '-theme-' . $i;
            $theme_answers = session($theme_key, []);
            $allAnswers = array_merge($allAnswers, $theme_answers);
        }
        return $allAnswers;
    }

    public function saveProgress(): void
    {
        $theme_key = 'answers-' . $this->application->slug . '-theme-' . $this->current_theme_step;
        $theme = $this->current_theme;
        foreach ($theme['questions'] as $question) {
            $qid = $question['id'];
            if (
                !array_key_exists($qid, $this->answers) ||
                $this->answers[$qid] === null ||
                $this->answers[$qid] === ''
                ) {
                if($this->questionnaire['name'] == NomEnum::NOM_1->value){
                    if(Str::startsWith($qid, 'gr1_q')){
                        $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                    }
                } else if($this->questionnaire['name'] == NomEnum::NOM_2->value){
                    if (
                            in_array($qid, ['gr2_q42', 'gr2_q43', 'gr2_q44']) &&
                            (!isset($this->answers['gr2_q41']) || $this->answers['gr2_q41'] == 1 || $this->answers['gr2_q41'] == 4)
                        ) {
                            $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                        }
                    if (
                            in_array($qid, ['gr2_q46', 'gr2_q47', 'gr2_q48']) &&
                            (!isset($this->answers['gr2_q45']) || $this->answers['gr2_q45'] == 1 || $this->answers['gr2_q45'] == 4)
                        ) {
                            $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                        }

                        if(! in_array($qid, ['gr2_q42', 'gr2_q43', 'gr2_q44', 'gr2_q46', 'gr2_q47', 'gr2_q48']) ){
                            $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                        }

                } else if($this->questionnaire['name'] == NomEnum::NOM_3->value) {
                    if (
                            in_array($qid, ['gr3_q66', 'gr3_q67', 'gr3_q68', 'gr3_q69']) &&
                            (!isset($this->answers['gr3_q65']) || $this->answers['gr3_q65'] == 0)
                        ) {
                            $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                        }
                    if (
                            in_array($qid, ['gr3_q71', 'gr3_q72', 'gr3_q73', 'gr3_q74']) &&
                            (!isset($this->answers['gr3_q70']) || $this->answers['gr3_q70'] == 0)
                        ) {
                            $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                        }

                    if(! in_array($qid, ['gr3_q66', 'gr3_q67', 'gr3_q68', 'gr3_q69', 'gr3_q71', 'gr3_q72', 'gr3_q73', 'gr3_q74']) ){
                         $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                    }

                }else {
                    $this->error_message = __('Por favor, responde todas las preguntas antes de continuar.');
                }
            }
        }

        $theme_answers = [];
        foreach ($theme['questions'] as $question) {
            $qid = $question['id'];
            if (isset($this->answers[$qid])) {
                $theme_answers[$qid] = $this->answers[$qid];
            }
        }
        session([$theme_key => $theme_answers]);
    }

    public function prevTheme()
    {
        $this->error_message = null;
        if ($this->current_theme_step > 0) {
            $this->current_theme_step--;
            $this->setThemesAndCurrentTheme();
        }
    }

    public function render()
    {
        return view('livewire.application.show');
    }
}
