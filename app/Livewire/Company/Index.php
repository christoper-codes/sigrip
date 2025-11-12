<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public array $companies = [];

    public function mount()
    {
        $this->companies = Company::where('id', Auth::user()->company->id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.company.index');
    }
}
