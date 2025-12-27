<?php

namespace App\Livewire\Ticket;

use App\Livewire\Traits\LimitItems;
use App\Livewire\Traits\Table;
use App\Models\Department;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use LimitItems;
    use Table;

    public ?array $tickets = [];
    public ?array $departments = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount(): void
    {
        $this->items_per_page = 10;
        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();
    }

     public function searchTickets(): void
    {
        $this->validateOnly('department');
        $this->table_items = SupportTicket::where('department_id', $this->department)
            ->with('incidentType', 'supportTicketStatus', 'createdByUser')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
