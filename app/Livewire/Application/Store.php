<?php

namespace App\Livewire\Application;

use App\Livewire\Forms\ApplicationForm;
use App\Models\Department;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Store extends Component
{
    public ApplicationForm $form;

    public function mount()
    {
        $this->form->department = Department::where('company_id', Auth::user()->company?->id)
            ->where('metadata->hr_department', true)
            ->first()
            ->toArray();

        if (! $this->form->department) {
            $this->dispatch('toast', message: __('No hay departamentos de RRHH disponibles.'), type: 'warning');
        }

        $this->form->issuing_department = $this->form->department['id'];

        $this->form->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();

        $this->form->questionnaires = Questionnaire::where(function ($query) {
                $query->where('is_base', true)
                ->orWhere('company_id', Auth::user()->company?->id);
            })
            ->get()
            ->toArray();
    }

    public function submit(): void
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.application.store');
    }
}
