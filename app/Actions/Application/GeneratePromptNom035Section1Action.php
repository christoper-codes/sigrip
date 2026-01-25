<?php

namespace App\Actions\Application;

use App\Models\IncidentType;

class GeneratePromptNom035Section1Action
{
    public function execute(array $responses, array $questionnaire, bool $auth_required = false): array
    {
        $incident_types = IncidentType::all(['id', 'name'])->toArray();
        $title = $questionnaire['title'] ?? '';
        $themes = $questionnaire['themes'] ?? [];
        $section1_questions = [];
        foreach ($themes as $theme) {
            if (isset($theme['section_code']) && $theme['section_code'] === 'I') {
                foreach ($theme['questions'] as $q) {
                    $section1_questions[$q['id']] = $q;
                }
                break;
            }
        }

        $answers_analysis = [];
        $critical_responses = [];
        $has_critical = false;
        foreach ($responses as $answer) {
            $qid = $answer['question_id'] ?? null;
            $value = $answer['value'] ?? null;
            if (isset($section1_questions[$qid])) {
                $question_text = $section1_questions[$qid]['text'] ?? 'Pregunta no encontrada';
                $selected_label = $value == 1 ? 'Sí' : 'No';
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
        }

        $risk_level = $has_critical ? 'red' : 'green';
        $alert = $has_critical;
        $type = 'select';
        $average_score = null; // No aplica para sección 1
        $critical_response = $has_critical;

        $answers_analysis_str = implode("\n", $answers_analysis);
        $incident_types_json = json_encode($incident_types, JSON_UNESCAPED_UNICODE);
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
"alert": [true si hay al menos una respuesta afirmativa, false si todas son no],
"type_alert": "[red si hay alerta, null si no hay alerta]",
"questions_alert": [array de objetos con información completa de preguntas críticas. Incluye question_id, question (texto), value (valor numérico), label (etiqueta seleccionada). Ejemplo: [{"question_id": "gr1_q1", "question": "¿Ha presenciado o sufrido un accidente...?", "value": 1, "label": "Sí"}]]
}';

        $prompt = "Eres un analista experto en NOM-035. Analiza las respuestas de la sección I (acontecimiento traumático severo). Si al menos una respuesta es 'Sí', la alerta es roja y se requiere atención clínica. Si todas son 'No', no hay alerta.\n\n=== INFORMACIÓN DEL CUESTIONARIO ===\nTítulo: {$title}\n\n=== RESPUESTAS DEL USUARIO ===\n{$answers_analysis_str}\n\n=== RESPUESTAS CRÍTICAS ===\n{$critical_responses_str}\n\n=== IDs DE PREGUNTAS CON ALERTA ===\n{$questions_alert_ids}\n\n=== TIPOS DE INCIDENTE DISPONIBLES ===\n{$incident_types_json}\n\n=== INSTRUCCIONES ESPECÍFICAS ===\n1. Si al menos una respuesta es 'Sí', la alerta es roja y se requiere atención clínica.\n2. Si todas son 'No', no hay alerta.\n3. Responde ÚNICAMENTE en formato JSON, sin comentarios adicionales.\n\nRESPONDE SOLO CON EL SIGUIENTE JSON (sin markdown, sin comentarios adicionales):\n" . $json_block;

        $data = [
            'prompt' => trim($prompt),
            'critical_response' => $critical_response,
            'type' => $type,
            'average_score' => $average_score,
        ];
        return $data;
    }
}
