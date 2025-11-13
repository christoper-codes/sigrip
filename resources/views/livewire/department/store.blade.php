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
                    <form wire:submit.prevent='searchAdministrator'>
                        <flux:label>{{ __('Buscar y asignar administrador') }}</flux:label>
                        <flux:input icon="magnifying-glass" placeholder="{{ __('Nombre o email') }}" class="mt-1" wire:model="administrator" autocomplete="off"/>
                        <flux:button type="submit" variant="primary" class="mt-3">{{ __('buscar') }}</flux:button>
                    </form>

                    <flux:radio.group>
                        @foreach ($potential_administrators as $administrator)
                            <flux:radio
                                name="role"
                                value="{{ $administrator['id'] }}"
                                label="{{ $administrator['name'] }}"
                                description="{{ $administrator['email'] }} - administrator"
                            />
                        @endforeach
                    </flux:radio.group>
                </div>
                <div>
                    <flux:separator text="or" />
                </div>
                <a href="#" class="block w-full p-5 shadow-xl border border-neutral-300 dark:border-neutral-700 rounded-lg text-center">
                    <flux:text>{{ __('Crear o actualizar un empleado con rol de administrador') }}</flux:text>
                </a>
            </div>
        </div>
    </flux:modal>
</div>
