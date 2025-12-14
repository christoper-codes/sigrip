<?php

namespace App\Livewire\Application;

use App\Models\Application;
use Livewire\Component;

class Show extends Component
{
    public Application $application;
    public ?string $company_name = null;
    public ?array $questionnaire = null;

    public function mount(): void
    {
        $this->questionnaire = $this->application->questionnaire->toArray();
        $this->company_name = $this->application->issuingDepartment->company->name;
    }

    public function render()
    {
        return view('livewire.application.show');
    }
}
