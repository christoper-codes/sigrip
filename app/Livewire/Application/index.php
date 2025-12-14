<?php

namespace App\Livewire\Application;

use App\Livewire\Traits\Roles;
use App\Livewire\Traits\Table;
use App\Models\Application;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use Table;
    use Roles;

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
    }

    public function searchApplications(): void
    {
        $this->validate();
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

    public function render()
    {
        return view('livewire.application.index');
    }
}
