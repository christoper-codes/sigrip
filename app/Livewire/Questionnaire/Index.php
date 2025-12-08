<?php

namespace App\Livewire\Questionnaire;

use App\Livewire\Traits\Table;
use App\Models\Questionnaire;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public ?array $questionnaire_data = null;

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
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Tipo')],
            ['label' => __('Descripción')],
            ['label' => __('Preguntas')],
            ['label' => __('Risk de evaluación')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Activar')],
        ];
        $this->refreshTableData();
    }

    public function showDetails(int $id): void
    {
        $questionnaire = Questionnaire::find($id);
        $this->questionnaire_data = $questionnaire->metadata;

        Flux::modal('questionnaire-details-modal')->show();
    }

    public function updateStatus(int $id): void
    {
        $questionnaire = Questionnaire::find($id);
        $questionnaire->is_active = ! $questionnaire->is_active;
        $questionnaire->save();

        $this->dispatch('toast', message: __('Estado actualizado correctamente.'), type: 'success');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.questionnaire.index');
    }
}
