<?php

namespace App\Livewire\Traits;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

trait Roles
{
    public array $roles = [];
    public array $employee_roles = [];
    public ?int $selected_employee_id = null;

    public function loadRoles(int $employee_id): void
    {
        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value;
        })->toArray();

        $this->employee_roles = User::find($employee_id)
            ->userRoles
            ->pluck('id')
            ->toArray();
    }

    public function updateRoles(): void
    {
        $user = User::find($this->selected_employee_id);
        $user->userRoles()->sync($this->employee_roles);

        $this->dispatch('toast', message: __('Roles actualizados correctamente.'), type: 'success');
    }
}
