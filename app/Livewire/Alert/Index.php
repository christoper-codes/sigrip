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
    public ?array $questionnaire_response = [];

    public function mount(): void
    {
        $this->items_per_page = 5;
        $this->loadAlerts();
    }

    public function loadAlerts(): void
    {
        $this->alerts = Alert::where('company_id', Auth::user()->company_id)
            ->with('user', 'application')
            ->orderByDesc('created_at')
            ->limit($this->items_per_page)
            ->get()
            ->toArray();

        $this->unread_alerts = array_filter($this->alerts, fn($n) => !is_null($n['read_by_department']));
        $this->read_alerts = array_filter($this->alerts, fn($n) => is_null($n['read_by_department']));
    }

    public function readResponse($alert): void
    {
        $this->questionnaire_response = $alert;

        Flux::modal('read-response-alert')->show();
    }

    public function render()
    {
        return view('livewire.alert.index');
    }
}
