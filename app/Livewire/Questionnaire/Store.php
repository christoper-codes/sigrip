<?php

namespace App\Livewire\Questionnaire;

use App\Exports\QuestionnaireTemplateExport;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;

class Store extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public ?string $title = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $subtitle = null;

    #[Validate(['required', 'string'])]
    public ?string $instructions = null;

    #[Validate(['required', 'array'])]
    public ?array $objetives = [''];

    #[Validate(['required', 'array'])]
    public ?array $yellow_risk_evaluation = [
        ['label' => '', 'criteria' => '']
    ];

    #[Validate(['required', 'array'])]
    public ?array $red_risk_evaluation = [
        ['label' => '', 'criteria' => '']
    ];

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new QuestionnaireTemplateExport, 'neura_questionnaire_template.xlsx');
    }

    public function render()
    {
        return view('livewire.questionnaire.store');
    }
}
