<?php

namespace App\Livewire\Analysis;

use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    use Table;

    public array $departments = [];
    public ?array $applications = [];
    public ?string $application_error = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['nullable', 'array'])]
    public ?array $application = null;

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
            ->orderByDesc('start_date')
            ->get()
            ->toArray();

        Flux::modal('select-application')->show();
    }

    public function resultApplication(): void
    {
        if(! $this->application){
            $this->application_error = __('Por favor, seleccione una aplicación para ver los resultados.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
