<?php

namespace App\Livewire\Employee;

use App\Livewire\Traits\Table;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public array $employees = [];
    public array $departments = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();
        if(! $this->departments){
          $this->dispatch('toast', message: __('No hay departamentos disponibles.'), type: 'warning');
        }
    }

    public function searchEmployees(): void
    {
        $this->validate();

        $this->employees = User::where('department_id', $this->department)
            ->with('userRoles')
            ->get()
            ->toArray();
    }

    public function render()
    {
        $paginatedItems = $this->getPaginatedItems();
        $filteredItems = $this->getFilteredItems();
        $totalResults = count($filteredItems);
        $totalPages = $this->getTotalPages();

        return view('livewire.employee.index', [
            'paginatedItems' => $paginatedItems,
            'totalResults' => $totalResults,
            'totalPages' => $totalPages
        ]);
    }

}
