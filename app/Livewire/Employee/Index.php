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
        $this->headers = [
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Email'), 'field' => 'email', 'sortable' => true],
            ['label' => __('Roles')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Aplicaciones')],
            ['label' => __('Actualizar roles')],
        ];
    }

    public function searchEmployees(): void
    {
        $this->validate();

        $this->table_items = User::where('department_id', $this->department)
            ->with('userRoles')
            ->get()
            ->toArray();

        $this->current_page = 1;
        $this->search_query = '';
        $this->refreshTableData();
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
        $this->table_items = collect($this->table_items)->map(function ($item) {
            if ($item['id'] === $this->selected_employee_id) {
                $item['user_roles'] = User::find($this->selected_employee_id)->userRoles->toArray();
            }
            return $item;
        })->toArray();

        $this->refreshTableData();

        Flux::modal('update-roles-modal')->close();
    }

    public function render()
    {
        return view('livewire.employee.index');
    }
}
