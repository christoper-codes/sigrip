<?php

namespace App\Livewire\Ticket;

use App\Livewire\Traits\LimitItems;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use LimitItems;

    public ?array $tickets = [];
    public ?array $departments = [];

    public function mount(): void
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.ticket.index');
    }
}
