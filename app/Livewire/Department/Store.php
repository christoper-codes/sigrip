<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    #[Validate(['string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['string', 'min:3', 'max:255', 'email'])]
    public ?string $email = null;

    #[Validate(['string', 'min:10'])]
    public ?string $phone = null;

    #[Validate(['sometimes', 'string'])]
    public ?string $description = null;

    public bool $hr_department;

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
        ]);

        if ($this->hr_department) {
            Auth::user()->update(['department_id' => $department->id]);
            $this->dispatch('nextStep');
        }
    }
}
