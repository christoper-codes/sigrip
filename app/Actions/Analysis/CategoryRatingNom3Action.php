<?php

namespace App\Actions\Analysis;

class CategoryRatingNom3Action
{
    public function execute(array $domain_scores): array
    {
        $categories = [

            'Ambiente de trabajo' => [
                'domains' => [
                    'Condiciones en el ambiente de trabajo',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 4],
                    'Bajo' => [5, 8],
                    'Medio' => [9, 10],
                    'Alto' => [11, 13],
                    'Muy alto' => [14, PHP_INT_MAX],
                ],
            ],

            'Factores propios de la actividad' => [
                'domains' => [
                    'Carga de trabajo',
                    'Falta de control sobre el trabajo',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 14],
                    'Bajo' => [15, 29],
                    'Medio' => [30, 44],
                    'Alto' => [45, 59],
                    'Muy alto' => [60, PHP_INT_MAX],
                ],
            ],

            'Organización del tiempo de trabajo' => [
                'domains' => [
                    'Jornada de trabajo',
                    'Interferencia en la relación trabajo-familia',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 4],
                    'Bajo' => [5, 6],
                    'Medio' => [7, 9],
                    'Alto' => [10, 12],
                    'Muy alto' => [13, PHP_INT_MAX],
                ],
            ],

            'Liderazgo y relaciones en el trabajo' => [
                'domains' => [
                    'Liderazgo',
                    'Relaciones en el trabajo',
                    'Violencia',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 13],
                    'Bajo' => [14, 28],
                    'Medio' => [29, 41],
                    'Alto' => [42, 57],
                    'Muy alto' => [58, PHP_INT_MAX],
                ],
            ],

            'Entorno organizacional' => [
                'domains' => [
                    'Reconocimiento del desempeño',
                    'Insuficiente sentido de pertenencia e inestabilidad',
                ],
                'ranges' => [
                    'Nulo o despreciable' => [0, 9],
                    'Bajo' => [10, 13],
                    'Medio' => [14, 17],
                    'Alto' => [18, 22],
                    'Muy alto' => [23, PHP_INT_MAX],
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
