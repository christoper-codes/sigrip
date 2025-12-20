<?php

namespace App\Services;

class ApplicationAverageService
{
    public static function calculateGenericAverage(array $responses, array $questions_map): float
    {
        $total = 0;
        $count = 0;
        foreach ($responses as $answer) {
            $question_id = $answer['question_id'] ?? null;
            $value = $answer['value'] ?? null;
            $question = $questions_map[$question_id] ?? [];
            if (($question['type'] ?? null) === 'select' && is_numeric($value)) {
                $total += (int)$value;
                $count++;
            }
        }
        return $count > 0 ? $total / $count : 0;
    }
}
