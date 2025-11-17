<?php

namespace App\Livewire\Employee;

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

    public array $employees = [];
    public array $departments = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
        if(! $this->departments){
          $this->dispatch('toast', message: __('No hay departamentos disponibles.'), type: 'warning');
        }

        $this->search_fields = ['name', 'email'];
    }

    public function searchEmployees(): void
    {
        $this->validate();

        $this->employees = User::where('department_id', $this->department)
            ->with('userRoles')
            ->get()
            ->toArray();
        $this->current_page = 1;
    }

    public function openRoleModal(int $employee_id): void
    {
        $this->selected_employee_id = $employee_id;
        $this->loadRoles($employee_id);

        Flux::modal('update-roles-modal')->show();
    }

    public function updateEmployeeRoles(): void
    {
        $this->updateRoles();

        Flux::modal('update-roles-modal')->close();
    }

    public function render()
    {
        $paginated_items = $this->getPaginatedItems();
        $filtered_items = $this->getFilteredItems();
        $total_results = count($filtered_items);
        $total_pages = $this->getTotalPages();

        return view('livewire.employee.index', [
            'paginated_items' => $paginated_items,
            'total_results' => $total_results,
            'total_pages' => $total_pages,
            'current_page' => $this->current_page
        ]);
    }
}
