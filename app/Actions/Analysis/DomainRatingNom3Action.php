<?php

namespace App\Actions\Analysis;

class DomainRatingNom3Action
{
    public function execute(array $responses): array
    {
        $domains = [

            'Condiciones en el ambiente de trabajo' => [
                'category' => 'Ambiente de trabajo',
                'items' => [1, 2, 3, 4, 5],
                'ranges' => [
                    'Nulo o despreciable' => [0, 4],
                    'Bajo' => [5, 8],
                    'Medio' => [9, 10],
                    'Alto' => [11, 13],
                    'Muy alto' => [14, PHP_INT_MAX],
                ],
            ],

            'Carga de trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [6,7,8,9,10,11,12,13,14,15,16,65,66,67,68],
                'ranges' => [
                    'Nulo o despreciable' => [0, 14],
                    'Bajo' => [15, 20],
                    'Medio' => [21, 26],
                    'Alto' => [27, 36],
                    'Muy alto' => [37, PHP_INT_MAX],
                ],
            ],

            'Falta de control sobre el trabajo' => [
                'category' => 'Factores propios de la actividad',
                'items' => [23,24,25,26,27,28,29,30,35,36],
                'ranges' => [
                    'Nulo o despreciable' => [0, 10],
                    'Bajo' => [11, 15],
                    'Medio' => [16, 20],
                    'Alto' => [21, 24],
                    'Muy alto' => [25, PHP_INT_MAX],
                ],
            ],

            'Jornada de trabajo' => [
                'category' => 'Organización del tiempo de trabajo',
                'items' => [17,18],
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
                'items' => [19,20,21,22],
                'ranges' => [
                    'Nulo o despreciable' => [0, 3],
                    'Bajo' => [4, 5],
                    'Medio' => [6, 7],
                    'Alto' => [8, 9],
                    'Muy alto' => [10, PHP_INT_MAX],
                ],
            ],

            'Liderazgo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [31,32,33,34,37,38,39,40,41],
                'ranges' => [
                    'Nulo o despreciable' => [0, 8],
                    'Bajo' => [9, 11],
                    'Medio' => [12, 15],
                    'Alto' => [16, 19],
                    'Muy alto' => [20, PHP_INT_MAX],
                ],
            ],

            'Relaciones en el trabajo' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [42,43,44,45,46,69,70,71,72],
                'ranges' => [
                    'Nulo o despreciable' => [0, 9],
                    'Bajo' => [10, 12],
                    'Medio' => [13, 16],
                    'Alto' => [17, 20],
                    'Muy alto' => [21, PHP_INT_MAX],
                ],
            ],

            'Violencia' => [
                'category' => 'Liderazgo y relaciones en el trabajo',
                'items' => [57,58,59,60,61,62,63,64],
                'ranges' => [
                    'Nulo o despreciable' => [0, 6],
                    'Bajo' => [7, 9],
                    'Medio' => [10, 12],
                    'Alto' => [13, 15],
                    'Muy alto' => [16, PHP_INT_MAX],
                ],
            ],

            'Reconocimiento del desempeño' => [
                'category' => 'Entorno organizacional',
                'items' => [47,48,49,50,51,52],
                'ranges' => [
                    'Nulo o despreciable' => [0, 5],
                    'Bajo' => [6, 9],
                    'Medio' => [10, 13],
                    'Alto' => [14, 17],
                    'Muy alto' => [18, PHP_INT_MAX],
                ],
            ],

            'Insuficiente sentido de pertenencia e inestabilidad' => [
                'category' => 'Entorno organizacional',
                'items' => [53,54,55,56],
                'ranges' => [
                    'Nulo o despreciable' => [0, 3],
                    'Bajo' => [4, 5],
                    'Medio' => [6, 7],
                    'Alto' => [8, 9],
                    'Muy alto' => [10, PHP_INT_MAX],
                ],
            ],
        ];

        $user_answers = collect($responses)->mapWithKeys(fn ($r) => [
            (int) str_replace('gr3_q', '', $r['question_id']) => (int) $r['value'],
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


