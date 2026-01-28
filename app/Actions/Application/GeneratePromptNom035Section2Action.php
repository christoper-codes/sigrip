<?php

namespace App\Actions\Application;

use App\Models\IncidentType;

class GeneratePromptNom035Section2Action
{
    public function execute(array $responses, array $questionnaire, bool $auth_required = false): array
    {
        $incident_types = IncidentType::all(['id', 'name'])->toArray();
        $title = $questionnaire['title'] ?? '';
        $themes = $questionnaire['themes'] ?? [];

        $questions_map = [];
        foreach ($themes as $theme) {
            foreach ($theme['questions'] as $q) {
                $questions_map[$q['id']] = $q;
            }
        }

        $answers_analysis = [];
        $critical_responses = [];
        $has_text = false;
        $has_select = false;
        $has_critical = false;

        foreach ($responses as $answer) {
            $qid = $answer['question_id'] ?? null;
            $value = $answer['value'] ?? null;
            $critical_values = $answer['critical_values'] ?? null;

            $question = $questions_map[$qid] ?? [];
            $question_text = $question['text'] ?? 'Pregunta no encontrada';
            $q_type = $question['type'] ?? null;

            $selected_label = 'Opción no encontrada';

            if (isset($question['options']) && is_array($question['options'])) {
                foreach ($question['options'] as $option) {
                    if ((string) ($option['value'] ?? '') === (string) $value) {
                        $selected_label = $option['label'] ?? ('Valor ' . $value);
                        break;
                    }
                }
            }

            if ($q_type === 'text') {
                $selected_label = (string) $value;
                $has_text = true;
            }

            if ($q_type === 'select') {
                $has_select = true;
            }

            $answers_analysis[] = "- {$question_text}: {$selected_label} (Valor: {$value})";

            $is_critical = false;
            if (
                is_array($critical_values) &&
                in_array((int) $value, $critical_values, true)
            ) {
                $is_critical = true;
            }

            if ($is_critical) {
                $has_critical = true;
                $critical_responses[] = [
                    'question_id' => $qid,
                    'question'    => $question_text,
                    'value'       => (int) $value,
                    'label'       => $selected_label,
                ];
            }
        }

        $type = $has_text && $has_select
            ? 'mixed'
            : ($has_text ? 'text' : 'select');

        $average_score = null;
        $critical_response = $has_critical;

        $answers_analysis_str = implode("\n", $answers_analysis);

        $critical_responses_str = $critical_responses
            ? implode("\n", array_map(function ($resp) {
                return "- {$resp['question']}: {$resp['label']} (ID: {$resp['question_id']})";
            }, $critical_responses))
            : 'Ninguna respuesta crítica detectada';

        $questions_alert_ids = json_encode(
            array_column($critical_responses, 'question_id'),
            JSON_UNESCAPED_UNICODE
        );

        $incident_types_json = json_encode($incident_types, JSON_UNESCAPED_UNICODE);

        $json_block = '{
  "average_score": null,
  "risk_level": "[green/yellow/orange/red según análisis]",
  "alert": [true si hay alerta, false si no hay alerta],
  "type_alert": "[red/orange/yellow/null]",
  "questions_alert": [],
  "recommendation_for_user": "",
  "recommendation_for_department": "",
  "alert_name": "",
  "subject_alert": "",
  "ticket_data": {
    "incident_type_id": null,
    "ticket_title": "",
    "ticket_description": ""
  }
}';

        $prompt = "
Eres un analista experto en NOM-035 (Guía de Referencia II).
Analiza únicamente las respuestas que han sido marcadas como críticas,
es decir, aquellas cuyo valor coincide con sus critical_values.
Si no existen respuestas críticas, el riesgo es bajo o nulo.

=== INFORMACIÓN DEL CUESTIONARIO ===
Título: {$title}

=== RESPUESTAS DEL USUARIO ===
{$answers_analysis_str}

=== RESPUESTAS CRÍTICAS ===
{$critical_responses_str}

=== IDS DE PREGUNTAS CRÍTICAS ===
{$questions_alert_ids}

=== TIPOS DE INCIDENTE DISPONIBLES ===
{$incident_types_json}

=== INSTRUCCIONES ===
1. Analiza SOLO las respuestas críticas.
2. Determina el nivel de riesgo psicosocial.
3. Responde ÚNICAMENTE en formato JSON.
4. No agregues comentarios ni markdown.

RESPONDE SOLO CON ESTE JSON:
{$json_block}
";

        return [
            'prompt'            => trim($prompt),
            'critical_response' => $critical_response,
            'type'              => $type,
            'average_score'     => $average_score,
        ];
    }
}
