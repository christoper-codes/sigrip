<div>
    <div>
        <flux:text>
            {{ __('Notificaciones no leídas') }}
        </flux:text>
        <div class="grid grid-cols-1 gap-5">
            <flux:callout icon="shield-check" color="blue" inline>
                <flux:callout.heading>API access is restricted</flux:callout.heading>

                <flux:callout.text>Get access to all of our premium features and benefits.</flux:callout.text>

                <x-slot name="actions" class="@md:h-full m-0!">
                    <flux:button>Upgrade to Pro -></flux:button>
                </x-slot>
            </flux:callout>
        </div>
    </div>

</div>
