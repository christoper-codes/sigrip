<?php

namespace App\Actions\User;

use App\Models\Notification;
use App\Models\User;

final class CreateNotificationAction
{
    public function execute(array $notification, int $user_id): void
    {
        Notification::create([
            'user_id' => $user_id,
            'metadata' => $notification,
        ]);

        $user = User::find($user_id);
        $metadata = $user->metadata;
        $metadata['notifications'] = ($metadata['notifications'] ?? 0) + 1;
        $user->update(['metadata' => $metadata]);
    }
}
