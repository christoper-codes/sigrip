<?php

declare(strict_types=1);

namespace App\Livewire\Ticket;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Link extends Component
{
    public ?string $slug = null;
    public ?string $url = null;

    public function mount(): void
    {
        $company = Auth::user()->company;
        if ($company) {
            $this->slug = Str::slug($company->name).'-'.$company->uuid;
            $this->url = route('ticket.anon.form', ['company' => $company->uuid]);
        }
    }

    public function render()
    {
        return view('livewire.ticket.link');
    }
}
