<?php

namespace App\Livewire\Company;

use App\Livewire\Traits\Table;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public array $companies = [];
    public array $departments = [];

    public function mount()
    {
        $this->table_items = Company::where('id', Auth::user()->company?->id)->get()->toArray();
        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Administrador')],
            ['label' => __('Descripción')],
            ['label' => __('Departamentos')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')],
        ];
        $this->refreshTableData();

        $this->departments = Department::where('company_id', Auth::user()->company?->id)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.company.index');
    }
}
