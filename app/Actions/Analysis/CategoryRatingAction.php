<?php

declare(strict_types=1);

namespace App\Actions\Analysis;

class CategoryRatingAction
{
    public function execute(array $domain_scores): array
    {
        $categories = [
            'Ambiente de trabajo' => [
                'domains' => [
                    'Condiciones en el ambiente de trabajo',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 2],
                    'Bajo' => [3, 4],
                    'Medio' => [5, 6],
                    'Alto' => [7, 8],
                    'Muy alto' => [9, PHP_INT_MAX],
                ],
            ],

            'Factores propios de la actividad' => [
                'domains' => [
                    'Carga de trabajo',
                    'Falta de control sobre el trabajo',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 9],
                    'Bajo' => [10, 19],
                    'Medio' => [20, 29],
                    'Alto' => [30, 39],
                    'Muy alto' => [40, PHP_INT_MAX],
                ],
            ],

            'Organización del tiempo de trabajo' => [
                'domains' => [
                    'Jornada de trabajo',
                    'Interferencia en la relación trabajo-familia',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 3],
                    'Bajo' => [4, 5],
                    'Medio' => [6, 8],
                    'Alto' => [9, 11],
                    'Muy alto' => [12, PHP_INT_MAX],
                ],
            ],

            'Liderazgo y relaciones en el trabajo' => [
                'domains' => [
                    'Liderazgo',
                    'Relaciones en el trabajo',
                    'Violencia',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 9],
                    'Bajo' => [10, 17],
                    'Medio' => [18, 27],
                    'Alto' => [28, 37],
                    'Muy alto' => [38, PHP_INT_MAX],
                ],
            ],
        ];

        $results = [];

        foreach ($categories as $category => $config) {
            $score = 0;

            foreach ($config['domains'] as $domain) {
                $score += $domain_scores[$domain]['score'] ?? 0;
            }

            $results[$category] = [
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
