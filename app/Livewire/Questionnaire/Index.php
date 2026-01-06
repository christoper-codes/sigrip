<?php

namespace App\Livewire\Questionnaire;

use App\Actions\Questionnaire\BuildMetadataAction;
use App\Enums\NotificationTypesEnum;
use App\Imports\QuestionnaireImport;
use App\Livewire\Forms\QuestionnaireForm;
use App\Livewire\Traits\Table;
use App\Models\Questionnaire;
use App\Models\QuestionnaireCategory;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Validators\ValidationException;

class Index extends Component
{
    use WithFileUploads;
    use Table;

    public QuestionnaireForm $form;

    public ?Questionnaire $questionnaire = null;
    public ?array $questionnaire_data = null;
    public ?int $total_questions = null;
    public ?string $questionnaire_name = null;
    public ?int $questionnaire_id = null;
    public array $color_order = ['green', 'yellow', 'red'];

    public function mount()
    {
        $this->table_items = Questionnaire::where(function ($query) {
            $query->where('is_base', true)
            ->orWhere('company_id', Auth::user()->company?->id);
        })
        ->with('category')
        ->get()->toArray();

        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre del cuestionario'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Categoria')],
            ['label' => __('Descripción del cuestionario')],
            ['label' => __('Preguntas')],
            ['label' => __('Risk de evaluación')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Activar')],
            ['label' => __('Acciones')],
        ];
        $this->refreshTableData();

        $this->form->questionnaire_categories = QuestionnaireCategory::all()->toArray();
    }

    public function showDetails(int $id): void
    {
        $questionnaire = Questionnaire::find($id);
        $this->questionnaire_data = $questionnaire->metadata;
        $this->total_questions = collect($this->questionnaire_data['themes'] ?? [])->sum(function ($theme) {
            return count($theme['questions'] ?? []);
        });

        Flux::modal('questionnaire-details-modal')->show();
    }

    public function showRiskDetails(int $id): void
    {
        $questionnaire = Questionnaire::find($id);
        $this->questionnaire_data = $questionnaire->metadata;

        Flux::modal('questionnaire-risk-modal')->show();
    }

    public function updateStatus(int $id): void
    {
        $questionnaire = Questionnaire::find($id);
        if($questionnaire->is_base){
            $this->dispatch('toast', message: __('No se puede cambiar el estado de un cuestionario base.'), type: NotificationTypesEnum::ERROR->value);
            return;
        }
        $questionnaire->is_active = ! $questionnaire->is_active;
        $questionnaire->save();

        $this->dispatch('toast', message: __('Estado actualizado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->mount();
    }

    public function editQuestionnaire(int $id): void
    {
        $this->questionnaire = Questionnaire::find($id);
        $this->questionnaire_id = $this->questionnaire->id;
        $this->form->title = $this->questionnaire->name;
        $this->form->subtitle = $this->questionnaire->description;
        $this->form->instructions = $this->questionnaire->metadata['instructions'] ?? null;
        $this->form->questionnaire_category = $this->questionnaire->questionnaire_category_id;
        $this->form->objectives = $this->questionnaire->metadata['objectives'] ?? null;
        $this->form->yellow_risk_evaluation = $this->questionnaire->metadata['risk_evaluation']['yellow'] ?? null;
        $this->form->red_risk_evaluation = $this->questionnaire->metadata['risk_evaluation']['red'] ?? null;
        $this->form->questionnaire_file_path = $this->questionnaire->metadata['file_path'] ?? null;

        Flux::modal('edit-questionnaire-modal')->show();
    }

    public function confirmUpdateQuestionnaire(): void
    {
       $this->form->validate();
       if($this->form->questionnaire_file && $this->questionnaire->applications()->count() > 0){
            $this->form->import_errors = __('No se puede actualizar el archivo del cuestionario porque está asociado a aplicaciones.');
            return;
       }

       if($this->questionnaire->is_base){
            $this->form->import_errors = __('No se puede actualizar un cuestionario base.');
            return;
        }

        DB::beginTransaction();
        try {
            $metadata = $this->questionnaire->metadata;
            $metadata['title'] = $this->form->title;
            $metadata['subtitle'] = $this->form->subtitle;
            $metadata['instructions'] = $this->form->instructions;
            $metadata['objectives'] = $this->form->objectives;
            $risk_evaluation = [
                'green' => [["label" => __("Bienestar alto"), "criteria" => __("Sin respuestas críticas")]],
                'yellow' => $this->form->yellow_risk_evaluation,
                'red' => $this->form->red_risk_evaluation,
            ];
            $metadata['risk_evaluation'] = $risk_evaluation;

            if ($this->form->questionnaire_file) {
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
            }

            $this->questionnaire->metadata = $metadata;
            $this->questionnaire->name = $this->form->title;
            $this->questionnaire->description = $this->form->subtitle;
            $this->questionnaire->questionnaire_category_id = $this->form->questionnaire_category;
            $this->questionnaire->save();

            DB::commit();
            $this->dispatch('toast', message: __('Cuestionario actualizado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
            $this->mount();
            Flux::modal('edit-questionnaire-modal')->close();
        } catch (ValidationException $e) {
            DB::rollBack();
            $this->reset(['form.questionnaire_file']);
            $failure = $e->failures()[0] ?? null;
            if ($failure) {
                $row = $failure->row();
                $identificador = 'Fila ' . $row;
                $error = $failure->errors()[0] ?? $e->getMessage();
                $this->form->import_errors = __('Error al guardar el cuestionario: ') . $error . " ($identificador)";
            } else {
                $this->form->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->reset(['form.questionnaire_file']);
            $this->form->import_errors = __('Error al guardar el cuestionario: ') . $e->getMessage();
        }
    }

    public function editModalClosed()
    {
        $this->reset([
            'form.title',
            'form.subtitle',
            'form.instructions',
            'form.objectives',
            'form.yellow_risk_evaluation',
            'form.red_risk_evaluation',
            'form.questionnaire_file',
            'form.questionnaire_file_path',
            'form.questionnaire_category',
            'form.import_errors'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function confirmDestroy(string $questionnaire_name, int $id): void
    {
        $this->questionnaire_name = $questionnaire_name;
        $this->questionnaire_id = $id;

        Flux::modal('destroy-questionnaire-modal')->show();
    }

    public function destroy(): void
    {
        $questionnaire = Questionnaire::find($this->questionnaire_id);
        if($questionnaire->is_base){
            Flux::modal('destroy-questionnaire-modal')->close();
            $this->dispatch('toast', message: __('No se puede eliminar un cuestionario base.'), type: NotificationTypesEnum::ERROR->value);
            return;
        }
        if($questionnaire->applications()->count() > 0){
            Flux::modal('destroy-questionnaire-modal')->close();
            $this->dispatch('toast', message: __('No se puede eliminar el cuestionario porque está asociado a aplicaciones.'), type: NotificationTypesEnum::ERROR->value);
            return;
        }

        $questionnaire->delete();
        Flux::modal('destroy-questionnaire-modal')->close();
        $this->dispatch('toast', message: __('Cuestionario eliminado correctamente.'), type: NotificationTypesEnum::SUCCESS->value);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.questionnaire.index');
    }
}
