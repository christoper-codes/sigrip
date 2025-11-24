<?php

namespace App\Livewire\Notifications;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class BellAlert extends Component
{
    public ?int $user_id = 0;
    public int $notifications = 0;

    public function mount(): void
    {
        $this->user_id = Auth::user()->id;
        $this->notifications = Auth::user()->metadata['notifications'] ?? 0;
    }

    #[On('echo:notification.{user_id},NotificationEvent')]
    public function receiveNotification(array $notification): void
    {
        $user = Auth::user();
        $metadata = $user->metadata;
        $metadata['notifications'] = ($metadata['notifications'] ?? 0) + 1;
        $user->update(['metadata' => $metadata]);

        $this->notifications = (int) $metadata['notifications'];
    }

    public function render()
    {
        return view('livewire.notifications.bell-alert');
    }
}
