<?php

declare(strict_types=1);

namespace App\Livewire\Notifications;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public ?int $user_id = 0;

    public function mount(): void
    {
        $this->user_id = Auth::check() ? Auth::user()->id : 0;
    }

    #[On('toast')]
    public function showToast(string $message, string $type = 'success'): void
    {
        $this->js("
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    type: '{$type}',
                    content: '{$message}'
                }
            }));
        ");
    }

    #[On('echo:notification.{user_id},NotificationEvent')]
    public function receiveNotification(array $notification): void
    {
        $this->js("
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    type: '{$notification['notification']['type']}',
                    content: '{$notification['notification']['message']}'
                }
            }));
        ");
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
