<?php

namespace App\Actions\Analysis;

class GetAlertResponsesAction
{
    public function execute(array $response, array $themes): array
    {
        $alerts = $response['ai_response']['questions_alert'] ?? [];
        $alert_responses = [];
        foreach ($themes as $theme) {
            $theme_alerts = [];
            foreach ($theme['questions'] as $q) {
                $alert = collect($alerts)->firstWhere('question_id', $q['id']);
                if (! $alert) {
                    continue;
                }

                $theme_alerts[] = [
                    'id' => isset($q['id']) ? substr($q['id'], strrpos($q['id'], '_') + 1) : null,
                    'question' => $alert['question'] ?? $q['text'] ?? null,
                    'label'    => $alert['label'] ?? null,
                    'value'    => $alert['value'] ?? null,
                ];
            }

            if (count($theme_alerts)) {
                $alert_responses[] = [
                    'theme_name'        => $theme['name'] ?? '',
                    'theme_description' => $theme['description'] ?? '',
                    'questions'         => $theme_alerts,
                ];
            }
        }

        return $alert_responses;
    }
}
