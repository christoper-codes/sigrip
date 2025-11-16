<?php

namespace App\Livewire\Traits;

trait Table
{
    public string $search_query = '';
    public int $currentPage = 1;
    public int $perPage = 10;
    public array $searchFields = ['name', 'email'];

    public function updatedSearchQuery(): void
    {
        $this->currentPage = 1;
    }

    public function nextPage(): void
    {
        $totalPages = $this->getTotalPages();
        if ($this->currentPage < $totalPages) {
            $this->currentPage++;
        }
    }

    public function previousPage(): void
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function getTotalPages(): int
    {
        $filteredItems = $this->getFilteredItems();
        return ceil(count($filteredItems) / $this->perPage);
    }

    public function getFilteredItems(): array
    {
        if (empty($this->search_query)) {
            return $this->employees;
        }

        return array_filter($this->employees, function ($item) {
            foreach ($this->searchFields as $field) {
                $value = data_get($item, $field);
                if ($value && str_contains(strtolower($value), strtolower($this->search_query))) {
                    return true;
                }
            }
            return false;
        });
    }

    public function getPaginatedItems(): array
    {
        $filteredItems = $this->getFilteredItems();
        $offset = ($this->currentPage - 1) * $this->perPage;
        return array_slice($filteredItems, $offset, $this->perPage);
    }
}
