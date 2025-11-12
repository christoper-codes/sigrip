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
            <flux:button class="py-6" variant="primary">{{ __('Administrador (agregar / actualizar)') }}</flux:button>
        </flux:modal.trigger>
     </flux:field>
    <flux:modal name="manage-manager" class="md:w-96">
        <div>
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
        </div>
    </flux:modal>
    <flux:field>
        <flux:switch label="Es departamento de RH" wire:model="hr_department" align="left" name="hr_department"/>
        <flux:error name="hr_department" />
    </flux:field>
    <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
</form>
