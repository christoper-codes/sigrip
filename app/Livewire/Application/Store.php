<?php

namespace App\Livewire\Application;

use App\Livewire\Forms\ApplicationForm;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
       /*  $this->js('new JSConfetti().addConfetti()');
        Flux::modal('qr-application-modal')->show();
        return; */
        //$this->validate();

        $exists_application = Application::where('issuing_department_id', $this->form->issuing_department)
            ->where('executing_department_id', $this->form->executing_department)
            ->where('questionnaire_id', $this->form->questionnaire)
            ->whereNull('start_date')
            ->exists();
        if ($exists_application) {
            $this->dispatch('toast', message: __('Ya existe una aplicación activa con los mismos parámetros.'), type: 'error');
            return;
        }

        DB::beginTransaction();
        try{
            $questionnaire_name = collect($this->form->questionnaires)
                ->where('id', $this->form->questionnaire)
                ->first()['name'];
            $slug = Str::slug($questionnaire_name . '-' . uniqid());

            $application = Application::create([
                'issuing_department_id' => $this->form->issuing_department,
                'executing_department_id' => $this->form->executing_department,
                'questionnaire_id' => $this->form->questionnaire,
                'slug' => $slug,
                'auth_required' => $this->form->auth_required,
                'start_date' => $this->form->start_date,
                'expiration_date' => $this->form->expiration_date,
            ]);

            if($this->form->auth_required){
                $users = User::where('department_id', $this->form->executing_department)
                    ->where('company_id', Auth::user()->company?->id)
                    ->get();
                foreach ($users as $user) {
                    $application->users()->attach($user->id, ['is_active' => true]);
                }
            }

            DB::commit();
            $this->js('new JSConfetti().addConfetti()');
            Flux::modal('qr-application-modal')->show();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: __('Error al crear la aplicación: ') . $e->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.application.store');
    }
}
