<?php

declare(strict_types=1);

namespace App\Livewire\Employee;

use App\Enums\NotificationTypesEnum;
use App\Enums\RoleEnum;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    public array $departments = [];
    public array $roles = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['required', 'array', 'min:1'])]
    public array $user_roles = [];

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

        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value && $role->name !== RoleEnum::COMPANY_ADMIN->value;
        })->toArray();
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
            'organization_id' => Auth::user()->organization?->id,
            'metadata' => [
                'notifications' => 0,
                'alerts' => 0,
                'tickets' => 0,
            ],
        ]);
        $user->userRoles()->attach($this->user_roles);

        $this->dispatch('toast', message: __('Empleado creado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->reset(['department', 'name', 'email', 'password', 'password_confirmation', 'user_roles']);
    }

    public function render()
    {
        return view('livewire.employee.store');
    }
}
