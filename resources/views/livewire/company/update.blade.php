<form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
    <flux:field>
        <flux:label>{{ __('Nombre') }}</flux:label>
        <flux:input name="name" wire:model="name" icon="briefcase" placeholder="{{ __('Neura Inc.') }}"/>
        <flux:error name="name" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Dirección') }}</flux:label>
        <flux:input name="address_line" wire:model="address_line" icon="map" placeholder="{{ __('Calle 123') }}"/>
        <flux:error name="address_line" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Código Postal') }}</flux:label>
        <flux:input name="zip_code" wire:model="zip_code" icon="hashtag" placeholder="{{ __('1234') }}"/>
        <flux:error name="zip_code" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Teléfono') }}</flux:label>
        <flux:input name="phone" wire:model="phone" icon="phone" placeholder="{{ __('+52 123 000 000') }}"/>
        <flux:error name="phone" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Email') }}</flux:label>
        <flux:input name="email" wire:model="email" icon="envelope" placeholder="{{ __('Correo@ejemplo.com') }}"/>
        <flux:error name="email" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Descripción') }}</flux:label>
        <flux:textarea name="description" resize="none" wire:model="description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Compañía de software') }}"/>
        <flux:error name="description"/>
    </flux:field>
    <flux:button type="submit" variant="primary">{{ __('Actualizar') }}</flux:button>
</form>
