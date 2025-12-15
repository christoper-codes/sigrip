<?php

namespace App\Actions\Questionnaire;
use Illuminate\Support\Str;

final class BuildMetadataAction
{
    public function execute(
        array $rows,
        array $yellow_risk_evaluation,
        array $red_risk_evaluation,
        string $title,
        string $subtitle,
        array $instructions,
        array $objectives
    ): array
    {
        $themes = [];
        foreach ($rows as $row) {
            $theme = trim($row['tema']);
            $description = trim($row['descripcion']);
            $type = strtolower(trim($row['tipo_de_respuesta']));
            $question = [
                'id' => Str::uuid()->toString(),
                'text' => trim($row['pregunta']),
                'type' => $type,
                'options' => null,
                'month' => $row['mes'] ?? null,
                'week' => $row['semana'] ?? null,
                'is_fixed' => false,
                'critical_values' => null,
                'weight' => $row['peso_de_pregunta'],
            ];

            if ($type === 'select') {
                $opts = preg_split('/\.\s*/', $row['opciones_y_valores'] ?? '', -1, PREG_SPLIT_NO_EMPTY);
                $question['options'] = [];
                foreach ($opts as $opt) {
                    [$value, $label] = explode(':', $opt, 2);
                    $question['options'][] = [
                        'value' => (int)trim($value),
                        'label' => trim($label),
                    ];
                }
                $question['critical_values'] = isset($row['valores_criticos']) && $row['valores_criticos'] !== ''
                    ? array_map('intval', explode(',', str_replace(' ', '', $row['valores_criticos'])))
                    : null;
            }

            $theme_key = $theme . '|' . $description;
            if (!isset($themes[$theme_key])) {
                $themes[$theme_key] = [
                    'name' => $theme,
                    'description' => $description,
                    'questions' => [],
                ];
            }
            $themes[$theme_key]['questions'][] = $question;
        }

        $themes = array_values($themes);

        $risk_evaluation = [
            'green' => [["label" => __("Bienestar alto"), "criteria" => __("Sin respuestas críticas")]],
            'yellow' => $yellow_risk_evaluation,
            'red' => $red_risk_evaluation,
        ];

        $metadata = [
            'questionnaire_id' => Str::replace(' ', '_', strtolower($title)) . '_' . time(),
            'title' => $title,
            'subtitle' => $subtitle,
            'instructions' => $instructions,
            'objectives' => $objectives,
            'themes' => $themes,
            'risk_evaluation' => $risk_evaluation,
        ];

        return $metadata;
    }
}
