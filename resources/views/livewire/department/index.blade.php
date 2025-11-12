<div>
    <x-appearance.table
        :items="$departments"
        :headers="[
            __('Nombre'),
            __('Administrador'),
            __('Descripción'),
            __('Fecha de Creación'),
            __('Estado')
        ]"
        :searchFields="['name']"
        :perPage="10"
        searchPlaceholder="{{ __('Buscar departamento...') }}"
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
    </div>
</div>
