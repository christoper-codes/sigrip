<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'image_id' => null,
            'address_id' => null,
            'name' => 'Neura Inc.',
            'description' => 'Neura company, dedicated to providing psychosocial software services.',
            'metadata' => null,
        ]);
    }
}
