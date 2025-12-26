<?php

namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use App\Jobs\SupportTicketJob;
use App\Models\IncidentType;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    public ?array $departments = [];
    public ?array $incident_types = [];
    public bool $is_priority = true;
    public bool $is_anonymous = false;

    #[Validate(['required', 'integer'])]
    public ?int $department = null;

    #[Validate(['required', 'integer'])]
    public ?int $incident_type = null;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $description = null;

    public function mount(): void
    {
        $this->departments = Auth::user()->company?->departments->toArray() ?? [];
        $this->incident_types = IncidentType::all()->toArray();
    }

    public function submit(): void
    {
        $this->validate();
        SupportTicketJob::dispatch(
            company: Auth::user()->company?->id,
            department: $this->department,
            incident_type: $this->incident_type,
            support_ticket_status: SupportTicketStatus::where('name', 'abierto')->first()->id,
            created_by_user: $this->is_anonymous ? null : Auth::user()->id,
            title: $this->title,
            description: $this->description,
            is_priority: $this->is_priority,
            is_anonymous: $this->is_anonymous,
        );

        $this->dispatch('toast', message: __('Ticket creado correctamente. Tomara unos segundos en procesarse.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.ticket.store');
    }
}
