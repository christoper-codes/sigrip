<?php

namespace Database\Seeders;

use App\Models\SupportTicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportTicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupportTicketStatus::create([
            'name' => 'Abierto',
            'description' => 'El ticket ha sido creado y está pendiente de ser atendido.',
            'color' => 'blue',
            'is_active' => true,
        ]);
        SupportTicketStatus::create([
            'name' => 'En proceso',
            'description' => 'El ticket está siendo atendido y se están tomando acciones.',
            'color' => 'orange',
            'is_active' => true,
        ]);
        SupportTicketStatus::create([
            'name' => 'Resuelto',
            'description' => 'El incidente ha sido atendido y se considera resuelto.',
            'color' => 'green',
            'is_active' => true,
        ]);
        SupportTicketStatus::create([
            'name' => 'Cerrado',
            'description' => 'El ticket ha sido cerrado definitivamente.',
            'color' => 'red',
            'is_active' => true,
        ]);
    }
}
