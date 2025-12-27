<?php

namespace App\Jobs;

use App\Actions\User\CreateNotificationAction;
use App\Enums\RoleEnum;
use App\Events\NotificationEvent;
use App\Models\Department;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SupportTicketJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 1;
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $company,
        public int $department,
        public int $incident_type,
        public int $support_ticket_status,
        public ?int $created_by_user,
        public string $title,
        public string $description,
        public bool $is_priority,
        public bool $is_anonymous,
        public ?array $evidence_files = [],
    )
    {
        $this->onQueue('tickets');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ticket = SupportTicket::create([
            'company_id' => $this->company,
            'department_id' => $this->department,
            'incident_type_id' => $this->incident_type,
            'support_ticket_status_id' => $this->support_ticket_status,
            'created_by_user_id' => $this->is_anonymous ? null : $this->created_by_user,
            'title' => $this->title,
            'description' => $this->description,
            'metadata' => [
                'evidences' => $this->evidence_files,
            ],
            'is_priority' => $this->is_priority,
        ]);

        $hr_department = Department::where('metadata->hr_department', true)
            ->where('company_id', $this->company)
            ->first();

        if($hr_department && $hr_department->manager_id){
            $notification = [
                'type' => 'success',
                'title' => __('Nuevo ticket de soporte creado'),
                'message' => __('Se ha creado un nuevo ticket de soporte titulado: :title. Por favor, revísalo a la brevedad.', ['title' => $this->title]),
                'url' => route('ticket.index'),
                'user_id' => $hr_department->manager_id,
            ];
            event(new NotificationEvent(
                notification: $notification,
                user_id: $hr_department->manager_id,
            ));

            (new CreateNotificationAction)->execute(
                notification: $notification,
                user_id: $hr_department->manager_id,
                update_user: true
            );
        }

        $company_admin = User::where('company_id', $this->company)
            ->whereHas('userRoles', function ($query) {
                $query->where('name', RoleEnum::COMPANY_ADMIN->value);
            })->first();
        if ($company_admin && $company_admin->id !== ($hr_department?->manager_id)) {
            $notification = [
                'type' => 'success',
                'title' => __('Nuevo ticket de soporte creado'),
                'message' => __('Se ha creado un nuevo ticket de soporte titulado: :title. Por favor, revísalo a la brevedad.', ['title' => $this->title]),
                'url' => route('ticket.index'),
                'user_id' => $company_admin->id,
            ];

            event(new NotificationEvent(
                notification: $notification,
                user_id: $company_admin->id,
            ));

            (new CreateNotificationAction)->execute(
                notification: $notification,
                user_id: $company_admin->id,
                update_user: true
            );
        }

        // Email notification
    }
}
