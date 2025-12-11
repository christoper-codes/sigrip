<div>
    <form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Nombre') }}</flux:label>
            <flux:input name="name" wire:model="form.name" icon="users" placeholder="{{ __('Recursos Humanos') }}"/>
            <flux:error name="form.name" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Email') }}</flux:label>
            <flux:input name="email" wire:model="form.email" icon="envelope" placeholder="{{ __('hello@neura.com') }}"/>
            <flux:error name="form.email" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Teléfono') }}</flux:label>
            <flux:input name="phone" wire:model="form.phone" mask="(999) 999-9999" icon="phone" placeholder="{{ __('(555) 555-5555') }}"/>
            <flux:error name="form.phone" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Descripción') }}</flux:label>
            <flux:textarea name="description" resize="none" wire:model="form.description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Departamento de recursos humanos') }}"/>
            <flux:error name="form.description"/>
        </flux:field>
        <flux:field>
            <div class="flex items-start gap-2 mt-2">
                <flux:icon.chat-bubble-oval-left />
                <flux:text>{{ __('Esta sección es opcional') }}</flux:text>
            </div>
            <flux:modal.trigger name="manage-manager">
                <flux:button class="py-6">{{ __('Gerente del departamento') }}</flux:button>
            </flux:modal.trigger>
        </flux:field>
        <flux:field>
            <flux:switch label="Es departamento de RH" wire:model="form.hr_department" align="left" name="hr_department"/>
            <flux:error name="form.hr_department" />
        </flux:field>
        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>
    <flux:modal name="manage-manager" class="w-[90%] md:w-xl">
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
</div>
