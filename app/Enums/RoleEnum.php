<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: string
{
    case SYSTEM_OWNER = 'propietario';
    case COMPANY_ADMIN = 'administrador';
    case DEPARTMENT_MANAGER = 'gerente';
    case EMPLOYEE = 'empleado';
}
