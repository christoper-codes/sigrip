<form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-10 lg:py-10 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
    <flux:field>
        <flux:label>{{ __('Nombre') }}</flux:label>
        <flux:input name="name" wire:model="name"/>
        <flux:error name="name" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Descripción') }}</flux:label>
        <flux:textarea name="description" resize="none" wire:model="description"/>
        <flux:error name="description"/>
    </flux:field>
    <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
</form>
