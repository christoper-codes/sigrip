<?php

namespace App\Livewire\Company;

use App\Actions\Application\GenerateQrAction;
use App\Enums\NotificationTypesEnum;
use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

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

        $uuid = Str::slug($this->name) . '-' . str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $company = Company::create([
            'uuid' => $uuid,
            'organization_id' => Auth::user()->organization->id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        Auth::user()->update(['company_id' => $company->id]);
        /* $user_roles = Role::where('name', RoleEnum::COMPANY_ADMIN->value)->first();
        Auth::user()->userRoles()->attach($user_roles->id); */

        $url_qr = route('ticket.anon.form', ['company' => $company->uuid]);
        $slug = Str::slug($company->name) . '-' . $company->uuid;
        (new GenerateQrAction)->execute(url: $url_qr, slug: $slug);

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
