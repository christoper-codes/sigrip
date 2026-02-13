<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeDataForm extends Form
{
    #[Validate(['required', 'string', 'min:3'])]
    public ?string $name = null;

    #[Validate(['required', 'string'])]
    public ?string $sex = null;

    #[Validate(['required', 'string'])]
    public ?string $age = null;

    #[Validate(['required', 'string'])]
    public ?string $marital_status = null;

    #[Validate(['required', 'string'])]
    public ?string $education_level = null;

    #[Validate(['required', 'string'])]
    public ?string $status_education_level = null;

    #[Validate(['required', 'string', 'min:3'])]
    public ?string $job_title = null;

    #[Validate(['required', 'string'])]
    public ?string $department = null;

    #[Validate(['required', 'string'])]
    public ?string $job_type = null;

    #[Validate(['required', 'string'])]
    public ?string $contract_type = null;

    #[Validate(['required', 'string'])]
    public ?string $personnel_type = null;

    #[Validate(['required', 'string'])]
    public ?string $work_schedule_type = null;

    #[Validate(['required', 'string'])]
    public ?string $shift_rotation = null;

    #[Validate(['required', 'string'])]
    public ?string $experience_current_job = null;

    #[Validate(['required', 'string'])]
    public ?string $total_experience = null;

    #[Validate(['required', 'string'])]
    public ?string $questionnaire_name = null;
}
