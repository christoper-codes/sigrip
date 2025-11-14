<?php

namespace App\Livewire\Employee;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Update extends Component
{
    public int $employee_id;
    public array $roles = [];
    public array $user_roles = [];

    public function mount(): void
    {
        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value;
        })->toArray();

        $this->user_roles = User::find($this->employee_id)
            ->userRoles
            ->toArray();
    }
}
