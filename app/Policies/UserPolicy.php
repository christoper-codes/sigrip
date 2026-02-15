<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;

class UserPolicy
{
    private function permission(array $roles, User $user): bool
    {
        return $user->userRoles()
            ->whereIn('name', $roles)
            ->exists();
    }

    public function viewSystemOwner(User $user): bool
    {
        if ($user->hasRole(role: RoleEnum::SYSTEM_OWNER->value)) {
            return true;
        }

        return false;
    }

    public function viewCompanyAdmin(User $user): bool
    {
        if ($user->hasRole(role: RoleEnum::COMPANY_ADMIN->value)) {
            return true;
        }

        $roles = [
            RoleEnum::SYSTEM_OWNER->value,
        ];

        return $this->permission(roles: $roles, user: $user);
    }

    public function viewDepartmentManager(User $user): bool
    {
        if ($user->hasRole(role: RoleEnum::DEPARTMENT_MANAGER->value)) {
            return true;
        }

        $roles = [
            RoleEnum::SYSTEM_OWNER->value,
            RoleEnum::COMPANY_ADMIN->value,
        ];

        return $this->permission(roles: $roles, user: $user);
    }

    public function viewEmployee(User $user): bool
    {
        if ($user->hasRole(role: RoleEnum::EMPLOYEE->value)) {
            return true;
        }

        $roles = [
            RoleEnum::SYSTEM_OWNER->value,
            RoleEnum::COMPANY_ADMIN->value,
            RoleEnum::DEPARTMENT_MANAGER->value,
        ];

        return $this->permission(roles: $roles, user: $user);
    }
}
