<?php
namespace App\Livewire\Ticket;

use App\Models\SupportTicket;
use Livewire\Component;

class TrackTicket extends Component
{
    public ?SupportTicket $ticket = null;
    public ?string $tracking_code = null;
    public bool $found = false;
    public bool $searched = false;

    public function mount(?string $uuid = null): void
    {
        if ($uuid) {
            $this->tracking_code = $uuid;
            $this->searchTicket();
        }
    }

    public function searchTicket(): void
    {
        $this->searched = true;
        $this->found = false;
        $this->ticket = null;

        if (!$this->tracking_code) {
            return;
        }

        $this->ticket = SupportTicket::where('tracking_uuid', $this->tracking_code)
            ->with(['department', 'incidentType', 'supportTicketStatus', 'company'])
            ->first();

        if ($this->ticket) {
            $this->found = true;
        }
    }

    public function render()
    {
        return view('livewire.ticket.track-ticket');
    }
}
