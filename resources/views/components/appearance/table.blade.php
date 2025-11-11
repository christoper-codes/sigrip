@props([
    'items' => [],
    'headers' => [],
    'searchFields' => [],
    'perPage' => 10,
    'searchPlaceholder' => 'Buscar...'
])

@php
    if (is_string($headers)) {
        $headers = json_decode($headers, true) ?: [];
    }
@endphp

<div x-data="{
    searchQuery: '',
    currentPage: 1,
    itemsPerPage: {{ $perPage }},
    allItems: @js($items),
    searchableFields: @js($searchFields),

    get filteredItems() {
        if (!this.searchQuery) return this.allItems;

        return this.allItems.filter(item => {
            return this.searchableFields.some(field => {
                const value = this.getNestedValue(item, field);
                return value && value.toString().toLowerCase().includes(this.searchQuery.toLowerCase());
            });
        });
    },

    getNestedValue(obj, path) {
        return path.split('.').reduce((current, key) => current && current[key], obj);
    },

    get totalPages() {
        return Math.ceil(this.filteredItems.length / this.itemsPerPage);
    },

    get paginatedItems() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.filteredItems.slice(start, end);
    },

    get totalResults() {
        return this.filteredItems.length;
    },

    nextPage() {
        if (this.currentPage < this.totalPages) {
            this.currentPage++;
        }
    },

    prevPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
        }
    },

    resetToFirstPage() {
        this.currentPage = 1;
    }
}" class="w-full flex flex-col gap-5">
    <div class="w-full lg:w-1/3">
        <flux:input
            icon="magnifying-glass"
            placeholder="{{ $searchPlaceholder }}"
            x-model="searchQuery"
            x-on:input="resetToFirstPage()"
        />
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-lg border border-light-variant dark:border-dark-variant">
        <table class="w-full text-left text-sm">
            <thead class="border-b bg-light-variant dark:bg-dark-variant text-sm border-light-variant dark:border-dark-variant">
                <tr>
                    @foreach($headers as $header)
                        <th class="p-4">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-light-variant dark:divide-dark-variant">
                <template x-for="item in paginatedItems" x-bind:key="item.id">
                    <tr>
                        {{ $slot }}
                    </tr>
                </template>

                {{-- Dont found results --}}
                <tr x-show="paginatedItems.length === 0" x-cloak>
                    <td colspan="{{ count($headers) }}" class="p-8 text-center text-gray-500">
                        {{ __('No se encontraron resultados') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="w-full flex flex-col md:flex-row md:items-center justify-between">
        <flux:heading x-text="'{{ __('Resultados:') }} ' + totalResults"></flux:heading>
        <div class="flex items-center justify-between md:justify-around gap-5">
            <flux:text class="mt-2" x-text="'{{ __('Página') }} ' + currentPage + ' {{ __('de') }} ' + totalPages"></flux:text>
            <div class="flex items-center gap-2">
                <flux:button
                    variant="primary"
                    x-on:click="prevPage()"
                    x-bind:disabled="currentPage === 1"
                    x-bind:class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Anterior') }}
                </flux:button>
                <flux:button
                    variant="primary"
                    x-on:click="nextPage()"
                    x-bind:disabled="currentPage === totalPages"
                    x-bind:class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Siguiente') }}
                </flux:button>
            </div>
        </div>
    </div>
</div>
