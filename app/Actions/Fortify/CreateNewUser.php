<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Enums\RoleEnum;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $metadata = [
            'notifications' => 0,
            'alerts' => 0,
            'tickets' => 0,
        ];
        $organization_by_default = Organization::where('name', 'neura')->first();
        $role_by_default = Role::where('name', RoleEnum::COMPANY_ADMIN->value)->first();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'metadata' => $metadata,
            'organization_id' => $organization_by_default->id,
        ]);

        $user->userRoles()->attach($role_by_default->id);

        return $user;
    }
}
