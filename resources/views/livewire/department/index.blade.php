<div>
     <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre del departamento') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $department)
                <tr>
                    <td class="p-4">{{ $department['name'] }}</td>
                    <td class="p-4">{{ $department['manager']['name'] ?? 'Sin administrador' }}</td>
                    <td class="p-4">{{ $department['email'] ?? 'Sin email' }}</td>
                    <td class="p-4">{{ $department['description'] ?? 'Sin descripción' }}</td>
                    <td class="p-4">{{ $department['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge status="active" />
                    </td>
                    <td class="p-4">
                       <flux:button variant="filled" icon="pencil" wire:click="editDepartment({{ $department['id'] }})" />
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>

    <div class="mt-10">
        <flux:heading size="lg">{{ __('Agregar empleados') }}</flux:heading>
        <flux:button href="{{ route('employee.index') }}" icon="users" class="mt-5! !w-full !max-w-xs !py-8 !border !border-primary !bg-primary/10 !rounded-2xl !text-sm !cursor-pointer hover:!bg-primary/5 !transition-colors !shadow-xl/50 !shadow-primary/20">
            {{ __('Empleados') }}
        </flux:button>
    </div>

    <div class="mt-10">
        <flux:heading size="lg">{{ __('Aplicaciones activas') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Seleccione una aplicacion para ver más detalles') }}</flux:text>
    </div>

    <flux:modal name="edit-department-modal" class="w-[90%] md:w-2xl!" @close="editModalClosed()">
        <form wire:submit.prevent="submit" class="space-y-6">
            <flux:field>
                <flux:label>{{ __('Nombre') }}</flux:label>
                <flux:input name="name" wire:model="form.name" icon="users" placeholder="{{ __('Recursos Humanos') }}"/>
                <flux:error name="name" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Email') }}</flux:label>
                <flux:input name="email" wire:model="form.email" icon="envelope" placeholder="{{ __('hello@neura.com') }}"/>
                <flux:error name="email" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Teléfono') }}</flux:label>
                <flux:input name="phone" wire:model="form.phone" mask="(999) 999-9999" icon="phone" placeholder="{{ __('(555) 555-5555') }}"/>
                <flux:error name="phone" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Descripción') }}</flux:label>
                <flux:textarea name="description" resize="none" wire:model="form.description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Departamento de recursos humanos') }}"/>
                <flux:error name="description"/>
            </flux:field>
            <flux:field>
                <div class="flex items-start gap-2 mt-2">
                    <flux:icon.chat-bubble-oval-left />
                    <flux:text>{{ __('Esta sección es opcional') }}</flux:text>
                </div>
                <flux:modal.trigger name="edit-manage-manager">
                    <flux:button class="py-6">{{ __('Gerente del departamento') }}</flux:button>
                </flux:modal.trigger>
            </flux:field>
            <flux:field>
                <flux:switch label="Es departamento de RH" wire:model="form.hr_department" align="left" name="hr_department"/>
                <flux:error name="hr_department" />
            </flux:field>
            <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
        </form>
        <flux:modal name="edit-manage-manager" class="w-[90%] md:w-xl">
            <div>
                <flux:heading size="lg">{{ __('Actualizar gerente') }}</flux:heading>
                <div class="flex items-start gap-2 mt-2">
                    <flux:icon.chat-bubble-oval-left-ellipsis />
                    <flux:text>{{ __('Busque y seleccione un gerente para el departamento.') }}</flux:text>
                </div>
                <div class="mt-5 space-y-3">
                    <div>
                        <form wire:submit.prevent='searchManager'>
                            <flux:label>{{ __('Buscar y asignar gerente') }}</flux:label>
                            <flux:input name="search_manager" icon="magnifying-glass" placeholder="{{ __('Nombre o email') }}" class="mt-1" wire:model="form.search_manager" autocomplete="off"/>
                            <flux:error name="form.search_manager" />
                            <flux:button type="submit" class="mt-3">{{ __('buscar') }}</flux:button>
                        </form>

                    @if(isset($form->potential_managers) && $form->potential_managers && $form->potential_managers->isNotEmpty())
                            <div
                                x-data="{
                                    selected: @entangle('form.manager'),
                                    animation: false,
                                    toggle(id) {
                                        console.log(this.selected, id);
                                        if (this.selected === id) {
                                            this.selected = null;
                                        } else {
                                            this.selected = id;
                                        }
                                    }
                                }"
                                x-init="$nextTick(() => animation = true)"
                                x-show="animation"
                                x-transition
                                >
                                <flux:checkbox.group class="mt-5">
                                    @foreach ($form->potential_managers as $manager)
                                        <flux:checkbox
                                            value="{{ $manager->id }}"
                                            label="{{ $manager->name }}"
                                            x-bind:checked="selected === {{ $manager->id }}"
                                            description="{{ $manager->email }} - {{ $manager->userRoles->pluck('name')->join(', ') }}"
                                            @click="toggle({{ $manager->id }})"
                                        />
                                    @endforeach
                                </flux:checkbox.group>
                            </div>
                        @endif
                        <div class="mt-5 flex justify-end items-center gap-2">
                            <flux:modal.close>
                                <flux:button>{{ __('Cancelar') }}</flux:button>
                            </flux:modal.close>
                            <flux:modal.close>
                                <flux:button variant="primary" wire:click="$set('form.save_manager', true)">{{ __('Guardar') }}</flux:button>
                            </flux:modal.close>
                        </div>
                    </div>
                    <div class="my-5">
                        <flux:separator text="Or" />
                    </div>
                    <a href="{{ route('employee.index') }}" wire:navigate class="block w-full p-5  border border-neutral-300 dark:border-neutral-700 rounded-lg text-center">
                        <flux:text>{{ __('Actualizar un empleado con rol de gerente') }}</flux:text>
                    </a>
                </div>
            </div>
        </flux:modal>
    </flux:modal>
</div>
