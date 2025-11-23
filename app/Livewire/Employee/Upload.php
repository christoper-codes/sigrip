<?php

namespace App\Livewire\Employee;

use App\Enums\RoleEnum;
use App\Exports\EmployeesTemplateExport;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Upload extends Component
{
    public array $departments = [];
    public array $roles = [];

    #[Validate(['required', 'int'])]
    public ?int $department = null;

    #[Validate(['required', 'array', 'min:1'])]
    public array $user_roles = [];

    #[Validate(['required', 'file', 'mimes:xlsx,csv'])]
    public $employee_file;

    public function mount()
    {
        $this->departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();

        $this->roles = Role::all()->filter(function ($role) {
            return $role->name !== RoleEnum::SYSTEM_OWNER->value && $role->name !== RoleEnum::COMPANY_ADMIN->value;
        })->toArray();
    }

    public function submit(): void
    {
        $this->validate();
        dd($this->department, $this->user_roles);

        $this->dispatch('toast', message: __('Empleados guardados correctamente.'), type: 'success');
        $this->reset(['department', 'user_roles']);
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new EmployeesTemplateExport, 'neura_employees_template.xlsx');
    }

    public function render()
    {
        return view('livewire.employee.upload');
    }
}
