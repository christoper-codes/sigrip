<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewSystemOwner(User $user): bool
    {
        return $user->hasRole(role:'system_owner');
    }

    public function viewCompanyAdmin(User $user): bool
    {
        return $user->hasRole(role:'company_admin');
    }

    public function viewDepartmentManager(User $user): bool
    {
        return $user->hasRole(role:'department_manager');
    }

    public function viewEmployee(User $user): bool
    {
        return $user->hasRole(role:'employee');
    }
}
