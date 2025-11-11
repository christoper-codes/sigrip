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
        searchPlaceholder="Buscar por nombre o descripción..."
    >
        <td class="p-4" x-text="item.name"></td>
        <td class="p-4">{{ auth()->user()->name }}</td>
        <td class="p-4" x-text="item.description || 'Sin descripción'"></td>
        <td class="p-4" x-text="new Date(item.created_at).toLocaleDateString('es-MX')"></td>
        <td class="p-4">
            <div class="border-2 border-green-500 text-green-500 rounded-full py-2 px-4 inline-block text-center text-xs">
                Activo
            </div>
        </td>
    </x-appearance.table>
</div>
