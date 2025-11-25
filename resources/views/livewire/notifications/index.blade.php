<div>
    <div class="w-full max-w-2xl flex flex-col gap-10">
        <div>
            <flux:heading>
                {{ __('Notificaciones no leídas') }}
            </flux:heading>
            <div class="grid grid-cols-1 gap-3 mt-5">
                <flux:callout icon="envelope" color="blue" inline>
                    <flux:callout.heading>API access is restricted</flux:callout.heading>
                    <flux:callout.text class="truncate! w-32!">Get access to all of our premium features and benefits.</flux:callout.text>
                    <x-slot name="actions" class="@md:h-full m-0!">
                        <flux:button icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                    </x-slot>
                </flux:callout>
            </div>
        </div>
        <div>
            <flux:heading>
                {{ __('Notificaciones leídas') }}
            </flux:heading>
            <div class="grid grid-cols-1 gap-3 mt-5">
                <flux:callout icon="envelope-open" color="zinc" inline>
                    <flux:callout.heading>API access is restricted</flux:callout.heading>
                    <flux:callout.text class="truncate! w-32!">Get access to all of our premium features and benefits.</flux:callout.text>
                    <x-slot name="actions" class="@md:h-full m-0!">
                        <flux:button icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                    </x-slot>
                </flux:callout>
            </div>
        </div>
    </div>
</div>
