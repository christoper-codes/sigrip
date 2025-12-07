<?php

namespace Database\Seeders;

use App\Models\Questionnaire;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Escaneo emocional mensual (NOM-035)',
            'description' => 'Cuestionario para identificar y evaluar los factores de riesgo psicosocial en el entorno laboral, conforme a la NOM-035',
            'metadata' => [],
            'is_active' => true,
        ]);
    }
}
