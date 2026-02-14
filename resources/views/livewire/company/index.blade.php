<div>
    <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Buscar compañia') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $company)
                <tr>
                    <td class="p-4">{{ $company['name'] }}</td>
                    <td class="p-4">{{ auth()->user()->name }}</td>
                    <td class="p-4">{{ $company['description'] ?? 'Sin descripción' }}</td>
                    <td class="p-4">
                        <a href="{{ route('department.index') }}" wire:navigate>
                            <flux:button variant="filled">{{ __('Departamentos') }}</flux:button>
                        </a>
                    </td>
                    <td class="p-4">{{ $company['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge status="active" />
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>

    @if(auth()->user()->company_id)
        <div class="mt-10">
            <livewire:ticket.link />
        </div>
    @endif

    <div class="mt-10">
        <flux:heading size="lg">{{ __('Departamentos asociados') }}</flux:heading>
        <flux:text class="mt-2">
            {{ $departments ?  __('Seleccione un departamento para ver más detalles') : __('No hay departamentos asociados a esta compañía.') }}
        </flux:text>

        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($departments as $department)
                <a href="#" class="hover:scale-105 transition-transform duration-500 cursor-pointer flex flex-col gap-8 p-5 rounded-xl bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700">
                    <div>
                        <flux:heading>{{ $department['name'] }}</flux:heading>
                        <flux:text class="mt-2">{{ $department['description'] ?? 'Sin descripción' }}</flux:text>
                    </div>
                    <flux:text>{{__('Administración: ')}} </flux:text>
                </a>
            @endforeach
        </div>
    </div>
</div>
