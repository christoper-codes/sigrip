<div>
    <x-appearance.table
        :items="$companies"
        :headers="[
            __('Nombre'),
            __('Administrador'),
            __('Descripción'),
            __('Fecha de Creación'),
            __('Estado')
        ]"
        :searchFields="['name', 'description']"
        :perPage="10"
        searchPlaceholder="{{ __('Buscar compañia...') }}"
    >
        <td class="p-4" x-text="item.name"></td>
        <td class="p-4">{{ auth()->user()->name }}</td>
        <td class="p-4" x-text="item.description || 'Sin descripción'"></td>
        <td class="p-4" x-text="new Date(item.created_at).toLocaleDateString('es-MX')"></td>
        <td class="p-4">
            <x-appearance.badge status="active" />
        </td>
    </x-appearance.table>
    <div class="mt-10">
        <flux:heading size="lg">{{ __('Departamentos asociados') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Seleccione un departamento para ver más detalles') }}</flux:text>

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
