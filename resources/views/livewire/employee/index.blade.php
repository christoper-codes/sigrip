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
   @if($table_items)
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
                total_results="{{ $total_results }}"
                current_page="{{ $current_page }}"
                total_pages="{{ $total_pages }}"
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
                                <flux:button
                                    class="!w-full"
                                    wire:click="openRoleModal({{ $employee['id'] }})"
                                    :loading="false"
                                    x-data="{ loading: false }"
                                    x-on:click="loading = true; $wire.openRoleModal({{ $employee['id'] }}).then(() => loading = false)"
                                >
                                    <span x-show="!loading">{{ __('Actualizar') }}</span>
                                    <span x-show="loading"><flux:icon.loading class="!size-4"/></span>
                                </flux:button>
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
    <flux:modal name="update-roles-modal" class="w-[90%] md:w-lg">
        <div class="pt-5 px-2">
            @if($selected_employee_id && $roles)
                <flux:checkbox.group wire:model="employee_roles">
                    @foreach ($roles as $role)
                        <flux:checkbox
                            value="{{ $role['id'] }}"
                            label="{{ $role['name'] }}"
                            description="{{ $role['description'] ?? '' }}"
                        />
                    @endforeach
                </flux:checkbox.group>

                <div class="flex justify-end gap-2 mt-6">
                    <flux:modal.close>
                        <flux:button variant="ghost">
                            {{ __('Cancelar') }}
                        </flux:button>
                    </flux:modal.close>

                    <flux:button variant="primary" wire:click="updateEmployeeRoles">
                        {{ __('Actualizar') }}
                    </flux:button>
                </div>
            @endif
        </div>
    </flux:modal>
</div>

