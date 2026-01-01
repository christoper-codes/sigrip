<?php

namespace App\Livewire\Employee;

use App\Enums\RoleEnum;
use App\Livewire\Traits\LimitItems;
use App\Livewire\Traits\Roles;
use App\Livewire\Traits\Table;
use App\Models\Department;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use Table;
    use Roles;
    use LimitItems;

    public array $departments = [];
    public bool $search_employees = false;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount(): void
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
    }

    public function searchEmployees(): void
    {
        $this->validate();

        $this->table_items = User::where('department_id', $this->department)
            ->with('userRoles')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();

        $this->current_page = 1;
        $this->search_query = '';
        $this->refreshTableData();
        $this->search_employees = true;
    }

    public function render()
    {
        return view('livewire.employee.index');
    }
}
