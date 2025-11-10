<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Models\Organization;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['sometimes', 'string'])]
    public ?string $description = null;

    public function submit(): void
    {
        $this->validate();
        $organization_by_default = Organization::where('name', 'neura')->first();

        $company = Company::create([
            'organization_id' => $organization_by_default->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);
    }
}
