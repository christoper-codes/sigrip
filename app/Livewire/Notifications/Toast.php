<?php

namespace App\Livewire\Notifications;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{

    #[On('toast')]
    public function showToast(string $message, string $type = 'success'): void
    {
        $this->js("
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    type: '{$type}',
                    content: '{$message}'
                }
            }));
        ");
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
