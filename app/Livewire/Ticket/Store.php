<?php

namespace App\Livewire\Ticket;

use App\Enums\NotificationTypesEnum;
use Livewire\Component;

class Store extends Component
{

    public function mount(): void
    {
    }

    public function submit(): void
    {
        $this->validate();


        $this->dispatch('toast', message: __('Ticket creado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.ticket.store');
    }
}
