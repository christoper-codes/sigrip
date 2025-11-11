<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    public Company $company;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['nullable', 'string', 'max:500'])]
    public ?string $description = null;

    public function mount(): void
    {
        $this->name = $this->company->name;
        $this->description = $this->company->description;
    }

    public function submit()
    {
        $this->validate();

        $this->company->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('toast', message: __('Compañía actualizada correctamente.'), type: 'success');
    }
}
