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
    public ?array $questionnaire_response = [];

    public function mount(): void
    {
        $this->items_per_page = 5;
        $this->loadAlerts();
    }

    public function loadAlerts(): void
    {
        $this->alerts = Alert::where('company_id', Auth::user()->company_id)
            ->with('user', 'application', 'department')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();
    }

    public function readResponse(int $alert_id, string $type): void
    {
        $alert = collect($this->alerts)->firstWhere('id', $alert_id);
        $this->questionnaire_response = $alert;
        $this->markAsRead($alert_id);

        Flux::modal('read-' . $type . '-alert')->show();
    }

    public function markAsRead(int $alert_id): void
    {
        $alert = $this->alerts[array_search($alert_id, array_column($this->alerts, 'id'))];

        if(! (bool)$alert['read_by_department']) {
            Alert::where('id', $alert_id)->update(['read_by_department' => true]);

            $user = Auth::user();
            $metadata = $user->metadata;
            $alerts = ($metadata['alerts'] ?? 1) - 1;
            $metadata['alerts'] = $alerts < 0 ? 0 : $alerts;
            $user->update(['metadata' => $metadata]);
        }
    }

    public function render()
    {
        return view('livewire.alert.index');
    }
}
