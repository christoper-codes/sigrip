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
    public ?string $notify_message = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount(): void
    {
        $this->items_per_page = 10;
        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();

        if(Auth::user()->company?->getActiveTickets() > 0) {
            $department_names = Auth::user()->company->getActiveTicketNames();
            $this->notify_message = __('Se tienen tickets activos para el departamento de :departments', ['departments' => implode(', ', $department_names)]);
            $this->dispatch('toast', message: $this->notify_message, type: 'warning');
        }
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
