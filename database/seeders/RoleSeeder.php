<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'system_owner',
            'description' => 'Dueño del sistema. Acceso total para crear empresas/clientes y configuraciones',
            'is_active' => true,
        ]);

        Role::create([
            'name' => 'company_admin',
            'description' => 'Administrador de la empresa. Puede gestionar usuarios y configuraciones de la empresa.',
            'is_active' => true,
        ]);

        Role::create([
            'name' => 'department_manager',
            'description' => 'Gerente de departamento. Puede gestionar usuarios, recursos dentro de su departamento y crear aplicaciones.',
            'is_active' => true,
        ]);

        Role::create([
            'name' => 'employee',
            'description' => 'Empleado regular. Puede ver y gestionar solo sus propias evaluaciones internas y resultados.',
            'is_active' => true,
        ]);
    }
}
