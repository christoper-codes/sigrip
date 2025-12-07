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
        $monthly_scan = file_get_contents(database_path('seeders/data/monthly_scan_001.json'));
        $weekly_scan = file_get_contents(database_path('seeders/data/weekly_scan_001.json'));
        $honestly_test = file_get_contents(database_path('seeders/data/honestly_test_001.json'));

        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Escaneo emocional mensual (NOM-035)',
            'description' => 'Cuestionario para identificar y evaluar los factores de riesgo psicosocial en el entorno laboral, conforme a la NOM-035',
            'metadata' => json_decode($monthly_scan, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 2,
            'organization_id' => 1,
            'name' => 'Escaneo emocional semanal (NOM-035)',
            'description' => 'Cuestionario semanal para monitorear el bienestar emocional de los empleados, conforme a la NOM-035',
            'metadata' => json_decode($weekly_scan, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 3,
            'organization_id' => 1,
            'name' => 'Test de honestidad laboral (NOM-035)',
            'description' => 'Evaluación diseñada para medir la honestidad y la integridad de los empleados en el entorno laboral.',
            'metadata' => json_decode($honestly_test, true),
            'is_base' => true,
            'is_active' => true,
        ]);
    }
}
