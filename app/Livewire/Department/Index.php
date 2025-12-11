<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Livewire\Traits\Table;
use App\Models\Department;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public DepartmentForm $form;
    public ?Department $department;

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
            ['label' => __('Estado')],
            ['label' => __('Acciones')],
        ];
         $this->refreshTableData();
    }

    public function editDepartment(int $id): void
    {
        $this->department = Department::findOrFail($id);
        $this->form->name = $this->department->name;
        $this->form->email = $this->department->email;
        $this->form->description = $this->department->description;
        $this->form->phone = $this->department->phone;
        if($this->department->manager_id){
            $manager = User::find($this->department->manager_id);
            $this->form->manager = $manager->id;
        }

         Flux::modal('edit-department-modal')->show();
    }

    public function editModalClosed()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.department.index');
    }
}
