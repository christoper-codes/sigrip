<?php

namespace App\Livewire\Application;

use App\Livewire\Forms\ApplicationForm;
use App\Livewire\Traits\Roles;
use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use Table;
    use Roles;

    public ApplicationForm $form;
    public ?Application $application = null;
    public ?int $application_id = null;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public bool $search_applications = false;
    public array $departments = [];

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
        if(! $this->departments){
          $this->dispatch('toast', message: __('No hay departamentos disponibles.'), type: 'warning');
        }

        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre del cuestionario'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Fecha de creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Compartir aplicación')],
            ['label' => __('Ver resultados')],
            ['label' => __('Análisis con IA')],
            ['label' => __('Departamento emisor')],
            ['label' => __('Fecha de inicio'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Fecha de caducidad'), 'field' => 'expiration_date', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Activar')],
            ['label' => __('Acciones')],
        ];

         $this->form->department = Department::where('company_id', Auth::user()->company?->id)
            ->where('metadata->hr_department', true)
            ->first()
            ->toArray();

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

    public function searchApplications(): void
    {
        $this->validateOnly('department');
        $this->table_items = Application::where('executing_department_id', $this->department)
            ->with('questionnaire', 'issuingDepartment', 'executingDepartment', 'users')
            ->get()
            ->toArray();

        $this->current_page = 1;
        $this->search_query = '';
        $this->refreshTableData();
        $this->search_applications = true;
    }

    public function updateStatus(int $id): void
    {
        $application = Application::find($id);

        $application->is_active = ! $application->is_active;
        $application->save();

        $this->searchApplications();
        $this->dispatch('toast', message: __('Estado actualizado correctamente.'), type: 'success');
    }

    public function editApplication(int $id): void
    {
        $this->application = Application::find($id);
        $this->application_id = $this->application->id;
        $this->form->issuing_department = $this->application->issuing_department_id;
        $this->form->executing_department = $this->application->executing_department_id;
        $this->form->questionnaire = $this->application->questionnaire_id;
        $this->form->start_date = $this->application->start_date ? date('Y-m-d', strtotime($this->application->start_date)) : null;
        $this->form->expiration_date = $this->application->expiration_date ? date('Y-m-d', strtotime($this->application->expiration_date)) : null;
        $this->form->auth_required = $this->application->auth_required;

        Flux::modal('edit-application-modal')->show();
    }

    public function confirmUpdateApplication(): void
    {
        $this->form->validate();

        $application = Application::find($this->application_id);
        if ($application->questionnaireResponses()->exists() &&
            (
                $application->executing_department_id !== $this->form->executing_department ||
                $application->questionnaire_id !== $this->form->questionnaire ||
                $application->auth_required !== $this->form->auth_required
            )
        ) {
            $this->dispatch('toast', message: __('No se puede modificar estas propiedades de una aplicación que ya tiene respuestas.'), type: 'error');
            return;
        }

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
            $original_auth_required = $application->auth_required;

            $application->issuing_department_id = $this->form->issuing_department;
            $application->executing_department_id = $this->form->executing_department;
            $application->questionnaire_id = $this->form->questionnaire;
            $application->auth_required = $this->form->auth_required;
            $application->start_date = $this->form->start_date;
            $application->expiration_date = $this->form->expiration_date;
            $application->save();

            if($original_auth_required !== $this->form->auth_required){

            }

            DB::commit();
            $this->reset([
                'form.issuing_department',
                'form.executing_department',
                'form.questionnaire',
                'form.auth_required',
                'form.start_date',
                'form.expiration_date',
            ]);
            $this->searchApplications();
            Flux::modal('edit-application-modal')->close();
            $this->dispatch('toast', message: __('Aplicación actualizada correctamente.'), type: 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: __('Error al actualizar la aplicación: ') . $e->getMessage(), type: 'error');
        }
    }

    public function editModalClosed()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.application.index');
    }
}
