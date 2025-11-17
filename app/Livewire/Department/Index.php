<?php

namespace App\Livewire\Department;

use App\Livewire\Traits\Table;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public function mount()
    {
        $this->table_items = Department::where('company_id', Auth::user()->company?->id)
                ->with('manager')
                ->get()
                ->toArray();

        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Administrador')],
            ['label' => __('Email')],
            ['label' => __('Descripción')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')]
        ];
         $this->refreshTableData();
    }

    public function render()
    {
        return view('livewire.department.index');
    }
}
