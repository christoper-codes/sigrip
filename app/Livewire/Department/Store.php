<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'string', 'min:3', 'max:255', 'email'])]
    public ?string $email = null;

    #[Validate(['nullable', 'string', 'min:10'])]
    public ?string $phone = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $description = null;

    public ?string $search_manager = null;

    #[Validate(['nullable', 'int'])]
    public ?int $manager = null;

    public bool $save_manager = false;

    public Collection $potential_managers;

    public bool $hr_department = false;

    public function submit(): void
    {
        $this->validate();

        $metadata = [
            'hr_department' => $this->hr_department,
        ];

        $department = Department::create([
            'organization_id' => Auth::user()->organization->id,
            'company_id' => Auth::user()->company->id,
            'name' => $this->name,
            'description' => $this->description,
            'metadata' => $metadata,
            'manager_id' => $this->manager,
        ]);

        if ($this->hr_department) {
            Auth::user()->update(['department_id' => $department->id]);
            $this->dispatch('steps-completed');
            $this->dispatch('nextStep');
        }
    }

    public function searchManager(): void
    {
        $this->validate(['search_manager' => 'required|string|min:3|max:255']);

        $search = trim(strtolower($this->search_manager));
        $this->potential_managers = User::query()
            ->where('organization_id', Auth::user()->organization->id)
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->get();
    }

}
