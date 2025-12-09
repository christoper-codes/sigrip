@props([
    'search_placeholder' => '',
    'headers' => [],
    'total_results' => 0,
    'current_page' => 1,
    'total_pages' => 1,
    'paginated_items' => [],
    'sortable_fields' => [],
    'sort_field' => '',
    'sort_direction' => 'asc',
])

<div class="space-y-5">
    {{-- Search --}}
    <div class="w-full lg:w-[80%] flex flex-col-reverse md:flex-row md:items-center gap-2">
        <flux:input
            icon="magnifying-glass"
            placeholder="{{ $search_placeholder }}"
            wire:model.live="search_query"
            utocomplete="off"
        />
        <div class="inline md:w-full">
            <flux:button icon="arrow-path" wire:click="resetTable" class="p-6!" />
        </div>
    </div>

    {{-- Display table --}}
    <div class="overflow-hidden w-full overflow-x-auto rounded-lg border border-light-variant dark:border-dark-variant">
        <table class="w-full text-left text-sm">
            <thead class="border-b bg-light-variant dark:bg-dark-variant text-sm border-light-variant dark:border-dark-variant">
                <tr>
                    @foreach($headers as $index => $header)
                        <th class="p-4 whitespace-nowrap">
                            @php
                                if (is_array($header)) {
                                    $label = $header['label'] ?? '';
                                    $field = $header['field'] ?? null;
                                    $sortable = $header['sortable'] ?? false;
                                } else {
                                    $label = $header;
                                    $field = $sortable_fields[$index] ?? null;
                                    $sortable = $field && in_array($field, $sortable_fields);
                                }
                            @endphp

                            @if($sortable && $field)
                                <button
                                    wire:click="sortBy('{{ $field }}')"
                                    class="flex items-center gap-2 font-medium cursor-pointer"
                                >
                                    <span>{{ $label }}</span>

                                    @if($sort_field === $field)
                                        @if($sort_direction === 'asc')
                                            <flux:icon.chevron-up class="size-4" />
                                        @else
                                            <flux:icon.chevron-down class="size-4" />
                                        @endif
                                    @else
                                        <flux:icon.chevron-up-down class="size-4 opacity-50" />
                                    @endif
                                </button>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-light-variant dark:divide-dark-variant">
                {{ $table }}

                @if(! $paginated_items || count($paginated_items) === 0)
                    <tr>
                        <td colspan="{{ count($headers) }}" class="p-8 text-center opacity-70">
                            {{ __('No se encontraron resultados') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination controls --}}
    <div class="w-full flex flex-col md:flex-row md:items-center justify-between">
        <flux:heading>{{ __('Resultados') }}: {{ $total_results }}</flux:heading>
        <div class="flex items-center justify-between md:justify-around gap-5">
            <flux:text class="mt-2">{{ __('Página') }} {{ $current_page }} {{ __('de') }} {{ max(1, $total_pages) }}</flux:text>
            <div class="flex items-center gap-2">
                <flux:button
                    variant="primary"
                    wire:click="previousPage"
                    :disabled="$current_page <= 1"
                    :class="$current_page <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Anterior') }}
                </flux:button>
                <flux:button
                    variant="primary"
                    wire:click="nextPage"
                    :disabled="$current_page >= $total_pages"
                    :class="$current_page >= $total_pages ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Siguiente') }}
                </flux:button>
            </div>
        </div>
    </div>
</div>
