<?php

declare(strict_types=1);

namespace App\Actions\Application;

use App\Models\IncidentType;
use App\Services\ApplicationAverageService;

final class GeneratePromptAction
{
    public function execute(array $responses, array $questionnaire, bool $auth_required = true): array
    {
        $incident_types = IncidentType::all(['id', 'name'])->toArray();
        $average_score = null;

        $title = $questionnaire['title'];
        $risk_evaluation = $questionnaire['risk_evaluation'] ?? [];
        $themes = $questionnaire['themes'] ?? [];

        $questions_map = [];
        foreach ($themes as $theme) {
            foreach ($theme['questions'] as $q) {
                $questions_map[$q['id']] = $q;
            }
        }

        $answers_analysis = [];
        $total_score = 0;
        $count_numeric = 0;
        $critical_responses = [];
        $has_text = false;
        $has_select = false;

        foreach ($responses as $answer) {
            $question_id = $answer['question_id'] ?? null;
            $value = $answer['value'] ?? null;
            $question = $questions_map[$question_id] ?? [];
            $question_text = $question['text'] ?? 'Pregunta no encontrada';
            $critical_values = $question['critical_values'] ?? [];
            if (is_array($critical_values)) {
                $critical_values = array_map('intval', $critical_values);
            }

            $selected_label = 'Opción no encontrada';
            $q_type = $question['type'] ?? null;
            if (isset($question['options']) && is_array($question['options'])) {
                foreach ($question['options'] as $option) {
                    if (($option['value'] ?? null) == $value) {
                        $selected_label = $option['label'] ?? ('Valor '.$value);
                        break;
                    }
                }
            }
            if ($q_type === 'text') {
                $selected_label = $value;
                $has_text = true;
            }
            if ($q_type === 'select') {
                $has_select = true;
            }

            $answers_analysis[] = "- {$question_text}: {$selected_label} (Valor: {$value})";

            if ($q_type !== 'text' && is_numeric($value)) {
                $total_score += (int) $value;
                $count_numeric++;
            }

            if (is_array($critical_values) && in_array((int) $value, $critical_values, true)) {
                $critical_responses[] = [
                    'question' => $question_text,
                    'question_id' => $question_id,
                    'value' => $value,
                    'label' => $selected_label,
                ];
            }
        }

        if (
            $questionnaire['questionnaire_id'] == 'escaneo_emocional_semanal' ||
            $questionnaire['questionnaire_id'] == 'plan_escaneo_emocional_mensual' ||
            $questionnaire['questionnaire_id'] == 'test_de_honestidad'
        ) {
            $average_score = ApplicationAverageService::calculateGenericAverage(responses: $responses, questions_map: $questions_map);
        }

        $critical_response = false;
        if (count($critical_responses) > 0) {
            $critical_response = true;
        }

        $risk_level = null;
        if (isset($risk_evaluation['red'])) {
            foreach ($risk_evaluation['red'] as $item) {
                if (isset($item['min'], $item['max']) && is_numeric($item['min']) && is_numeric($item['max'])) {
                    if ($average_score >= $item['min'] && $average_score <= $item['max']) {
                        $critical_response = true;
                        $risk_level = 'red';
                        break;
                    }
                }
            }
        }
        if (! $critical_response && isset($risk_evaluation['yellow'])) {
            foreach ($risk_evaluation['yellow'] as $item) {
                if (isset($item['min'], $item['max']) && is_numeric($item['min']) && is_numeric($item['max'])) {
                    if ($average_score >= $item['min'] && $average_score <= $item['max']) {
                        $critical_response = true;
                        $risk_level = 'yellow';
                        break;
                    }
                }
            }
        }

        $type = $has_text && $has_select ? 'mixed' : ($has_text ? 'text' : 'select');

        $format_criteria = function ($color) use ($risk_evaluation) {
            $arr = $risk_evaluation[$color] ?? [];
            if (empty($arr)) {
                return 'No definido';
            }
            $lines = [];
            foreach ($arr as $item) {
                $lines[] = '• '.strtoupper($item['label'] ?? '').': '.($item['criteria'] ?? '').
                    ' (min: '.($item['min'] ?? 'N/A').', max: '.($item['max'] ?? 'N/A').')';
            }

            return implode("\n", $lines);
        };

        $green_criteria = $format_criteria('green');
        $yellow_criteria = $format_criteria('yellow');
        $red_criteria = $format_criteria('red');

        $answers_analysis_str = implode("\n", $answers_analysis);
        $critical_responses_str = $critical_responses
            ? implode("\n", array_map(function ($resp) {
                return "- {$resp['question']}: {$resp['label']} (ID: {$resp['question_id']})";
            }, $critical_responses))
            : 'Ninguna respuesta crítica detectada';

        $questions_alert_ids = $critical_responses
            ? json_encode(array_column($critical_responses, 'question_id'))
            : '[]';

        $reco_user_line = $auth_required
            ? '    "recommendation_for_user": "[recomendación específica y personalizada basada en las respuestas. Y apollo emocional (amplia la respuesta).]",\n'
            : '';

        $incident_types_json = json_encode($incident_types, JSON_UNESCAPED_UNICODE);

        $json_block =
'{
"average_score": [número decimal del puntaje promedio],
"risk_level": "[green/yellow/red basado en criterios]",
"alert": [True si hay riesgo moderado o crítico, False si es verde],
"type_alert": "[yellow/red (en minusculas) si hay alerta, null si no hay alerta]",
"questions_alert": [array de objetos con información completa de preguntas críticas. Incluye question_id, question (texto), value (valor numérico), label (etiqueta seleccionada). Ejemplo: [{\"question_id\": \"q2_base\", \"question\": \"¿Te has sentido estresado/a en el trabajo este mes?\", \"value\": 1, \"label\": \"Sí, constantemente\"}]],'."\n"
.$reco_user_line.
'    "recommendation_for_department": "[recomendación para el departamento o empresa basada en las respuestas del usuario y el nivel de riesgo identificado (agrega ese nivel de riesgo para que el departamento actue).]",
"alert_name": "[crea un nombre corto para la alerta basada en el nivel de riesgo identificado, ejemplo: \'Riesgo Crítico por Respuestas Críticas\' o \'Riesgo Moderado por Puntaje Promedio\' si aplica, de lo contrario \'No Aplica\']",
"subject_alert": "[crea un asunto para la alerta basada en el nivel de riesgo identificado si es que aplica, de lo contrario \'No Aplica\']",
"ticket_data": {
    "incident_type_id": "[id del tipo de incidente seleccionado]",
    "ticket_title": "[título sugerido para el ticket]",
    "ticket_description": "[descripción sugerida para el ticket]"
}
}';

        $instruccion_7 = $auth_required
            ? "7. Genera recomendaciones específicas y accionables para el usuario.\n"
            : '';
        $prompt =
        "Eres un analista experto en bienestar emocional y riesgo psicosocial. Analiza las siguientes respuestas de cuestionario y proporciona una evaluación precisa.

=== INFORMACIÓN DEL CUESTIONARIO ===
Título: {$title}
=== CRITERIOS DE EVALUACIÓN DE RIESGO ===
--- VERDE (Bienestar alto): ---
{$green_criteria}
--- AMARILLO (Riesgo moderado): ---
{$yellow_criteria}
--- ROJO (Riesgo crítico): ---
{$red_criteria}

IMPORTANTE: Cada color contiene un ARRAY de condiciones. Evalúa TODAS las condiciones de cada color. Si una condición se cumple, debe reportarse la alerta correspondiente (puede haber más de una alerta amarilla o roja si varias condiciones se cumplen).

=== RESPUESTAS DEL USUARIO ===
{$answers_analysis_str}

=== DATOS CALCULADOS ===
• Puntaje promedio calculado: ".number_format($average_score, 2).'
• Total de respuestas: '.count($responses).'
• Respuestas críticas detectadas: '.count($critical_responses)."

=== RESPUESTAS CRÍTICAS ===
{$critical_responses_str}

=== IDs DE PREGUNTAS CON ALERTA ===
{$questions_alert_ids}

=== TIPOS DE INCIDENTE DISPONIBLES ===
{$incident_types_json}

=== INSTRUCCIONES ESPECÍFICAS ===
1. Evalúa el nivel de riesgo basándote ESTRICTAMENTE en los arrays de condiciones de cada color (green, yellow, red).
2. Considera tanto el puntaje promedio como las respuestas críticas individuales y cualquier condición especial descrita.
3. Si se cumplen varias condiciones (por ejemplo, una amarilla y una de control), reporta todas las alertas relevantes.
4. Si la alerta es roja (risk_level == 'red'), selecciona el tipo de incidente más adecuado del listado y genera los datos del ticket.
5. Si la alerta no es roja, deja ticket_data vacío o null.
6. Responde ÚNICAMENTE en formato JSON, sin comentarios adicionales.
{$instruccion_7}

RESPONDE SOLO CON EL SIGUIENTE JSON (sin markdown, sin comentarios adicionales):
".$json_block;

        $data = [
            'prompt' => trim($prompt),
            'critical_response' => $critical_response,
            'type' => $type,
            'average_score' => $average_score,
        ];

        return $data;
    }
}
