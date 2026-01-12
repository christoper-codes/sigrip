<?php

namespace App\Livewire\Application;

use Livewire\Component;

class Employee extends Component
{
    public ?array $applications = null;

    public function mount(): void
    {

    }

    public function render()
    {
        return view('livewire.application.employee');
    }
}
