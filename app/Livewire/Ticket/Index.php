<?php

namespace App\Livewire\Ticket;

use App\Livewire\Traits\LimitItems;
use App\Models\Department;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use LimitItems;

    public ?array $tickets = [];
    public ?array $detail_ticket = null;
    public ?array $ticket_statuses = [];
    public ?array $departments = [];
    public ?string $notify_message = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount(): void
    {
        $this->items_per_page = 10;
        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();
        $this->ticket_statuses = SupportTicketStatus::all()->toArray();

        if(Auth::user()->company?->getActiveTickets() > 0) {
            $department_names = Auth::user()->company->getActiveTicketNames();
            $this->notify_message = __('Se tienen tickets activos para el departamento de :departments', ['departments' => implode(', ', $department_names)]);
            $this->dispatch('toast', message: $this->notify_message, type: 'warning');
        }
    }

     public function searchTickets(): void
    {
        $this->validateOnly('department');
        $this->tickets = SupportTicket::where('department_id', $this->department)
            ->with('incidentType', 'supportTicketStatus', 'createdByUser')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();
    }

    public function showTicketDetails(int $ticket_id): void
    {
        $this->detail_ticket = $this->tickets[array_search($ticket_id, array_column($this->tickets, 'id'))];

        Flux::modal('ticket-details-modal')->show();
    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
