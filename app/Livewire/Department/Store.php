<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['string', 'min:3', 'max:255', 'email'])]
    public ?string $email = null;

    #[Validate(['string', 'min:10', 'max:15', 'regex:/^\+?[0-9]{7,15}$/'])]
    public ?string $phone = null;

    #[Validate(['sometimes', 'string'])]
    public ?string $description = null;

    public function submit(): void
    {
        $this->validate();


    }
}
