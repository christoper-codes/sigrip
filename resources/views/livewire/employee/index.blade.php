<div>
   <form wire:submit.prevent='searchEmployees'>
        <flux:field class="max-w-md w-full">
            <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
            <flux:select class="!h-12" name="department" wire:model.live="department">
                <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                @foreach ($departments as $department)
                    <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>)
                @endforeach
            </flux:select>
            <flux:error name="department" class="!mt-0"/>
        </flux:field>
        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar empleados') }}</flux:button>
   </form>
   @if($employees)
        <div
            x-data="{ animation: false }"
            x-init="$nextTick(() => animation = true)"
            x-show="animation"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="mt-10">
            <x-appearance.table
                :items="$employees"
                :headers="[
                    __('Nombre'),
                    __('Email'),
                    __('Roles'),
                    __('Fecha de Creación'),
                    __('Aplicaciones'),
                    __('Actualizar roles')
                ]"
                :searchFields="['name']"
                :perPage="10"
                searchPlaceholder="{{ __('Buscar departamento...') }}"
                >
                <td class="p-4" x-text="item.name"></td>
                <td class="p-4" x-text="item.email || 'Sin email'"></td>
                <td class="p-4" x-text="item.user_roles?.map(role => role.name).join(', ') || 'Sin roles'"></td>
                <td class="p-4" x-text="new Date(item.created_at).toLocaleDateString('es-MX')"></td>
                <td class="p-4">
                    <flux:link href="{{ route('dashboard') }}">{{ __('Ver aplicaciones') }}</flux:link>
                </td>
                <td class="p-4">
                    <flux:modal.trigger name="update-roles">
                        <flux:button>{{ __('Actualizar roles') }}</flux:button>
                    </flux:modal.trigger>
                    <flux:modal name="update-roles" class="md:w-96">
                        <div>
                            <span x-text="item.name"></span>
                        </div>
                    </flux:modal>
                </td>
            </x-appearance.table>
        </div>
    @endif
</div>

