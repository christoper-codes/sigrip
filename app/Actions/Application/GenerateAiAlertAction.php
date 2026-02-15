<?php

declare(strict_types=1);

namespace App\Actions\Application;

use Illuminate\Support\Facades\Http;

final class GenerateAiAlertAction
{
    public function execute(string $prompt): array
    {
        $token = config('services.openai.api_key');
        $url = config('services.openai.url').'/chat/completions';
        $model = config('services.openai.model');

        $response = Http::withToken($token)
            ->post($url, [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
            ])->json('choices.0.message.content');

        return json_decode($response, true);
    }
}
