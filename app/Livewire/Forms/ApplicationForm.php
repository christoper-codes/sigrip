<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ApplicationForm extends Form
{
    #[Validate(['required', 'int'])]
    public ?int $issuing_department = null;

    #[Validate(['required', 'int'])]
    public ?int $executing_department = null;

    #[Validate(['required', 'int'])]
    public ?int $questionnaire = null;

    #[Validate(['required', 'bool'])]
    public ?bool $auth_required = true;
}
