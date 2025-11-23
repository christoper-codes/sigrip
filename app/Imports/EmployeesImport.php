<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class EmployeesImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    protected int $company_id;
    protected int $department_id;
    protected array $user_roles;

    public function __construct(int $department_id, array $user_roles, ?int $company_id = null)
    {
        $this->department_id = $department_id;
        $this->user_roles = $user_roles;
        $this->company_id = $company_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Aquí puedes guardar o procesar cada fila válida
            // Ejemplo:
            // User::create([
            //     'name' => $row['nombre completo'],
            //     'email' => $row['correo electronico'],
            //     'password' => bcrypt($row['contraseña']),
            // ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.nombre completo' => 'required|string|min:3',
            '*.correo electronico' => 'required|email',
            '*.contraseña' => 'required|string|min:8',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.nombre completo.required' => __('El nombre completo es obligatorio.'),
            '*.nombre completo.min' => __('El nombre completo debe tener al menos 3 caracteres.'),
            '*.correo electronico.required' => __('El correo electrónico es obligatorio.'),
            '*.correo electronico.email' => __('El correo electrónico debe ser válido.'),
            '*.contraseña.required' => __('La contraseña es obligatoria.'),
            '*.contraseña.min' => __('La contraseña debe tener al menos 8 caracteres.'),
        ];
    }
}
