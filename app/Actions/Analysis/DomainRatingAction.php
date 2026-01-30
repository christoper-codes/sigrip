<?php

namespace App\Actions\Analysis;

class DomainRatingAction
{
    public function execute(array $responses): array
    {
        $domains = [
            'Condiciones en el ambiente de trabajo' => [
                'category' => 'Ambiente de trabajo',
                'items' => [1, 2, 3],
            ],

            'Carga de trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [
                    4, 5, 6, 7, 8, 9,
                    10, 11, 12, 13,
                    41, 42, 43,
                ],
            ],

            'Falta de control sobre el trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [18, 19, 20, 21, 22, 26, 27],
            ],

            'Jornada de trabajo' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [14, 15],
            ],

            'Interferencia en la relación trabajo-familia' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [16, 17],
            ],

            'Liderazgo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [23, 24, 25, 28, 29],
            ],

            'Relaciones en el trabajo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [30, 31, 32, 44, 45, 46],
            ],

            'Violencia' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [33, 34, 35, 36, 37, 38, 39, 40],
            ],
        ];

        $user_answers = collect($responses)->mapWithKeys(fn ($response) => [
            (int) str_replace('gr2_q', '', $response['question_id']) => (int) $response['value'],
        ]);

        $domain_scores = [];

        foreach ($domains as $domain_name => $config) {
            $score = 0;

            foreach ($config['items'] as $item) {
                $score += $user_answers[$item] ?? 0;
            }

            $domain_scores[$domain_name] = [
                'score' => $score,
                'category' => $config['category'],
            ];
        }

        return $domain_scores;
    }
}
