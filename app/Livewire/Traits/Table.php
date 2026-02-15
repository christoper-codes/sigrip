<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

trait Table
{
    public array $headers = [];
    public array $table_items = [];
    public int $current_page = 1;
    public int $per_page = 10;
    public array $search_fields = [];
    public string $search_query = '';
    public array $paginated_items = [];
    public array $filtered_items = [];
    public int $total_results = 0;
    public int $total_pages = 0;
    public string $sort_field = '';
    public string $sort_direction = 'asc';
    public array $sortable_fields = [];

    public function updatedSearchQuery(): void
    {
        $this->current_page = 1;
        $this->refreshTableData();
    }

    public function sortBy(string $field): void
    {
        $can_sort = false;

        if (isset($this->headers) && is_array($this->headers)) {
            foreach ($this->headers as $header) {
                if (is_array($header) &&
                    isset($header['field']) &&
                    $header['field'] === $field &&
                    ($header['sortable'] ?? false)) {
                    $can_sort = true;
                    break;
                }
            }
        } elseif (isset($this->sortable_fields) && in_array($field, $this->sortable_fields)) {
            $can_sort = true;
        }

        if (! $can_sort) {
            return;
        }

        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'asc';
        }

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
        $items = $this->table_items;
        if (! empty($this->search_query)) {
            $items = array_filter($items, function ($item) {
                foreach ($this->search_fields as $field) {
                    $value = data_get($item, $field);
                    if ($value && str_contains(strtolower($value), strtolower($this->search_query))) {
                        return true;
                    }
                }

                return false;
            });
        }

        if (! empty($this->sort_field)) {
            usort($items, function ($a, $b) {
                $valueA = data_get($a, $this->sort_field);
                $valueB = data_get($b, $this->sort_field);

                if (is_numeric($valueA) && is_numeric($valueB)) {
                    $result = $valueA <=> $valueB;
                } else {
                    $result = strcmp(strtolower($valueA ?? ''), strtolower($valueB ?? ''));
                }

                return $this->sort_direction === 'desc' ? -$result : $result;
            });
        }

        return $items;
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

    public function resetTable(): void
    {
        $this->mount();
    }
}
