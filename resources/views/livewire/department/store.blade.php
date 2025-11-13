<div>
    <form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Nombre') }}</flux:label>
            <flux:input name="name" wire:model="name" icon="users" placeholder="{{ __('Recursos Humanos') }}"/>
            <flux:error name="name" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Email') }}</flux:label>
            <flux:input name="email" wire:model="email" icon="envelope" placeholder="{{ __('hello@neura.com') }}"/>
            <flux:error name="email" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Teléfono') }}</flux:label>
            <flux:input name="phone" wire:model="phone" mask="(999) 999-9999" icon="phone" placeholder="{{ __('(555) 555-5555') }}"/>
            <flux:error name="phone" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Descripción') }}</flux:label>
            <flux:textarea name="description" resize="none" wire:model="description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Departamento de recursos humanos') }}"/>
            <flux:error name="description"/>
        </flux:field>
        <flux:field>
            <flux:modal.trigger name="manage-manager">
                <flux:button class="py-6">{{ __('Administrador del departamento') }}</flux:button>
            </flux:modal.trigger>
        </flux:field>
        <flux:field>
            <flux:switch label="Es departamento de RH" wire:model="hr_department" align="left" name="hr_department"/>
            <flux:error name="hr_department" />
        </flux:field>
        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>
    <flux:modal name="manage-manager" class="w-[90%] md:w-xl">
        <div>
            <flux:heading size="lg">{{ __('Actualizar administrador') }}</flux:heading>
            <div class="flex items-start gap-2 mt-2">
                <flux:icon.shield-exclamation class="text-primary" />
                <flux:text class="text-primary">{{ __('Este departamento aún no tiene un administrador asignado.') }}</flux:text>
            </div>
            <div class="mt-5 space-y-3">
                <div>
                    <form wire:submit.prevent='searchManager'>
                        <flux:label>{{ __('Buscar y asignar administrador') }}</flux:label>
                        <flux:input name="search_manager" icon="magnifying-glass" placeholder="{{ __('Nombre o email') }}" class="mt-1" wire:model="search_manager" autocomplete="off"/>
                        <flux:error name="search_manager" />
                        <flux:button type="submit" class="mt-3">{{ __('buscar') }}</flux:button>
                    </form>

                    @if($potential_managers && $potential_managers->isNotEmpty())
                        <flux:radio.group class="mt-5" wire:model="manager">
                            @foreach ($potential_managers as $manager)
                                <flux:radio
                                    value="{{ $manager->id }}"
                                    label="{{ $manager->name }}"
                                    description="{{ $manager->email }} - {{ $manager->userRoles->pluck('name')->join(', ') }}"
                                />
                            @endforeach
                        </flux:radio.group>
                    @endif
                    <div class="mt-5 flex justify-end items-center gap-2">
                        <flux:modal.close>
                            <flux:button>{{ __('Cancelar') }}</flux:button>
                        </flux:modal.close>
                        <flux:modal.close>
                            <flux:button variant="primary" wire:click="$set('save_manager', true)">{{ __('Guardar') }}</flux:button>
                        </flux:modal.close>
                    </div>
                </div>
                <div class="my-5">
                    <flux:separator text="or" />
                </div>
                <a href="#" class="block w-full p-5 shadow-xl border border-neutral-300 dark:border-neutral-700 rounded-lg text-center">
                    <flux:text>{{ __('Actualizar un empleado con rol de administrador') }}</flux:text>
                </a>
            </div>
        </div>
    </flux:modal>
</div>
