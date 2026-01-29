<?php

namespace App\Actions\Analysis;

class CategoryRatingAction
{
    public function execute(array $domain_scores): array
    {
        $categories = [
            'Ambiente de trabajo' => [
                'Condiciones en el ambiente de trabajo',
            ],
            'Factores propios de la actividad' => [
                'Carga de trabajo',
                'Falta de control sobre el trabajo',
            ],
            'Organización del tiempo de trabajo' => [
                'Jornada de trabajo',
                'Interferencia en la relación trabajo-familia',
            ],
            'Liderazgo y relaciones en el trabajo' => [
                'Liderazgo',
                'Relaciones en el trabajo',
            ],
            'Violencia' => [
                'Violencia',
            ],
        ];

        $category_scores = [];

        foreach ($categories as $category => $domains) {
            $score = 0;
            foreach ($domains as $domain) {
                $score += $domain_scores[$domain] ?? 0;
            }
            $category_scores[$category] = $score;
        }

        return $category_scores;
    }
}
