<?php

namespace App\Livewire\Department;

use App\Enums\NotificationTypesEnum;
use App\Enums\RoleEnum;
use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Store extends Component
{
    public DepartmentForm $form;

    public function submit(): void
    {
        $this->validate();

        $hr_department = Department::where('company_id', Auth::user()->company->id)
            ->where('metadata->hr_department', true)
            ->exists();
        if($this->form->hr_department && $hr_department) {
            $this->dispatch('toast', message: __('Ya existe un departamento de RRHH en esta compañía.'), type: 'error');
            return;
        }

        if($this->form->save_manager && $this->form->manager) {
            $potential_manager = User::find($this->form->manager)->userRoles()
                ->where('name', RoleEnum::DEPARTMENT_MANAGER->value)
                ->exists();
            if (! $potential_manager) {
                $this->dispatch('toast', message: __('El empleado seleccionado no tiene el rol de Gerente'), type: 'error');
                return;
            }
        }

        $metadata = ['hr_department' => $this->form->hr_department];
        $department = Department::create([
            'organization_id' => Auth::user()->organization->id,
            'company_id' => Auth::user()->company->id,
            'name' => $this->form->name,
            'email' => $this->form->email,
            'description' => $this->form->description,
            'metadata' => $metadata,
            'manager_id' => $this->form->manager,
        ]);

        if ($this->form->hr_department) {
            Auth::user()->update(['department_id' => $department->id]);
            $this->dispatch('steps-completed');
            $this->dispatch('nextStep');
        }

        $this->dispatch('toast', message: __('Departamento creado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset();
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
}
