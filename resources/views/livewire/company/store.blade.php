<form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
    <flux:field>
        <flux:label>{{ __('Nombre') }}</flux:label>
        <flux:input name="name" wire:model="name" icon="briefcase" placeholder="{{ __('Neura Inc.') }}"/>
        <flux:error name="name" />
    </flux:field>
    <flux:field>
        <flux:label>{{ __('Descripción') }}</flux:label>
        <flux:textarea name="description" resize="none" wire:model="description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Compañía de software') }}"/>
        <flux:error name="description"/>
    </flux:field>
    <flux:button
        type="submit"
        variant="primary"
        :loading="false"
        x-data="{ loading: false }"
        x-on:click="loading = true;"
        class="w-24!"
    >
        <span x-show="!loading">{{ __('Guardar') }}</span>
        <span x-show="loading"><flux:icon.loading class="!size-4"/></span>
    </flux:button>
</form>
