<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

trait LimitItems
{
    public array $search_options = [
        ['label' => '5', 'value' => 5],
        ['label' => '10', 'value' => 10],
        ['label' => '20', 'value' => 20],
        ['label' => 'Todos', 'value' => -1],
    ];
    public int $items_per_page = 10;
}
