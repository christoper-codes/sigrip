<?php

namespace App\Livewire\Employee;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    public array $departments = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'email', 'max:255', 'unique:users,email'])]
    public ?string $email = null;

    #[Validate(['required', 'string', 'min:8', 'confirmed'])]
    public ?string $password = null;

    #[Validate(['required', 'string', 'min:8'])]
    public ?string $password_confirmation = null;

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
    }

    public function submit(): void
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'department_id' => $this->department,
            'company_id' => Auth::user()->company?->id,
        ]);

        $this->dispatch('toast', message: __('Empleado creado correctamente.'), type: 'success');
        $this->reset(['department', 'name', 'email', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.employee.store');
    }
}
