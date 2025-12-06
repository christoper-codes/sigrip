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
                :headers="$headers"
                search_placeholder="{{ __('Nombre o email') }}"
                :total_results="$total_results"
                :current_page="$current_page"
                :total_pages="$total_pages"
                :paginated_items="$paginated_items"
                :sort_field="$sort_field"
                :sort_direction="$sort_direction"
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
                                <td class="p-4">
                                    <flux:button icon="trash" wire:click="confirmDestroy({{ $employee['id'] }}, '{{ $employee['name'] }}')"></flux:button>
                                </td>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:table>
            </x-appearance.livewiretable>
        </div>
    @else
        <div class="mt-10 max-w-2xl w-full">
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
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

    <flux:modal name="confirm-destroy-employee-modal" class="w-[90%] md:w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de eliminar este empleado?') }}</flux:heading>
                <flux:text class="mt-2">
                    {{ __('Esta acción no se puede deshacer. El empleado perderá acceso a su cuenta.') }}
                </flux:text>
                <flux:text class="mt-4">
                    {{ __('Empleado:') }} <span class="font-semibold">{{ $employee_name }}</span>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="destroyEmployee">{{ __('Eliminar') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

