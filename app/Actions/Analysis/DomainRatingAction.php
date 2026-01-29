<?php

namespace App\Actions\Analysis;

class DomainRatingAction
{
    public function execute(array $responses): array
    {
        $domains = [
            'Condiciones en el ambiente de trabajo' => [
                1, 2, 3
            ],
            'Carga de trabajo' => [
                4, 5, 6, 7, 8, 9,
                10, 11, 12, 13,
                41, 42, 43,
            ],
            'Falta de control sobre el trabajo' => [
                18, 19,
                20, 21, 22,
                26, 27,
            ],
            'Jornada de trabajo' => [
                14, 15,
            ],
            'Interferencia en la relación trabajo-familia' => [
                16, 17,
            ],
            'Liderazgo' => [
                23, 24, 25,
                28, 29,
            ],
            'Relaciones en el trabajo' => [
                30, 31, 32,
                44, 45, 46,
            ],
            'Violencia' => [
                33, 34, 35, 36,
                37, 38, 39, 40,
            ],
        ];

        $user_answers = collect($responses)->mapWithKeys(function ($response) {
            return [
                intval(str_replace('gr2_q', '', $response['question_id'])) => (int) $response['value']
            ];
        });

        $domain_scores = [];
        foreach ($domains as $domain_name => $items) {
            $score = 0;
            foreach ($items as $item) {
                $score += $user_answers[$item] ?? 0;
            }
            $domain_scores[$domain_name] = $score;
        }

        return $domain_scores;
    }
}
