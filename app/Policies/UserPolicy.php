<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
     /*
    * |--------------------------------------------------------------------------
    * | Custom methods for user authorization
    * |--------------------------------------------------------------------------
    * | User roles and permissions
    */

     public function viewSystemOwner(User $user): bool
     {
        return $user->hasRole('system_owner');
     }

     public function viewCompanyAdmin(User $user): bool
     {
        return $user->hasRole('company_admin');
     }

     public function viewDepartmentManager(User $user): bool
     {
        return $user->hasRole('department_manager');
     }

     public function viewEmployee(User $user): bool
     {
        return $user->hasRole('employee');
     }
}
