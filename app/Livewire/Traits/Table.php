<?php

namespace App\Livewire\Traits;

trait Table
{
    public string $search_query = '';
    public int $current_page = 1;
    public int $per_page = 2;
    public array $search_fields = [];
    public array $paginated_items = [];
    public array $filtered_items = [];
    public int $total_results = 0;
    public int $total_pages = 0;

    public function updatedSearchQuery(): void
    {
        $this->current_page = 1;
        $this->refreshTableData();
    }

    public function nextPage(): void
    {
        $total_pages = $this->getTotalPages();
        if ($this->current_page < $total_pages) {
            $this->current_page++;
        }
        $this->refreshTableData();
    }

    public function previousPage(): void
    {
        if ($this->current_page > 1) {
            $this->current_page--;
        }
        $this->refreshTableData();
    }

    public function getTotalPages(): int
    {
        $filtered_items = $this->getFilteredItems();
        return ceil(count($filtered_items) / $this->per_page);
    }

    public function getFilteredItems(): array
    {
        if (empty($this->search_query)) {
            return $this->table_items;
        }

        return array_filter($this->table_items, function ($item) {
            foreach ($this->search_fields as $field) {
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
        $filtered_items = $this->getFilteredItems();
        $offset = ($this->current_page - 1) * $this->per_page;
        return array_slice($filtered_items, $offset, $this->per_page);
    }

    public function refreshTableData(): void
    {
        $this->filtered_items = $this->getFilteredItems();
        $this->total_results = count($this->filtered_items);
        $this->total_pages = $this->getTotalPages();
        $this->paginated_items = $this->getPaginatedItems();
    }
}
