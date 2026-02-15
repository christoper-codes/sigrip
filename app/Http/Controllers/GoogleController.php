<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            $organization_by_default = Organization::where('name', 'neura')->first();
            $role_by_default = Role::where('name', RoleEnum::COMPANY_ADMIN->value)->first();

            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(str()->random(16)),
                'metadata' => [
                    'notifications' => 0,
                    'alerts' => 0,
                    'tickets' => 0,
                ],
                'organization_id' => $organization_by_default->id,
            ]);

            $user->userRoles()->attach($role_by_default->id);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}
