<?php

namespace App\Livewire\Company;

use App\Enums\NotificationTypesEnum;
use App\Models\Address;
use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    public Company $company;

    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $address_line = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $zip_code = null;

    #[Validate(['required', 'regex:/^[0-9]+$/'])]
    public ?string $phone = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $email = null;

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

        $address = $this->company->address ?? null;

        $address_data = [
            'address_line' => $this->address_line,
            'zip_code' => $this->zip_code,
            'phone' => $this->phone,
            'email' => $this->email
        ];

        if ($address){
            $address->update($address_data);
        }

        if(! $address){
            $address = Address::create($address_data);
        }

        $this->company->update([
            'address_id' => $address->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('toast', message: __('Compañía actualizada correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
    }

    public function render()
    {
        return view('livewire.company.update');
    }
}
