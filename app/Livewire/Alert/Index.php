<?php

namespace App\Livewire\Alert;

use App\Livewire\Traits\LimitItems;
use App\Models\Alert;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use LimitItems;

    public array $alerts = [];
    public array $unread_alerts = [];
    public array $read_alerts = [];
    public ?string $title_alert = null;
    public ?string $message_alert = null;
    public ?string $url_alert = null;
    public ?string $created_at_alert = null;

    public function mount(): void
    {
        $this->items_per_page = 5;
        $this->loadAlerts();
    }

    public function loadAlerts(): void
    {
        $this->alerts = Alert::where('user_id', Auth::user()->id)
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();

        $this->unread_alerts = array_filter($this->alerts, fn($n) => is_null($n['read_at']));
        $this->read_alerts = array_filter($this->alerts, fn($n) => !is_null($n['read_at']));
    }

    public function render()
    {
        return view('livewire.alert.index');
    }

    public function markAsRead(int $alert_id): void
    {
        $alert = $this->alerts[array_search($alert_id, array_column($this->alerts, 'id'))];
        $this->title_alert = $alert['metadata']['title'];
        $this->message_alert = $alert['metadata']['message'];
        $this->url_alert = $alert['metadata']['url'] ?? null;
        $this->created_at_alert = $alert['created_at'];
        if(is_null($alert['read_at'])) {
            $alert['read_at'] = now()->toDateTimeString();
            $this->alerts[array_search($alert_id, array_column($this->alerts, 'id'))] = $alert;
            $this->unread_alerts = array_filter($this->unread_alerts, fn($n) => $n['id'] !== $alert_id);
            $this->read_alerts[] = $alert;
            Alert::where('id', $alert_id)->update(['read_at' => now()]);
            $user = Auth::user();
            $metadata = $user->metadata;
            $notifications = ($metadata['notifications'] ?? 1) - 1;
            $metadata['notifications'] = $notifications < 0 ? 0 : $notifications;
            $user->update(['metadata' => $metadata]);
        }

        Flux::modal('read-alert')->show();
    }
}
