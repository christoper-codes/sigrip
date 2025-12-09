<?php

namespace App\Livewire\Questionnaire;

use App\Exports\QuestionnaireTemplateExport;
use App\Imports\QuestionnaireImport;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class Store extends Component
{
    use WithFileUploads;

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

    #[Validate(['required', 'file', 'mimes:xlsx,csv'])]
    public $questionnaire_file;

    public $import_errors = null;

    public function submit(): void
    {
        $this->validate();
        if (!$this->questionnaire_file || !$this->questionnaire_file->isValid()) {
            $this->dispatch('toast', message: 'El archivo aún se está subiendo. Por favor, espera a que termine la carga.', type: 'warning');
            return;
        }
        DB::beginTransaction();
        try {
            (new QuestionnaireImport())->import($this->questionnaire_file->getRealPath());

            DB::commit();
            $this->dispatch('toast', message: 'El archivo pasó las validaciones correctamente. Se te notificará cuando el proceso termine.', type: 'success');
            $this->reset(['questionnaire_file']);
            $this->import_errors = null;
        } catch (ValidationException $e) {
            DB::rollBack();
            $this->reset(['questionnaire_file']);
            $failure = $e->failures()[0] ?? null;
            if ($failure) {
                $row = $failure->row();
                $identificador = 'Fila ' . $row;
                $error = $failure->errors()[0] ?? $e->getMessage();
                $this->import_errors = 'Error al guardar el cuestionario: ' . $error . " ($identificador)";
                $this->dispatch('toast', message: $this->import_errors, type: 'error');
            } else {
                $this->import_errors = 'Error al guardar el cuestionario: ' . $e->getMessage();
                $this->dispatch('toast', message: $this->import_errors, type: 'error');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->reset(['questionnaire_file']);
            $this->import_errors = 'Error al guardar el cuestionario: ' . $e->getMessage();
            $this->dispatch('toast', message: $this->import_errors, type: 'error');
        }
    }

    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new QuestionnaireTemplateExport(with_data: false), 'neura_questionnaire_template.xlsx');
    }

    public function downloadExample(): BinaryFileResponse
    {
        return Excel::download(new QuestionnaireTemplateExport(with_data: true), 'neura_questionnaire_example.xlsx');
    }

    public function render()
    {
        return view('livewire.questionnaire.store');
    }
}
