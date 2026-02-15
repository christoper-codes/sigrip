<?php

declare(strict_types=1);

namespace App\Livewire\Company;

use App\Actions\Application\GenerateQrAction;
use App\Enums\NotificationTypesEnum;
use App\Mail\Welcome;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

        DB::beginTransaction();
        try {
            $uuid = Str::slug($this->name).'-'.str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $company = Company::create([
                'uuid' => $uuid,
                'organization_id' => Auth::user()->organization->id,
                'name' => $this->name,
                'description' => $this->description,
            ]);
            Auth::user()->update(['company_id' => $company->id]);

            $url_qr = route('ticket.anon.form', ['company' => $company->uuid]);
            $slug = Str::slug($company->name).'-'.$company->uuid;
            (new GenerateQrAction)->execute(url: $url_qr, slug: $slug);

            Mail::to(Auth::user()->email)->send(new Welcome(company: $company->name));

            DB::commit();

            $this->dispatch('nextStep');
            if (! $this->wizard) {
                $this->redirect(url: route('company.index'), navigate: true);
            }
            $this->reset();
            $this->dispatch('toast', message: __('Compañia creada con éxito'), type: NotificationTypesEnum::SUCCESS->value);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: __('Error al crear la compañia'), type: NotificationTypesEnum::ERROR->value);
        }
    }

    public function render()
    {
        return view('livewire.company.store');
    }
}
