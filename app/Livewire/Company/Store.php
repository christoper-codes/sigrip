<?php

namespace App\Livewire\Company;

use App\Enums\NotificationTypesEnum;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['string', 'min:3', 'max:255', 'unique:companies,name'])]
    public ?string $name = null;

    #[Validate(['sometimes', 'string'])]
    public ?string $description = null;

    public bool $wizard = false;

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

        if(! $this->wizard) {
            $this->redirect(url: route('company.index'), navigate: true);
        }

        $this->reset();
        $this->dispatch('toast', message: __('Compañia creada con éxito'), type: NotificationTypesEnum::SUCCESS->value);
    }

    public function render()
    {
        return view('livewire.company.store');
    }
}
