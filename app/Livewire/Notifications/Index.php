<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public array $notifications = [];
    public array $unread_notifications = [];
    public array $read_notifications = [];
    public ?string $title_notification = null;
    public ?string $message_notification = null;
    public ?string $url_notification = null;
    public ?string $created_at_notification = null;

    public function mount(): void
    {
        $this->notifications = Notification::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();

        $this->unread_notifications = array_filter($this->notifications, fn($n) => is_null($n['read_at']));
        $this->read_notifications = array_filter($this->notifications, fn($n) => !is_null($n['read_at']));
    }

    public function render()
    {
        return view('livewire.notifications.index');
    }

    public function markAsRead(int $notification_id): void
    {
        $notification = $this->notifications[array_search($notification_id, array_column($this->notifications, 'id'))];
        $this->title_notification = $notification['metadata']['title'];
        $this->message_notification = $notification['metadata']['message'];
        $this->url_notification = $notification['metadata']['url'] ?? null;
        $this->created_at_notification = $notification['created_at'];

        if(is_null($notification['read_at'])) {
            $notification['read_at'] = now()->toDateTimeString();
            $this->notifications[array_search($notification_id, array_column($this->notifications, 'id'))] = $notification;
            $this->unread_notifications = array_filter($this->unread_notifications, fn($n) => $n['id'] !== $notification_id);
            $this->read_notifications[] = $notification;
            Notification::where('id', $notification_id)->update(['read_at' => now()]);

            $user = Auth::user();
            $metadata = $user->metadata;
            $metadata['notifications'] = ($metadata['notifications'] ?? 1) - 1;
            $user->update(['metadata' => $metadata]);
        }

        Flux::modal('read-notification')->show();
    }
}
