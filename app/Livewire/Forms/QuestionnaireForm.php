<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class QuestionnaireForm extends Form
{
    #[Validate(['required', 'string', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $subtitle = null;

    #[Validate(['required', 'array'])]
    public ?array $instructions = [''];

    #[Validate(['required', 'array'])]
    public ?array $objectives = [''];

    #[Validate(['required', 'array'])]
    public ?array $yellow_risk_evaluation = [
        ['label' => '', 'criteria' => ''],
    ];

    #[Validate(['required', 'array'])]
    public ?array $red_risk_evaluation = [
        ['label' => '', 'criteria' => ''],
    ];

    #[Validate(['nullable', 'file', 'mimes:xlsx,csv'])]
    public $questionnaire_file;

    public ?string $questionnaire_file_path = null;

    #[Validate(['required', 'integer'])]
    public ?int $questionnaire_category = null;

    public $import_errors = null;
    public ?array $questionnaire_categories = [];

    public function rules(): array
    {
        return [
            'instructions' => 'required|array|min:1',
            'instructions.*' => 'required|string|min:3',
            'objectives' => 'required|array|min:1',
            'objectives.*' => 'required|string|min:3',
            'yellow_risk_evaluation' => 'required|array|min:1',
            'yellow_risk_evaluation.*.label' => 'required|string|min:3',
            'yellow_risk_evaluation.*.criteria' => 'required|string|min:3',
            'red_risk_evaluation' => 'required|array|min:1',
            'red_risk_evaluation.*.label' => 'required|string|min:3',
            'red_risk_evaluation.*.criteria' => 'required|string|min:3',
        ];
    }
}
