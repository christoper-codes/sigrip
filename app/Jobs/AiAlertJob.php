<?php

namespace App\Jobs;

use App\Actions\Application\GenerateAiAlertAction;
use App\Actions\Application\GeneratePromptAction;
use App\Enums\RoleEnum;
use App\Events\NotificationEvent;
use App\Models\Alert;
use App\Models\AlertType;
use App\Models\Application;
use App\Models\QuestionnaireResponse;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class AiAlertJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;
    public int $backoff = 5;
    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $responses,
        public array $questionnaire,
        public bool $auth_required,
        public int $application_id,
        public int $user_id,
        public Application $application,
        public QuestionnaireResponse $questionnaire_response,
    )
    {
       $this->onQueue('ai');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $promt = (new GeneratePromptAction)->execute(
            responses: $this->responses,
            questionnaire: $this->questionnaire['metadata'],
            auth_required: $this->application->auth_required,
        );

        if (!((bool) $promt['critical_response'] || in_array($promt['type'], ['text', 'mixed']))) {
            return;
        }

        $ai_response = (new GenerateAiAlertAction)->execute(prompt: $promt['prompt']);

        if($ai_response['alert']){
            $alert_type = AlertType::where('color', Str::lower($ai_response['alert_type']))->first();
            Alert::create([
                'alert_type_id' => $alert_type->id,
                'company_id' => $this->application->issuingDepartment->company->id,
                'department_id' => $this->application->executing_department_id,
                'application_id' => $this->application->id,
                'user_id' => $this->application->auth_required ? $this->user_id : null,
                'name' => $ai_response['alert_name'],
                'subject' => $ai_response['subject_alert'],
                'ai_response' => $ai_response,
                'risk_level' => $ai_response['risk_level'],
                'risk_score' => $ai_response['risk_score'],
            ]);

            $this->questionnaire_response->ai_response = $ai_response;
            $this->questionnaire_response->average_score = $ai_response['risk_score'];
            $this->questionnaire_response->risk_level = $ai_response['risk_level'];
            $this->questionnaire_response->save();

            if($this->application->issuingDepartment->manager_id){
                $manager = User::find($this->application->issuingDepartment->manager_id);
                event(new NotificationEvent(
                    notification: [
                        'type' => 'success',
                        'title' => __('Alerta AI generada'),
                        'message' => __('Se ha generado una alerta AI para la aplicación: :application. Se recomienda revisarla a la brevedad.', ['application' => $this->application->questionnaire->name]),
                        'url' => route('employee.index'),
                        'user_id' => $this->application->issuingDepartment->manager_id,
                    ],
                    user_id: $manager->id,
                ));

                $metadata = $manager->metadata;
                $metadata['alerts'] = ($metadata['alerts'] ?? 0) + 1;
                $manager->metadata = $metadata;
                $manager->save();
            }

            $company_admin = User::where('company_id', $this->application->issuingDepartment->company_id)
                    ->whereHas('userRoles', function ($query) {
                        $query->where('role', RoleEnum::COMPANY_ADMIN->value);
                    })->first();
            if($company_admin && $company_admin->id !== $this->application->issuingDepartment->manager_id){
                event(new NotificationEvent(
                    notification: [
                        'type' => 'success',
                        'title' => __('Alerta AI generada'),
                        'message' => __('Se ha generado una alerta AI para la aplicación: :application. Se recomienda revisarla a la brevedad.', ['application' => $this->application->questionnaire->name]),
                        'url' => route('employee.index'),
                        'user_id' => $company_admin->id,
                    ],
                    user_id: $company_admin->id,
                ));

                $metadata = $company_admin->metadata;
                $metadata['alerts'] = ($metadata['alerts'] ?? 0) + 1;
                $company_admin->metadata = $metadata;
                $company_admin->save();
            }

            // Email notification
        }
    }
}
