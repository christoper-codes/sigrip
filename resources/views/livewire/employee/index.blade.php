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
        <div x-data="{ animation: false }"
            x-init="$nextTick(() => animation = true)"
            x-show="animation"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="mt-10">
            <x-appearance.livewiretable
                :headers="[
                    __('Nombre'),
                    __('Email'),
                    __('Roles'),
                    __('Fecha de Creación'),
                    __('Aplicaciones'),
                    __('Actualizar roles')
                ]"
                search_placeholder="{{ __('Nombre o email') }}"
                :total_results={{ $total_results}}
                :current_page={{ $current_page }}
                :total_pages="1"
                >
                <x-slot:table>
                    @foreach ($paginated_items as $employee)
                        <tr>
                            <td class="p-4">{{ $employee['name'] }}</td>
                            <td class="p-4">{{ $employee['email'] ?? 'Sin email' }}</td>
                            <td class="p-4">{{ implode(', ', array_map(fn($role) => $role['name'], $employee['user_roles'] ?? [])) ?: 'Sin roles' }}</td>
                            <td class="p-4">{{ $employee['created_at'] }}</td>
                            <td class="p-4">
                                <flux:link href="{{ route('dashboard') }}">{{ __('Ver aplicaciones') }}</flux:link>
                            </td>
                            <td class="p-4">
                                <flux:modal.trigger name="update-roles-{{ $employee['id'] }}">
                                    <flux:button>{{ __('Actualizar roles') }}</flux:button>
                                </flux:modal.trigger>
                                <flux:modal name="update-roles-{{ $employee['id'] }}" class="md:w-96">
                                    <div>
                                        @if($employee && isset($employee['id']))

                                        @endif
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                    @endforeach
                    @if(! $paginated_items)
                        <tr>
                            <td colspan="6" class="p-8 text-center opacity-70">
                                {{ __('No se encontraron resultados') }}
                            </td>
                        </tr>
                    @endif
                </x-slot:table>
            </x-appearance.livewiretable>
        </div>
    @endif
</div>

