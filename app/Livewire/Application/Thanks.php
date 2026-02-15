<?php

declare(strict_types=1);

namespace App\Livewire\Application;

use Livewire\Component;

class Thanks extends Component
{
    public function mount(): void
    {
        $this->js('new JSConfetti().addConfetti()');
    }

    public function render()
    {
        return view('livewire.application.thanks');
    }
}
