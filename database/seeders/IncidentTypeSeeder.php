<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncidentType::create([
            'name' => 'Acoso laboral',
            'description' => 'Situaciones de hostigamiento, intimidación o maltrato en el entorno de trabajo por parte de compañeros o superiores.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Estrés laboral',
            'description' => 'Manifestaciones de tensión, ansiedad o agotamiento derivadas de la carga o condiciones de trabajo.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Conflicto interpersonal',
            'description' => 'Problemas o desacuerdos entre empleados que afectan el ambiente laboral.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Discriminación',
            'description' => 'Trato desigual o injusto por motivos de género, edad, orientación sexual, religión, discapacidad u otros.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Problemas personales',
            'description' => 'Situaciones personales o familiares que afectan el bienestar emocional del empleado.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Violencia laboral',
            'description' => 'Agresiones físicas o verbales ocurridas en el entorno de trabajo.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Falta de reconocimiento',
            'description' => 'Percepción de que el esfuerzo o los logros no son valorados por la empresa o superiores.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Sobrecarga de trabajo',
            'description' => 'Exceso de tareas o responsabilidades que generan presión y afectan la salud mental.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Ambiente laboral tóxico',
            'description' => 'Clima organizacional negativo, falta de apoyo, rumores o actitudes destructivas.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Problemas de liderazgo',
            'description' => 'Dificultades derivadas de la gestión, comunicación o toma de decisiones de los líderes.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Acoso sexual',
            'description' => 'Conductas de naturaleza sexual no deseadas que generan incomodidad o afectan la dignidad del empleado.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Falta de recursos',
            'description' => 'Insuficiencia de herramientas, materiales o apoyo para realizar el trabajo adecuadamente.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Problemas de salud mental',
            'description' => 'Manifestaciones de ansiedad, depresión, insomnio u otros síntomas que afectan el bienestar emocional.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Desmotivación',
            'description' => 'Falta de interés, entusiasmo o sentido de propósito en el trabajo.',
            'is_active' => true,
            'is_base' => true,
        ]);
        IncidentType::create([
            'name' => 'Otros',
            'description' => 'Cualquier otro incidente que no se encuentre en las categorías anteriores.',
            'is_active' => true,
            'is_base' => true,
        ]);
    }
}
