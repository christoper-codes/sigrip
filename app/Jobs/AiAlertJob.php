<?php

namespace App\Jobs;

use App\Actions\Application\GenerateAiAlertAction;
use App\Actions\Application\GeneratePromptAction;
use App\Actions\Application\GeneratePromptNom035Section1Action;
use App\Actions\Application\GeneratePromptNom035Section2Action;
use App\Actions\Application\GeneratePromptNom035Section3Action;
use App\Actions\User\CreateNotificationAction;
use App\Enums\NomEnum;
use App\Enums\RoleEnum;
use App\Events\NotificationEvent;
use App\Mail\Alert as MailAlert;
use App\Models\Alert;
use App\Models\AlertType;
use App\Models\Application;
use App\Models\QuestionnaireResponse;
use App\Models\SupportTicketStatus;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        if($this->questionnaire['name'] == NomEnum::NOM_1->value){
            $promt = (new GeneratePromptNom035Section1Action)->execute(
                responses: $this->responses,
                questionnaire: $this->questionnaire['metadata'],
                auth_required: $this->application->auth_required,
            );
        } else if($this->questionnaire['name'] == NomEnum::NOM_2->value){
            $promt = (new GeneratePromptNom035Section2Action)->execute(
                responses: $this->responses,
                questionnaire: $this->questionnaire['metadata'],
                auth_required: $this->application->auth_required,
            );
        } else if($this->questionnaire['name'] == NomEnum::NOM_3->value) {
            $promt = (new GeneratePromptNom035Section3Action)->execute(
                responses: $this->responses,
                questionnaire: $this->questionnaire['metadata'],
                auth_required: $this->application->auth_required,
            );
        } else {
            $promt = (new GeneratePromptAction)->execute(
                responses: $this->responses,
                questionnaire: $this->questionnaire['metadata'],
                auth_required: true,
            );
        }

        if(isset($promt['average_score'])){
            $this->questionnaire_response->average_score = $promt['average_score'];
            $this->questionnaire_response->save();
        }

        if (!((bool) $promt['critical_response'] || in_array($promt['type'], ['text', 'mixed']))) {
            return;
        }

        $ai_response = (new GenerateAiAlertAction)->execute(prompt: $promt['prompt']);

        if($ai_response['alert']){
            $alert_type = AlertType::where('color', Str::lower($ai_response['type_alert']))->first();

            // Alerts
            $uuid = str_pad(mt_rand(0, 999999), 8, '0', STR_PAD_LEFT);
            $alert = Alert::create([
                'uuid' => $uuid,
                'alert_type_id' => $alert_type->id,
                'company_id' => $this->application->issuingDepartment->company->id,
                'department_id' => $this->application->executing_department_id,
                'application_id' => $this->application->id,
                'questionnaire_response_id' => $this->questionnaire_response->id,
                'questionnaire_response_uuid' => $this->questionnaire_response->uuid,
                'user_id' => $this->application->auth_required ? $this->user_id : null,
                'name' => $ai_response['alert_name'],
                'subject' => $ai_response['subject_alert'],
                'ai_response' => $ai_response,
                'risk_level' => $ai_response['risk_level'],
                'risk_score' => $ai_response['average_score'],
                'created_by_ai' => true,
                'metadata' => [
                    'application_name' => $this->application->questionnaire->name,
                    'employee_name' => $this->questionnaire_response->employee_data['name'] ?? null,
                ],
            ]);

            $this->questionnaire_response->refresh();
            $this->questionnaire_response->ai_response = $ai_response;
            $this->questionnaire_response->average_score = $ai_response['average_score'];
            $this->questionnaire_response->risk_level = $ai_response['risk_level'];
            $this->questionnaire_response->save();

            // Tickets
            if($alert_type->color == 'red'){
                SupportTicketJob::dispatch(
                    company: $this->application->issuingDepartment->company->id,
                    department: $this->application->executing_department_id,
                    incident_type: $ai_response['ticket_data']['incident_type_id'],
                    support_ticket_status: SupportTicketStatus::where('name', 'abierto')->first()->id,
                    created_by_user: null,
                    title: $ai_response['ticket_data']['ticket_title'],
                    description: $ai_response['ticket_data']['ticket_description'],
                    is_priority: true,
                    is_anonymous: true,
                    created_by_ai: true,
                    contact_name: $this->questionnaire_response->employee_data['name'] ?? null,
                    alert_id: $alert->id,
                    alert_uuid: $alert->uuid,
                );
            }

            // Notifications
            if($this->application->issuingDepartment->manager_id){
                $manager = User::find($this->application->issuingDepartment->manager_id);
                $notification = [
                    'type' => 'success',
                    'title' => __('Alerta AI generada'),
                    'message' => __('Se ha generado una alerta AI para la aplicación: :application. Se recomienda revisarla a la brevedad.', ['application' => $this->application->questionnaire->name]),
                    'url' => route('employee.index'),
                    'user_id' => $this->application->issuingDepartment->manager_id,
                    'alert_uuid' => $alert->uuid,
                ];
                event(new NotificationEvent(
                    notification: $notification,
                    user_id: $manager->id,
                ));

                (new CreateNotificationAction)->execute(
                    notification: $notification,
                    user_id: $manager->id,
                    update_user: false
                );

                $metadata = $manager->metadata;
                $metadata['alerts'] = ($metadata['alerts'] ?? 0) + 1;
                $metadata['notifications'] = ($metadata['notifications'] ?? 0) + 1;
                $manager->metadata = $metadata;
                $manager->save();
            }

            $company_admin = User::where('company_id', $this->application->company_id)
                ->whereHas('userRoles', function ($query) {
                    $query->where('name', RoleEnum::COMPANY_ADMIN->value);
                })->first();
            if($company_admin && $company_admin->id !== $this->application->issuingDepartment->manager_id){
            Mail::to($company_admin->email)->send(new MailAlert(
                employee_name: $this->questionnaire_response->employee_data['name'] ?? null,
                alert_name: $ai_response['subject_alert'],
                recommendation_for_department: $ai_response['recommendation_for_department'],
                alert_uuid: $alert->uuid,
                questionnaire_name: $this->application->questionnaire->name,
            ));

            $notification = [
                    'type' => 'success',
                    'title' => __('Alerta AI generada'),
                    'message' => __('Se ha generado una alerta AI para la aplicación: :application. Se recomienda revisarla a la brevedad.', ['application' => $this->application->questionnaire->name]),
                    'url' => route('employee.index'),
                    'user_id' => $company_admin->id,
                    'alert_uuid' => $alert->uuid,
                ];
                event(new NotificationEvent(
                    notification: $notification,
                    user_id: $company_admin->id,
                ));

                (new CreateNotificationAction)->execute(
                    notification: $notification,
                    user_id: $company_admin->id,
                    update_user: false
                );

                $metadata = $company_admin->metadata;
                $metadata['alerts'] = ($metadata['alerts'] ?? 0) + 1;
                $metadata['notifications'] = ($metadata['notifications'] ?? 0) + 1;
                $company_admin->metadata = $metadata;
                $company_admin->save();
            }
        }
    }
}
