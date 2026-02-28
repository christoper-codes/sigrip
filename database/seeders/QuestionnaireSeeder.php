<?php

declare(strict_types=1);

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
        $nom035_1 = file_get_contents(database_path('seeders/data/NOM035_01.json'));
        $nom035_2 = file_get_contents(database_path('seeders/data/NOM035_02.json'));
        $nom035_3 = file_get_contents(database_path('seeders/data/NOM035_03.json'));

        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Guia de Referencia I - (NOM-035)',
            'description' => 'Identificación de trabajadores sujetos a acontecimientos traumáticos severos',
            'metadata' => json_decode($nom035_1, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Guia de Referencia II - (NOM-035)',
            'description' => 'Identificación y evaluación de los factores de riesgo psicosocial en el entorno laboral',
            'metadata' => json_decode($nom035_2, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Guia de Referencia III - (NOM-035)',
            'description' => 'Identificación y evaluación de los factores de riesgo psicosocial en el entorno laboral',
            'metadata' => json_decode($nom035_3, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 1,
            'organization_id' => 1,
            'name' => 'Escaneo emocional mensual',
            'description' => 'Cuestionario para identificar y evaluar los factores de riesgo psicosocial en el entorno laboral',
            'metadata' => json_decode($monthly_scan, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 2,
            'organization_id' => 1,
            'name' => 'Escaneo emocional semanal',
            'description' => 'Cuestionario semanal para monitorear el bienestar emocional de los empleados',
            'metadata' => json_decode($weekly_scan, true),
            'is_base' => true,
            'is_active' => true,
        ]);

        Questionnaire::create([
            'questionnaire_category_id' => 3,
            'organization_id' => 1,
            'name' => 'Test de honestidad laboral',
            'description' => 'Evaluación diseñada para medir la honestidad y la integridad de los empleados en el entorno laboral.',
            'metadata' => json_decode($honestly_test, true),
            'is_base' => true,
            'is_active' => true,
        ]);
    }
}
