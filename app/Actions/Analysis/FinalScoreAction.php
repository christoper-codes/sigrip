<?php

namespace App\Actions\Analysis;

class FinalScoreAction
{
    public function execute(array $responses): int
    {
        return collect($responses)
            ->sum(fn ($r) => (int) $r['value']);
    }
}
