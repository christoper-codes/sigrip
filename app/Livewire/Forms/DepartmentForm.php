<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Database\Eloquent\Collection;

class DepartmentForm extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'string', 'min:3', 'max:255', 'email'])]
    public ?string $email = null;

    #[Validate(['nullable', 'string', 'min:10'])]
    public ?string $phone = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $description = null;

    public ?string $search_manager = null;

    #[Validate(['nullable', 'int'])]
    public ?int $manager = null;

    public bool $save_manager = false;

    public Collection $potential_managers;

    public bool $hr_department = false;
}
