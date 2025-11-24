<?php

namespace App\Imports;

use App\Jobs\CreateEmployeesJob;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class EmployeesImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    protected int $organization_id;
    protected ?int $company_id;
    protected ?int $department_id;
    protected ?array $user_roles;

    public function __construct(?int $organization_id = null, ?int $department_id = null, ?array $user_roles = null, ?int $company_id = null)
    {
        $this->organization_id = $organization_id;
        $this->department_id = $department_id;
        $this->user_roles = $user_roles;
        $this->company_id = $company_id;
    }

    public function collection(Collection $rows)
    {
        $expected = ['nombre_completo', 'correo_electronico', 'password'];
        $first_row = $rows->first();
        if ($first_row) {
            $actual = array_keys($first_row->toArray());
            $actual = array_map(fn($header) => trim(mb_strtolower($header)), $actual);

            if ($actual !== $expected) {
                throw new \Exception(
                    __('El archivo debe tener las columnas exactamente como: "nombre completo", "correo electronico", "password" (en minúsculas y sin tildes).')
                );
            }
        }

        if ($rows->count() === 0) {
            throw new \Exception(__('El archivo debe contener al menos un registro de empleado.'));
        }

        CreateEmployeesJob::dispatch(
            employees: $rows->toArray(),
            organization_id: $this->organization_id,
            company_id: $this->company_id,
            department_id: $this->department_id,
            user_roles: $this->user_roles,
            user_id: Auth::user()->id,
        );
    }

    public function rules(): array
    {
         return [
            '*.nombre_completo' => 'required|string|min:3',
            '*.correo_electronico' => [
                'required',
                'email',
                'regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/',
                'unique:users,email',
            ],
            '*.password' => 'required|min:8',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.nombre_completo.required' => __('El nombre completo es obligatorio.'),
            '*.nombre_completo.min' => __('El nombre completo debe tener al menos 3 caracteres.'),
            '*.correo_electronico.required' => __('El correo electrónico es obligatorio.'),
            '*.correo_electronico.email' => __('El correo electrónico debe ser válido.'),
            '*.correo_electronico.regex' => __('El correo electrónico debe tener un formato válido.'),
            '*.correo_electronico.unique' => __('El correo electrónico ya está en uso.'),
            '*.password.required' => __('El password es obligatorio.'),
            '*.password.min' => __('El password debe tener al menos 8 caracteres.'),
        ];
    }
}
