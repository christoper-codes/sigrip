<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AlertType;
use Illuminate\Database\Seeder;

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlertType::create([
            'name' => 'Nivel de riesgo moderado',
            'color' => 'yellow',
            'description' => 'Se recomienda monitorear y tomar medidas preventivas para evitar un aumento en el nivel de riesgo.',
        ]);

        AlertType::create([
            'name' => 'Nivel de riesgo alto',
            'color' => 'red',
            'description' => 'Se requiere intervención inmediata para mitigar los riesgos identificados y proteger el bienestar del usuario.',
        ]);
    }
}
