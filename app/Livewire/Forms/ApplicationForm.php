<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ApplicationForm extends Form
{
    public array $department = [];
    public array $departments = [];
    public array $questionnaires = [];
    public ?string $url_qr = null;
    public ?string $slug = null;

    #[Validate(['required', 'int'])]
    public ?int $issuing_department = null;

    #[Validate(['required', 'int'])]
    public ?int $executing_department = null;

    #[Validate(['required', 'int'])]
    public ?int $questionnaire = null;

    #[Validate(['required', 'date'])]
    public ?string $start_date = null;

    #[Validate(['required', 'date'])]
    public ?string $expiration_date = null;

    #[Validate(['required', 'bool'])]
    public bool $auth_required = false;

    #[Validate(['required', 'bool'])]
    public bool $employee_data_required = true;
}
