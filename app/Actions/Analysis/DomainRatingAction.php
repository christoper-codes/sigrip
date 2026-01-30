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
                'ranges' => [
                    'Nulo o despreciable' => [0, 2],
                    'Bajo' => [3, 4],
                    'Medio' => [5, 6],
                    'Alto' => [7, 8],
                    'Muy alto' => [9, PHP_INT_MAX],
                ],
            ],

            'Carga de trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 41, 42, 43],
                'ranges' => [
                    'Nulo o despreciable' => [0, 11],
                    'Bajo' => [12, 15],
                    'Medio' => [16, 19],
                    'Alto' => [20, 23],
                    'Muy alto' => [24, PHP_INT_MAX],
                ],
            ],

            'Falta de control sobre el trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [18, 19, 20, 21, 22, 26, 27],
                'ranges' => [
                    'Nulo o despreciable' => [0, 4],
                    'Bajo' => [5, 7],
                    'Medio' => [8, 10],
                    'Alto' => [11, 13],
                    'Muy alto' => [14, PHP_INT_MAX],
                ],
            ],

            'Jornada de trabajo' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [14, 15],
                'ranges' => [
                    'Nulo o despreciable' => [0, 0],
                    'Bajo' => [1, 1],
                    'Medio' => [2, 3],
                    'Alto' => [4, 5],
                    'Muy alto' => [6, PHP_INT_MAX],
                ],
            ],

            'Interferencia en la relación trabajo-familia' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [16, 17],
                'ranges' => [
                    'Nulo o despreciable' => [0, 0],
                    'Bajo' => [1, 1],
                    'Medio' => [2, 3],
                    'Alto' => [4, 5],
                    'Muy alto' => [6, PHP_INT_MAX],
                ],
            ],

            'Liderazgo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [23, 24, 25, 28, 29],
                'ranges' => [
                    'Nulo o despreciable' => [0, 2],
                    'Bajo' => [3, 4],
                    'Medio' => [5, 7],
                    'Alto' => [8, 10],
                    'Muy alto' => [11, PHP_INT_MAX],
                ],
            ],

            'Relaciones en el trabajo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [30, 31, 32, 44, 45, 46],
                'ranges' => [
                    'Nulo o despreciable' => [0, 4],
                    'Bajo' => [5, 7],
                    'Medio' => [8, 10],
                    'Alto' => [11, 13],
                    'Muy alto' => [14, PHP_INT_MAX],
                ],
            ],

            'Violencia' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [33, 34, 35, 36, 37, 38, 39, 40],
                'ranges' => [
                    'Nulo o despreciable' => [0, 6],
                    'Bajo' => [7, 9],
                    'Medio' => [10, 12],
                    'Alto' => [13, 15],
                    'Muy alto' => [16, PHP_INT_MAX],
                ],
            ],
        ];

        $user_answers = collect($responses)->mapWithKeys(fn ($r) => [
            (int) str_replace('gr2_q', '', $r['question_id']) => (int) $r['value'],
        ]);

        $results = [];
        foreach ($domains as $domain => $config) {
            $score = 0;

            foreach ($config['items'] as $item) {
                $score += $user_answers[$item] ?? 0;
            }

            $results[$domain] = [
                'category' => $config['category'],
                'score' => $score,
                'classification' => $this->classify($score, $config['ranges']),
            ];
        }

        return $results;
    }

    private function classify(int $score, array $ranges): string
    {
        foreach ($ranges as $label => [$min, $max]) {
            if ($score >= $min && $score <= $max) {
                return $label;
            }
        }

        return 'No clasificado';
    }
}
