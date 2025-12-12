<?php

namespace App\Livewire\Application;

use App\Livewire\Traits\Roles;
use App\Livewire\Traits\Table;
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
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Ver aplicación')],
            ['label' => __('Departamento emisor'), 'field' => 'issuing_department_id', 'sortable' => true],
            ['label' => __('Departamento ejecutor'), 'field' => 'executing_department_id', 'sortable' => true],
            ['label' => __('Requiere autenticación')],
            ['label' => __('Questionarios creados')],
            ['label' => __('Questionarios completados')],
            ['label' => __('Alertas'), 'field' => 'alerts', 'sortable' => true],
            ['label' => __('Fecha de creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Fecha de caducidad'), 'field' => 'expiration_date', 'sortable' => true],
            ['label' => __('Estado')],
        ];
    }

    public function searchApplications(): void
    {
        $this->validate();
        $this->search_applications = true;
    }

    public function render()
    {
        return view('livewire.application.index');
    }
}
