<?php

namespace App\Actions\Tickets;

use Illuminate\Support\Facades\Http;

final class AnalyzeTicketAiAction
{
    public function execute(array $ticket): string
    {
        $prompt = "Analiza el siguiente ticket de soporte y proporciona una recomendación clara y profesional sobre cómo debería proceder el departamento correspondiente para atender la incidencia.\n" .
            "\nTítulo del ticket: {$ticket['title']}" .
            "\nDescripción del ticket: {$ticket['description']}" .
            "\nTipo de incidencia: {$ticket['incident_type']['name']}" .
            "\nDescripción del tipo de incidencia: {$ticket['incident_type']['description']}" .
            "\n\nResponde únicamente con la recomendación lineal, sin agregar preguntas, saludos ni información adicional.";

        $token = config('services.openai.api_key');
        $url = config('services.openai.url') . '/chat/completions';
        $model = config('services.openai.model');

        $response = Http::withToken($token)
            ->post($url, [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ]
            ])->json('choices.0.message.content');

        return $response;
    }
}
