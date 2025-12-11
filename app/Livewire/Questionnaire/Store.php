<?php

namespace App\Livewire\Questionnaire;

use App\Actions\Questionnaire\BuildMetadataAction;
use App\Exports\QuestionnaireTemplateExport;
use App\Imports\QuestionnaireImport;
use App\Livewire\Forms\QuestionnaireForm;
use App\Models\Questionnaire;
use App\Models\QuestionnaireCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Str;

class Store extends Component
{
    use WithFileUploads;

    public QuestionnaireForm $form;

    public function mount()
    {
        $this->form->questionnaire_categories = QuestionnaireCategory::all()->toArray();
    }

    public function submit(): void
    {
        $this->form->validate();
        if (! $this->form->questionnaire_file || !$this->form->questionnaire_file->isValid()) {
            $this->dispatch('toast', message: __('El archivo aún se está subiendo. Por favor, espera a que termine la carga.'), type: 'warning');
            return;
        }

        DB::beginTransaction();
        try {
            $import = new QuestionnaireImport();
            $import->import($this->form->questionnaire_file->getRealPath());
            $rows = Excel::toArray(new QuestionnaireImport(), $this->form->questionnaire_file->getRealPath())[0];

            $metadata = (new BuildMetadataAction)->execute(
                rows: $rows,
                yellow_risk_evaluation: $this->form->yellow_risk_evaluation,
                red_risk_evaluation: $this->form->red_risk_evaluation,
                title: $this->form->title,
                subtitle: $this->form->subtitle,
                instructions: $this->form->instructions,
                objectives: $this->form->objectives
            );

            $file_original_name = $this->form->questionnaire_file->getClientOriginalName();
            $file_name = Auth::user()->company->id . '_' . Str::replace(' ', '_', trim(Str::lower(Auth::user()->company->name))) . '_' . time() . '_' . $file_original_name;
            $file_path = $this->form->questionnaire_file->storeAs('questionnaires', $file_name, 'public');
            $metadata['file_path'] = $file_path;

            Questionnaire::create([
                'questionnaire_category_id' => $this->form->questionnaire_category,
                'organization_id' => Auth::user()->organization->id,
                'company_id' => Auth::user()->company->id,
                'name' => $this->form->title,
                'description' => $this->form->subtitle,
                'metadata' => $metadata,
                'is_base' => false,
            ]);

            DB::commit();
            $this->js('new JSConfetti().addConfetti()');
            $this->dispatch('toast', message: __('Cuestionario guardado exitosamente.'), type: 'success');
            $this->reset([
                'form.title',
                'form.subtitle',
                'form.instructions',
                'form.objectives',
                'form.yellow_risk_evaluation',
                'form.red_risk_evaluation',
                'form.questionnaire_file',
                'form.questionnaire_category',
                'form.import_errors'
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            $this->reset(['form.questionnaire_file']);
            $failure = $e->failures()[0] ?? null;
            if ($failure) {
                $row = $failure->row();
                $identificador = 'Fila ' . $row;
                $error = $failure->errors()[0] ?? $e->getMessage();
                $this->form->import_errors = __('Error al guardar el cuestionario: ') . $error . " ($identificador)";
                $this->dispatch('toast', message: $this->form->import_errors, type: 'error');
            } else {
                $this->form->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
                $this->dispatch('toast', message: $this->form->import_errors, type: 'error');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->reset(['form.questionnaire_file']);
            $this->form->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
            $this->dispatch('toast', message: $this->form->import_errors, type: 'error');
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
