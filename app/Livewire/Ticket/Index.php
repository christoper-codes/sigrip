<?php

namespace App\Livewire\Ticket;

use App\Livewire\Traits\LimitItems;
use App\Livewire\Traits\Table;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use PHPUnit\Framework\Attributes\Ticket;

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
        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();
    }

     public function searchTickets(): void
    {
        $this->validateOnly('department');
        $this->table_items = Ticket::where('executing_department_id', $this->department)
            ->with('questionnaire', 'issuingDepartment', 'executingDepartment', 'users')
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
