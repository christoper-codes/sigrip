<?php

namespace App\Livewire\Employee;

use App\Enums\RoleEnum;
use App\Exports\EmployeesTemplateExport;
use App\Imports\EmployeesImport;
use App\Models\Department;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Upload extends Component
{
    use WithFileUploads;

    public array $departments = [];
    public array $roles = [];
    public ?string $import_errors = null;

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
        DB::beginTransaction();
        try {
            (new EmployeesImport(
                department_id: $this->department,
                user_roles: $this->user_roles,
                company_id: Auth::user()->company?->id,
            ))->import($this->employee_file->getRealPath());
            DB::commit();

            $this->dispatch('toast', message: __('Empleados guardados correctamente.'), type: 'success');
            $this->reset(['department', 'user_roles']);
        } catch (Exception $e) {
            DB::rollBack();
            $this->import_errors = $e->getMessage();
            $this->dispatch('toast', message: __('Error al guardar los empleados: ') . $e->getMessage(), type: 'error');
        }

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
