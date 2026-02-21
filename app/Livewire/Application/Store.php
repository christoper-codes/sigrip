<?php

declare(strict_types=1);

namespace App\Livewire\Application;

use App\Actions\Application\GenerateQrAction;
use App\Enums\NotificationTypesEnum;
use App\Jobs\UserApplicationJob;
use App\Livewire\Forms\ApplicationForm;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
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
        $department = Department::where('company_id', Auth::user()->company?->id)
            ->where('metadata->hr_department', true)
            ->first();
        $this->form->department = $department->toArray();

        if (! $this->form->department) {
            $this->dispatch('toast', message: __('No hay departamentos de RRHH disponibles.'), type: NotificationTypesEnum::WARNING->value);
        }

        $this->form->issuing_department = $this->form->department['id'] ?? null;

        $departments = Department::where('company_id', Auth::user()->company?->id)
            ->get();
        $this->form->departments = $departments->toArray();

        $questionnaires = Questionnaire::where(function ($query) {
            $query->where('is_base', true)
                ->orWhere('company_id', Auth::user()->company?->id);
        })
            ->get();
        $this->form->questionnaires = $questionnaires->toArray();
    }

    public function submit(): void
    {
        $this->validate();

        $exists_application = Application::where('issuing_department_id', $this->form->issuing_department)
            ->where('executing_department_id', $this->form->executing_department)
            ->where('questionnaire_id', $this->form->questionnaire)
            ->where('start_date', $this->form->start_date)
            ->exists();
        if ($exists_application) {
            $this->dispatch('toast', message: __('Ya existe una aplicación activa con los mismos parámetros.'), type: NotificationTypesEnum::ERROR->value);

            return;
        }

        DB::beginTransaction();
        try {
            $questionnaire_name = collect($this->form->questionnaires)
                ->where('id', $this->form->questionnaire)
                ->first()['name'];
            $this->form->slug = Str::slug($questionnaire_name.'-'.uniqid());
            $this->form->url_qr = route('application.show', ['slug' => $this->form->slug]);

            $application = Application::create([
                'company_id' => Auth::user()->company?->id,
                'issuing_department_id' => $this->form->issuing_department,
                'executing_department_id' => $this->form->executing_department,
                'questionnaire_id' => $this->form->questionnaire,
                'slug' => $this->form->slug,
                'auth_required' => $this->form->auth_required,
                'employee_data_required' => $this->form->employee_data_required,
                'start_date' => $this->form->start_date,
                'expiration_date' => $this->form->expiration_date,
            ]);

            if ($this->form->auth_required) {
                UserApplicationJob::dispatch(
                    department_id: $this->form->executing_department,
                    company_id: Auth::user()->company?->id,
                    application: $application,
                    store: true,
                );
            }

            (new GenerateQrAction)->execute(url: $this->form->url_qr, slug: $this->form->slug);

            DB::commit();
            $this->js('if(window.matchMedia("(min-width:1024px)").matches){new JSConfetti().addConfetti()}');
            Flux::modal('qr-application-modal')->show();
            $this->reset([
                'form.executing_department',
                'form.questionnaire',
                'form.auth_required',
                'form.employee_data_required',
                'form.start_date',
                'form.expiration_date',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: __('Error al crear la aplicación: ').$e->getMessage(), type: NotificationTypesEnum::ERROR->value);
        }
    }

    public function render()
    {
        return view('livewire.application.store');
    }
}
