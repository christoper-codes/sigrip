<?php

namespace App\Livewire\Employee;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{

    #[Validate(['required', 'integer'])]
    public ?int $department = null;
    public array $employees = [];

    public function searchEmployees(): void
    {
        $this->validate();

        $this->employees = User::where('department_id', $this->department)
            ->with('userRoles')
            ->get()
            ->toArray();
        dd($this->employees);
    }

    public function render()
    {
        return view('livewire.employee.index');
    }
}
