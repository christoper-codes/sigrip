<div>
    <div class="w-full max-w-2xl flex flex-col gap-10">
        @if($alerts)
            <form wire:submit.prevent='loadAlerts'>
                <div class="flex items-center gap-2">
                    <flux:field class="max-w-32 w-full">
                        <flux:label>{{ __('Total de registros') }}</flux:label>
                        <flux:select name="items_per_page" wire:model.live="items_per_page">
                            @foreach ($search_options as $option)
                                <flux:select.option value="{{ $option['value'] }}">{{ $option['label'] }}</flux:select.option>)
                            @endforeach
                        </flux:select>
                        <flux:error name="items_per_page" class="!mt-0"/>
                    </flux:field>
                    <flux:button type="submit" variant="primary" class="mt-6">{{ __('Buscar') }}</flux:button>
                </div>
            </form>
            @if($unread_alerts)
                <div>
                    <flux:heading>
                        {{ __('Notificaciones nuevas') }}
                    </flux:heading>
                    <div class="grid grid-cols-1 gap-3 mt-5">
                        @foreach ($unread_alerts as $alert)
                            <flux:callout icon="envelope" color="blue" inline>
                                <flux:callout.heading>{{ $alert['metadata']['title'] }}</flux:callout.heading>
                                <flux:callout.text class="truncate! w-32!">{{ $alert['created_at'] }}</flux:callout.text>
                                <x-slot name="actions" class="@md:h-full m-0!">
                                    <flux:button wire:click="markAsRead({{ $alert['id'] }})" icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                                </x-slot>
                            </flux:callout>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($read_alerts)
                <div>
                    <flux:heading>
                        {{ __('Notificaciones leídas') }}
                    </flux:heading>
                    <div class="grid grid-cols-1 gap-3 mt-5">
                        @foreach ($read_alerts as $alert)
                            <flux:callout icon="envelope-open" color="zinc" inline>
                                <flux:callout.heading>{{ $alert['metadata']['title'] }}</flux:callout.heading>
                                <flux:callout.text class="truncate! w-32!">{{ $alert['created_at'] }}</flux:callout.text>
                                <x-slot name="actions" class="@md:h-full m-0!">
                                    <flux:button wire:click="markAsRead({{ $alert['id'] }})" icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                                </x-slot>
                            </flux:callout>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No hay alertas') }}" />
        @endif
    </div>
    <flux:modal name="read-alert" class="w-[90%] md:w-full max-w-md">
        <div class="space-y-6">
            <div class="space-y-2">
                <div>
                    <flux:heading size="lg">{{ $title_alert }}</flux:heading>
                    <flux:text>{{ $created_at_alert }}</flux:text>
                </div>
                <flux:text class="mt-4">
                    {{ $message_alert }}
                </flux:text>
                @if($url_alert)
                    <flux:link href="{{ $url_alert }}" class="underline! text-primary! text-base!">{{ __('Visitar') }}</flux:link>
                @endif
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
