<?php

declare(strict_types=1);

namespace App\Livewire\Employee;

use App\Enums\NotificationTypesEnum;
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
use Maatwebsite\Excel\Validators\ValidationException;
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
        if (! $this->employee_file || ! $this->employee_file->isValid()) {
            $this->dispatch('toast', message: __('El archivo aún se está subiendo. Por favor, espera a que termine la carga.'), type: NotificationTypesEnum::WARNING->value);

            return;
        }
        DB::beginTransaction();
        try {
            $department_name = collect($this->departments)->firstWhere('id', $this->department)['name'] ?? 'N/A';

            (new EmployeesImport(
                organization_id: Auth::user()->organization?->id,
                department_id: $this->department,
                department_name: $department_name,
                user_roles: $this->user_roles,
                company_id: Auth::user()->company?->id,
            ))->import($this->employee_file->getRealPath());

            DB::commit();
            $this->dispatch('toast', message: __('El archivo paso las validaciones correctamente. Se te notificará cuando el proceso termine.'), type: NotificationTypesEnum::SUCCESS->value);
            $this->reset(['department', 'user_roles', 'employee_file']);
            $this->import_errors = null;
        } catch (ValidationException $e) {
            DB::rollBack();
            $this->reset(['employee_file']);
            $failure = $e->failures()[0] ?? null;
            if ($failure) {
                $row = $failure->row();
                $values = $failure->values();
                $identificador = __('Para el usuario: ').' '.($values['nombre_completo'] ?? ($values['correo_electronico'] ?? "Fila $row"));
                $error = $failure->errors()[0] ?? $e->getMessage();
                $this->import_errors = __('Error al guardar los empleados: ').$error." ($identificador)";
                $this->dispatch('toast', message: $this->import_errors, type: NotificationTypesEnum::ERROR->value);
            } else {
                $this->import_errors = __('Error al guardar los empleados: ').$e->getMessage();
                $this->dispatch('toast', message: $this->import_errors, type: NotificationTypesEnum::ERROR->value);
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->reset(['employee_file']);
            $this->import_errors = __('Error al guardar los empleados: ').$e->getMessage();
            $this->dispatch('toast', message: $this->import_errors, type: NotificationTypesEnum::ERROR->value);
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
