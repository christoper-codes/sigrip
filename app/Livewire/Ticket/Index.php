<?php

namespace App\Livewire\Ticket;

use Livewire\Component;

class Index extends Component
{
    public ?array $tickets = [];

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
