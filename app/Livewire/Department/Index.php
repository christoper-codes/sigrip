<?php

declare(strict_types=1);

namespace App\Livewire\Department;

use App\Enums\NotificationTypesEnum;
use App\Enums\RoleEnum;
use App\Livewire\Forms\DepartmentForm;
use App\Livewire\Traits\Table;
use App\Models\Department;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public DepartmentForm $form;
    public ?Department $department;

    public function mount()
    {
        $this->table_items = Department::where('company_id', Auth::user()->company?->id)
            ->with('manager')
            ->get()
            ->toArray();

        $no_manager = collect($this->table_items)->first(function ($departament) {
            return empty($departament['manager_id']);
        });
        if ($no_manager) {
            $this->dispatch('toast', message: __('Por seguridad, debe asignar un gerente a todos los departamentos.'), type: 'warning');
        }

        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Gerente')],
            ['label' => __('Email')],
            ['label' => __('Descripción')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Acciones')],
        ];
        $this->refreshTableData();
    }

    public function submit(): void
    {
        $this->validate();

        $hr_department = Department::where('company_id', Auth::user()->company->id)
            ->where('metadata->hr_department', true)
            ->first();
        if ($hr_department && $this->department->id !== $hr_department->id && $this->form->hr_department) {
            Flux::modal('edit-department-modal')->close();
            $this->dispatch('toast', message: __('Ya existe un departamento de RRHH en esta compañía.'), type: NotificationTypesEnum::ERROR->value);

            return;
        }

        if ($this->form->save_manager && $this->form->manager) {
            $potential_manager = User::find($this->form->manager)->userRoles()
                ->where('name', RoleEnum::DEPARTMENT_MANAGER->value)
                ->exists();
            if (! $potential_manager) {
                Flux::modal('edit-department-modal')->close();
                $this->dispatch('toast', message: __('El empleado seleccionado no tiene el rol de Gerente'), type: NotificationTypesEnum::ERROR->value);

                return;
            }
        }

        $metadata = ['hr_department' => $this->form->hr_department];
        $this->department->name = $this->form->name;
        $this->department->email = $this->form->email;
        $this->department->description = $this->form->description;
        $this->department->phone = $this->form->phone;
        $this->department->metadata = $metadata;
        $this->department->manager_id = $this->form->manager;
        $this->department->save();

        if ($this->form->hr_department) {
            Auth::user()->update(['department_id' => $this->department->id]);
        }

        Flux::modal('edit-department-modal')->close();
        $this->dispatch('toast', message: __('Departamento actualizado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset([
            'form.search_manager',
            'form.hr_department',
            'form.manager',
        ]);
        $this->mount();
    }

    public function searchManager(): void
    {
        $this->validate(['form.search_manager' => 'required|string|min:3|max:255']);

        $search = trim(strtolower($this->form->search_manager));
        $this->form->potential_managers = User::query()
            ->where('organization_id', Auth::user()->organization->id)
            ->where('company_id', Auth::user()->company->id)
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();
    }

    public function editDepartment(int $id): void
    {
        $this->department = Department::findOrFail($id);
        $this->form->name = $this->department->name;
        $this->form->email = $this->department->email;
        $this->form->description = $this->department->description;
        $this->form->phone = $this->department->phone;
        if ($this->department->manager_id) {
            $manager = User::find($this->department->manager_id);
            $this->form->potential_managers = new Collection([$manager]);
            $this->form->manager = $manager->id;
        } else {
            $this->form->potential_managers = new Collection;
            $this->form->manager = null;
        }
        $this->form->hr_department = $this->department->metadata['hr_department'] ?? false;

        Flux::modal('edit-department-modal')->show();
    }

    public function editModalClosed()
    {
        $this->reset([
            'form.search_manager',
            'form.hr_department',
            'form.manager',
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.department.index');
    }
}
