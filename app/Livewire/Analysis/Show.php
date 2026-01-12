<?php

namespace App\Livewire\Analysis;

use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    use Table;

    public array $departments = [];
    public ?array $application_data = [];
    public ?array $applications = [];
    public ?array $questionnaire = [];
    public ?string $application_error = null;
    public bool $search_responses = false;

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['nullable', 'int'])]
    public ?int $application = null;

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

        $this->search_responses = true;

        $this->application_data = Application::where('id', $this->application)
            ->with('questionnaireResponses.user')
            ->first()
            ->toArray();

        $this->questionnaire = Questionnaire::where('id', $this->application_data['questionnaire_id'])
            ->first()
            ->toArray();

        $this->table_items = $this->application_data['questionnaire_responses'];
        $this->search_fields = ['user.name'];
        $this->headers = [
            ['label' => __('ID')],
            ['label' => __('Fecha de Respuesta'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Nivel de Riesgo'), 'field' => 'risk_level', 'sortable' => true],
            ['label' => __('Empleado')],
            ['label' => __('Respuestas')],
            ['label' => __('Alertas')],
            ['label' => __('Promedio')],
            ['label' => __('Ai - departamento')],
            ['label' => __('Ai - empleado')],
        ];
         $this->refreshTableData();

         Flux::modal('select-application')->close();
    }

    public function render()
    {
        return view('livewire.analysis.show');
    }
}
