<?php

namespace App\Livewire\Ticket;

use App\Actions\Tickets\AnalyzeTicketAiAction;
use App\Enums\NotificationTypesEnum;
use App\Livewire\Traits\LimitItems;
use App\Models\Department;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use App\Models\TicketResponse;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Employee extends Component
{
    use LimitItems;

    public ?array $tickets = [];
    public ?array $detail_ticket = null;
    public ?array $ticket_statuses = [];
    public ?array $departments = [];
    public ?string $notify_message = null;
    public bool $is_priority = false;
    public ?int $ticket_status = null;
    public ?string $analyze_ticket_ai_response = null;


    #[Validate(['nullable', 'string', 'min:3'])]
    public ?string $ticket_text_response = null;

    #[Validate(['nullable', 'array'])]
    public ?array $ticket_files_response = null;

    public function mount(): void
    {
        $this->items_per_page = 10;
        $this->ticket_statuses = SupportTicketStatus::all()->toArray();
        $this->searchTickets();

        if(Auth::user()->company?->getActiveTickets() < 0) {
            $this->dispatch('toast', message: __('Aun no tienes tickets activos.'), type: NotificationTypesEnum::WARNING->value);
        }
    }

     public function searchTickets(): void
    {
        $this->validateOnly('department');
        $this->tickets = SupportTicket::where('created_by_user_id', Auth::user()->id)
            ->with('incidentType', 'supportTicketStatus', 'createdByUser')
            ->orderByDesc('is_priority')
            ->orderByDesc('is_active')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();
    }

    public function showTicketDetails(int $ticket_id): void
    {
        $this->detail_ticket = SupportTicket::with('incidentType', 'supportTicketStatus', 'createdByUser', 'ticketResponses')->find($ticket_id)->toArray();
        $this->is_priority = (bool)$this->detail_ticket['is_priority'];
        $this->ticket_status = $this->detail_ticket['support_ticket_status_id'];

        Flux::modal('ticket-details-modal')->show();
    }

    public function ticketDetailModalClosed(): void
    {
        $this->js('document.querySelector("#ticket-btn").click()');
    }

    public function render()
    {
        return view('livewire.ticket.employee');
    }
}
