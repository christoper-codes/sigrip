<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            RoleSeeder::class,
            QuestionnaireCategorySeeder::class,
            QuestionnaireSeeder::class,
            UserSeeder::class,
            AlertTypeSeeder::class,
            IncidentTypeSeeder::class,
            SupportTicketStatusSeeder::class,
        ]);
    }
}
