<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;

class UserPolicy
{
    public function viewSystemOwner(User $user): bool
    {
        return $user->hasRole(role: RoleEnum::SYSTEM_OWNER->value);
    }

    public function viewCompanyAdmin(User $user): bool
    {
        return $user->hasRole(role: RoleEnum::COMPANY_ADMIN->value);
    }

    public function viewDepartmentManager(User $user): bool
    {
        return $user->hasRole(role: RoleEnum::DEPARTMENT_MANAGER->value);
    }

    public function viewEmployee(User $user): bool
    {
        return $user->hasRole(role:RoleEnum::EMPLOYEE->value);
    }
}
