<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\Notification;
use App\Models\User;

final class CreateNotificationAction
{
    public function execute(array $notification, int $user_id, bool $update_user = true): void
    {
        Notification::create([
            'user_id' => $user_id,
            'metadata' => $notification,
        ]);

        if ($update_user) {
            $user = User::find($user_id);
            $metadata = $user->metadata;
            $metadata['notifications'] = ($metadata['notifications'] ?? 0) + 1;
            $user->metadata = $metadata;
            $user->save();
        }
    }
}
