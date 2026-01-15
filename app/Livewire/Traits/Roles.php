<?php

namespace App\Livewire\Traits;

use App\Enums\NotificationTypesEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

trait Roles
{
    public array $headers = [];
    public array $roles = [];
    public array $employee_roles = [];
    public ?int $selected_employee_id = null;

    public function loadRoles(int $employee_id): void
    {
        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value && $role->name !== RoleEnum::COMPANY_ADMIN->value;
        })->toArray();

        $this->employee_roles = User::find($employee_id)
            ->userRoles
            ->pluck('id')
            ->toArray();
    }

    public function updateRoles(): void
    {
        if(! $this->employee_roles){
            $this->dispatch('toast', message: __('Debe seleccionar al menos un rol.'), type: NotificationTypesEnum::ERROR->value);
            return;
        }

        $user = User::find($this->selected_employee_id);
        $user->userRoles()->sync($this->employee_roles);

        $this->dispatch('toast', message: __('Roles actualizados correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
    }
}
