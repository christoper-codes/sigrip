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
        :perPage="2"
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
</div>
