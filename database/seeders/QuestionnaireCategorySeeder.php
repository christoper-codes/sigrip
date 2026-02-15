<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\QuestionnaireCategory;
use Illuminate\Database\Seeder;

class QuestionnaireCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuestionnaireCategory::create([
            'name' => 'Factores de riesgo psicosocial',
            'description' => 'Medir factores de riesgo psicosocial en el trabajo. Identificación, análisis y prevención',
            'is_active' => true,
        ]);

        QuestionnaireCategory::create([
            'name' => 'Bienestar y monitoreo emocional',
            'description' => 'Monitorear el bienestar emocional y psicológico de los empleados',
            'is_active' => true,
        ]);

        QuestionnaireCategory::create([
            'name' => 'Evaluación ética y honestidad',
            'description' => 'Medir integridad, transparencia y comportamiento ético en el entorno laboral',
            'is_active' => true,
        ]);
    }
}
