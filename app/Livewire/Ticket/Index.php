<?php

namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use App\Jobs\SupportTicketJob;
use App\Models\IncidentType;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
