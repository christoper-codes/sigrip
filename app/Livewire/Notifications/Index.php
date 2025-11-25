<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public array $unread_notifications = [];
    public array $read_notifications = [];

    public function mount(): void
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->unread_notifications = $notifications->whereNull('read_at')->toArray();
        $this->read_notifications = $notifications->whereNotNull('read_at')->toArray();
    }

    public function render()
    {
        return view('livewire.notifications.index');
    }
}
