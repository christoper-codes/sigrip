<?php

namespace App\Actions\Analysis;

class FinalScoreAction
{
    public function execute(array $responses): array
    {
        $final_score = collect($responses)
            ->sum(fn ($r) => (int) $r['value']);

        $classification = match (true) {
            $final_score < 20  => 'Nulo o despreciable',
            $final_score < 45  => 'Bajo',
            $final_score < 70  => 'Medio',
            $final_score < 90  => 'Alto',
            default            => 'Muy alto',
        };

        return [
            'final_score'   => $final_score,
            'classification'=> $classification,
        ];
    }
}
