<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public array $departments = [];

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company->id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.department.index');
    }
}
