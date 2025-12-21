<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'organization_id' => 1,
            'name' => 'Christoper Patiño Santos',
            'email' => 'chris@krodox.com',
            'password' => bcrypt('12345678'),
            'metadata' => [
                'notifications' => 0,
                'alerts' => 0,
                'tickets' => 0,
            ],
            'is_active' => true,
        ]);

        $user->userRoles()->attach(1);
    }
}
