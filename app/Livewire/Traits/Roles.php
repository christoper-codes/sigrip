<?php

namespace App\Livewire\Traits;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;

trait Roles
{
    public array $roles = [];
    public array $user_roles = [];

    public function loadRoles(int $employee_id): void
    {
        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value;
        })->toArray();

        $this->user_roles = User::find($employee_id)
            ->userRoles
            ->toArray();
    }
}
