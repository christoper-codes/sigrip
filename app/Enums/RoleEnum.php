<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SYSTEM_OWNER = 'propietario';
    case COMPANY_ADMIN = 'administrador';
    case DEPARTMENT_MANAGER = 'gerente';
    case EMPLOYEE = 'empleado';
}
