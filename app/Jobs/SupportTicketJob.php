<?php

namespace App\Jobs;

use App\Models\SupportTicket;
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
            'metadata' => [],
            'is_priority' => $this->is_priority,
        ]);
    }
}
