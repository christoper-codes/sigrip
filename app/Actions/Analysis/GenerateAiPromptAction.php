<?php

declare(strict_types=1);

namespace App\Actions\Analysis;

final class GenerateAiPromptAction
{
    /**
     * @param  array  $responses
     * @param  array  $questionnaire
     * @param  string|null  $user_prompt
     * @return string
     */
    public function execute(array $responses, array $questionnaire, ?string $user_prompt = null): string
    {
        $cuestionario = [
            'name' => $questionnaire['name'] ?? '',
            'description' => $questionnaire['description'] ?? '',
        ];

        $intro = "Eres un analista experto en bienestar emocional y riesgo psicosocial. Analiza las alertas de riesgo (nivel rojo) para el cuestionario '{$cuestionario['name']}'.\n";
        $intro .= "Descripción del cuestionario: {$cuestionario['description']}\n";
        $intro .= 'Total de respuestas en alerta roja: '.count($responses)."\n";

        $intro .= "\nRespuestas de usuarios con alertas:\n";
        foreach ($responses as $r) {
            $nombre = $r['employee_data']['name'] ?? 'Anónimo';
            $alertas = $r['ai_response']['questions_alert'] ?? [];
            $intro .= "- Usuario: {$nombre}\n";
            if ($alertas) {
                foreach ($alertas as $alert) {
                    $intro .= "    • {$alert['question']} ({$alert['label']}, valor: {$alert['value']})\n";
                }
            } else {
                $intro .= "    • Sin alertas específicas\n";
            }
        }

        $intro .= "\nAnaliza y responde:\n";
        if ($user_prompt) {
            $intro .= "1. {$user_prompt}\n";
        }
        $intro .= "2. Enumera las preguntas que generan más alertas.\n";
        $intro .= "3. Indica qué usuarios parecen más propensos a problemas psicológicos.\n";
        $intro .= "4. Menciona posibles acciones legales que podría enfrentar la empresa.\n";
        $intro .= "5. Lista pasos a mejorar y recomendaciones.\n";
        $intro .= "\nIMPORTANTE: Responde en formato de lista, usando saltos de línea y títulos claros para cada sección. Resume la respuesta (no tan largas las respuestas para cada punto).\n";

        return $intro;
    }
}
