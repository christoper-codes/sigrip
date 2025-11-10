<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['sometimes', 'string'])]
    public ?string $description = null;

    public function submit()
    {
        $this->validate();

        $company = Company::create([
            'organization_id' => Auth::user()->organization->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        Auth::user()->update(['company_id' => $company->id]);

        $this->dispatch('nextStep');
    }
}
