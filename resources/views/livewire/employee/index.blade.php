<div>
   <form wire:submit.prevent='searchEmployees'>
        <flux:field class="max-w-md w-full">
            <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
            <flux:select class="!h-12" name="department" placeholder="{{ __('Selecciona un departamento') }}">
                <flux:select.option>Photography</flux:select.option>
                <flux:select.option>Design services</flux:select.option>
                <flux:select.option>Web development</flux:select.option>
            </flux:select>
            <flux:error name="department"/>
        </flux:field>
        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar empleados') }}</flux:button>
   </form>
   <x-appearance.table
        :items="$employees"
        :headers="[
            __('Nombre'),
            __('Email'),
            __('Role'),
            __('Fecha de Creación'),
            __('Estado'),
            __('Aplicaciones')
        ]"
        :searchFields="['name']"
        :perPage="10"
        searchPlaceholder="{{ __('Buscar departamento...') }}"
    >
        <td class="p-4" x-text="item.name"></td>
        <td class="p-4" x-text="item.email || 'Sin email'"></td>
        <td class="p-4" x-text="item.role"></td>
        <td class="p-4" x-text="new Date(item.created_at).toLocaleDateString('es-MX')"></td>
        <td class="p-4">
            <x-appearance.badge status="active" />
        </td>
        <td class="p-4">
            <flux:button>{{ __('Ver aplicaciones') }}</flux:button>
        </td>
    </x-appearance.table>
</div>

