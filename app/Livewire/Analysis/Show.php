<?php

namespace App\Livewire\Analysis;

use App\Models\Application;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    public array $departments = [];
    public ?array $applications = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount(): void
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
    }

    public function searchApplications(): void
    {
        $this->validate();
        $this->applications = Application::where('executing_department_id', $this->department)
            ->orderByDesc('created_at')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
