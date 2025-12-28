<?php

namespace App\Livewire\Ticket;

use App\Actions\Tickets\AnalyzeTicketAiAction;
use App\Livewire\Traits\LimitItems;
use App\Models\Department;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use LimitItems;
    use WithFileUploads;

    public ?array $tickets = [];
    public ?array $detail_ticket = null;
    public ?array $ticket_statuses = [];
    public ?array $departments = [];
    public ?string $notify_message = null;
    public bool $is_priority = false;
    public ?int $ticket_status = null;
    public ?string $analyze_ticket_ai_response = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['nullable', 'string', 'min:3'])]
    public ?string $ticket_text_response = null;

    #[Validate(['nullable', 'array'])]
    public ?array $ticket_files_response = null;

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
        $this->is_priority = (bool)$this->detail_ticket['is_priority'];
        $this->ticket_status = $this->detail_ticket['support_ticket_status_id'];

        Flux::modal('ticket-details-modal')->show();
    }

    public function analyzeTicketAi(int $ticket_id): void
    {
        $ticket = $this->tickets[array_search($ticket_id, array_column($this->tickets, 'id'))];
        $analyze_ai = $ticket['metadata']['analyze_ai'] ?? null;

        if (! $analyze_ai) {
            $response = (new AnalyzeTicketAiAction)->execute(ticket: $ticket);
            $this->analyze_ticket_ai_response = $response;

            $temporal_ticket = SupportTicket::find($ticket_id);
            $metadata = $temporal_ticket->metadata ?? [];
            $metadata['analyze_ai'] = $response;
            $temporal_ticket->metadata = $metadata;
            $temporal_ticket->save();
        } else {
            $this->analyze_ticket_ai_response = $analyze_ai;
        }

        Flux::modal('analyze-ticket-ai-modal')->show();
    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
