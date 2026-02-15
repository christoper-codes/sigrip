<?php

declare(strict_types=1);

namespace App\Livewire\Company\Steps;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public int $current_step = 1;

    public function mount(): void
    {
        $this->checkStepProgress();
    }

    #[On('nextStep')]
    public function nextStep(): void
    {
        $this->checkStepProgress();
    }

    public function checkStepProgress(): void
    {
        $user = Auth::user()->fresh();
        $has_company = $user->company_id !== null;
        $has_department = $user->department_id !== null;

        if ($has_company) {
            $this->current_step = 2;
        }

        if ($has_department) {
            $this->current_step = 3;
        }
    }

    public function render()
    {
        return view('livewire.company.steps.index');
    }
}
