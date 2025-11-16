@props([
    'search_placeholder' => '',
    'headers' => []
])

<div class="space-y-5">
    {{-- Search --}}
    <div class="w-full lg:w-1/3">
        <flux:input
            icon="magnifying-glass"
            placeholder="{{ $search_placeholder }}"
            wire:model.live="search_query"
        />
    </div>

    {{-- Display table --}}
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
               {{ $table }}
            </tbody>
        </table>
    </div>

    {{-- Pagination controls --}}
    {{-- <div class="w-full flex flex-col md:flex-row md:items-center justify-between">
        <flux:heading>{{ __('Resultados') }}: {{ $totalResults }}</flux:heading>
        <div class="flex items-center justify-between md:justify-around gap-5">
            <flux:text class="mt-2">{{ __('Página') }} {{ $currentPage }} {{ __('de') }} {{ max(1, $totalPages) }}</flux:text>
            <div class="flex items-center gap-2">
                <flux:button
                    variant="primary"
                    wire:click="previousPage"
                    :disabled="$currentPage <= 1"
                    :class="$currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Anterior') }}
                </flux:button>
                <flux:button
                    variant="primary"
                    wire:click="nextPage"
                    :disabled="$currentPage >= $totalPages"
                    :class="$currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : ''"
                >
                    {{ __('Siguiente') }}
                </flux:button>
            </div>
        </div>
    </div> --}}
</div>
