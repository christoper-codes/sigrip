<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeDataForm extends Form
{
    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_name = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_gender = null;

    #[Validate(['required', 'int', 'min:1'])]
    public ?int $employee_age = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_marital_status = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_education_level = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_job_title = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_department = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_job_type = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_contract_type = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_personnel_type = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_work_schedule_type = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $employee_shift_rotation = null;

    #[Validate(['required', 'int', 'min:0'])]
    public ?int $employee_experience_current_job = null;

    #[Validate(['required', 'int', 'min:0'])]
    public ?int $employee_total_experience = null;

    #[Validate(['required', 'string'])]
    public ?string $questionnaire = null;
}
