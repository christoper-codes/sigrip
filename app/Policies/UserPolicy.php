<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewSystemOwner(User $user): bool
    {
        return $user->hasRole(role:'propietario');
    }

    public function viewCompanyAdmin(User $user): bool
    {
        return $user->hasRole(role:'administrador');
    }

    public function viewDepartmentManager(User $user): bool
    {
        return $user->hasRole(role:'gerente');
    }

    public function viewEmployee(User $user): bool
    {
        return $user->hasRole(role:'empleado');
    }
}
