<?php

namespace App\Livewire\Questionnaire;

use App\Livewire\Traits\Table;
use Livewire\Component;

class Index extends Component
{
    use Table;

    public function mount()
    {
        $this->search_fields = ['name'];
        $this->headers = [
            ['label' => __('Nombre'), 'field' => 'name', 'sortable' => true],
            ['label' => __('Tipo')],
            ['label' => __('Descripción')],
            ['label' => __('Preguntas')],
            ['label' => __('Risk de evaluación')],
            ['label' => __('Fecha de Creación'), 'field' => 'created_at', 'sortable' => true],
            ['label' => __('Estado')],
            ['label' => __('Acciones')],
        ];
    }

    public function render()
    {
        return view('livewire.questionnaire.index');
    }
}
