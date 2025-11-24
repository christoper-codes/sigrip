<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationEvent implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, Queueable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public array $notification, public int $user_id){
        $this->onQueue('notifications');
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('notification.' . $this->user_id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'notification' => $this->notification,
        ];
    }
}
