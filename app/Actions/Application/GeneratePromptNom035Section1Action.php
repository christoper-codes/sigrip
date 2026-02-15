<?php

declare(strict_types=1);

namespace App\Actions\Application;

use App\Models\IncidentType;

class GeneratePromptNom035Section1Action
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
            $question = $questions_map[$qid] ?? [];
            $question_text = $question['text'] ?? 'Pregunta no encontrada';
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
            if ($value == 1) {
                $has_critical = true;
                $critical_responses[] = [
                    'question' => $question_text,
                    'question_id' => $qid,
                    'value' => $value,
                    'label' => $selected_label,
                ];
            }
        }

        $type = $has_text && $has_select ? 'mixed' : ($has_text ? 'text' : 'select');
        $average_score = null; // Dont apply for this questionnaire
        $critical_response = $has_critical;

        $incident_types_json = json_encode($incident_types, JSON_UNESCAPED_UNICODE);
        $answers_analysis_str = implode("\n", $answers_analysis);
        $critical_responses_str = $critical_responses
            ? implode("\n", array_map(function ($resp) {
                return "- {$resp['question']}: {$resp['label']} (ID: {$resp['question_id']})";
            }, $critical_responses))
            : 'Ninguna respuesta crítica detectada';
        $questions_alert_ids = $critical_responses
            ? json_encode(array_column($critical_responses, 'question_id'))
            : '[]';

        $json_block = '{
"average_score": null,
"risk_level": "[green/red según condición]",
"alert": [true si hay alerta, false si no hay alerta],
"type_alert": "[red si hay alerta, null si no hay alerta]",
"questions_alert": [array de objetos con información completa de preguntas críticas. Incluye question_id, question (texto), value (valor numérico), label (etiqueta seleccionada). Ejemplo: [{"question_id": "gr1_q1", "question": "¿Ha presenciado o sufrido un accidente...?", "value": 1, "label": "Sí"}]],
"recommendation_for_user": "[recomendación específica para el usuario]",
"recommendation_for_department": "[recomendación para el departamento o empresa]",
"alert_name": "[nombre corto para la alerta - (requerira atencion clinica)]",
"subject_alert": "[asunto para la alerta]",
"ticket_data": {
    "incident_type_id": null,
    "ticket_title": "[título sugerido para el ticket]",
    "ticket_description": "[descripción sugerida para el ticket]"
}
}';

        $prompt = "Eres un analista experto en NOM-035. Analiza todas las respuestas del cuestionario. Si al menos una respuesta es 'Sí' (valor 1), la alerta es roja y se requiere atención clínica. Si todas son 'No', no hay alerta.\n\n=== INFORMACIÓN DEL CUESTIONARIO ===\nTítulo: {$title}\n\n=== RESPUESTAS DEL USUARIO ===\n{$answers_analysis_str}\n\n=== RESPUESTAS CRÍTICAS ===\n{$critical_responses_str}\n\n=== IDs DE PREGUNTAS CON ALERTA ===\n{$questions_alert_ids}\n\n=== TIPOS DE INCIDENTE DISPONIBLES ===\n{$incident_types_json}\n\n=== INSTRUCCIONES ESPECÍFICAS ===\n1. Si al menos una respuesta es 'Sí', la alerta es roja y se requiere atención clínica.\n2. Si todas son 'No', no hay alerta.\n3. Responde ÚNICAMENTE en formato JSON, sin comentarios adicionales.\n\nRESPONDE SOLO CON EL SIGUIENTE JSON (sin markdown, sin comentarios adicionales):\n".$json_block;

        $data = [
            'prompt' => trim($prompt),
            'critical_response' => $critical_response,
            'type' => $type,
            'average_score' => $average_score,
        ];

        return $data;
    }
}
