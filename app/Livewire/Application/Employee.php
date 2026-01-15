<?php

namespace App\Livewire\Application;

use App\Livewire\Traits\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Employee extends Component
{
    use Table;

    public ?array $applications = null;

    public function mount(): void
    {
        $applications = Auth::user()->applications()
            ->limit(10)
            ->orderByDesc('created_at')
            ->get()
            ->toArray();

        foreach ($applications as &$application) {
            $application['slug_normalized'] = strtolower(str_replace('-', ' ', $application['slug']));
        }
        unset($application);

        $this->table_items = $applications;
        $this->search_fields = ['slug_normalized'];
        $this->headers = [
            ['label' => __('Nombre del cuestionario')],
            ['label' => __('Aplicar')],
            ['label' => __('Se ha respondido')],
            ['label' => __('Fecha de Inicio'), 'field' => 'start_date', 'sortable' => true],
            ['label' => __('Fecha de Expiración'), 'field' => 'expiration_date', 'sortable' => true],
            ['label' => __('Fecha de respuesta'), 'field' => 'response_date', 'sortable' => true],
        ];
         $this->refreshTableData();
    }

    public function render()
    {
        return view('livewire.application.employee');
    }
}
