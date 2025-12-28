<div>
    <div class="w-full max-w-2xl flex flex-col gap-10">
        @if($notifications)
            <form wire:submit.prevent='loadNotifications'>
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
            @if($unread_notifications)
                <div>
                    <flux:heading>
                        {{ __('Notificaciones nuevas') }}
                    </flux:heading>
                    <div class="grid grid-cols-1 gap-3 mt-5">
                        @foreach ($unread_notifications as $notification)
                            <flux:callout icon="envelope" color="blue" inline>
                                <flux:callout.heading>{{ $notification['metadata']['title'] }}</flux:callout.heading>
                                <flux:callout.text class="truncate! w-32!">{{ $notification['created_at'] }}</flux:callout.text>
                                <x-slot name="actions" class="@md:h-full m-0!">
                                    <flux:button wire:click="markAsRead({{ $notification['id'] }})" icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                                </x-slot>
                            </flux:callout>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($read_notifications)
                <div>
                    <flux:heading>
                        {{ __('Notificaciones leídas') }}
                    </flux:heading>
                    <div class="grid grid-cols-1 gap-3 mt-5">
                        @foreach ($read_notifications as $notification)
                            <flux:callout icon="envelope-open" color="zinc" inline>
                                <flux:callout.heading>{{ $notification['metadata']['title'] }}</flux:callout.heading>
                                <flux:callout.text class="truncate! w-32!">{{ $notification['created_at'] }}</flux:callout.text>
                                <x-slot name="actions" class="@md:h-full m-0!">
                                    <flux:button wire:click="markAsRead({{ $notification['id'] }})" icon="cursor-arrow-rays" variant="filled" class="cursor-pointer!">{{ __('Leer') }}</flux:button>
                                </x-slot>
                            </flux:callout>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No hay notificaciones') }}" />
        @endif
    </div>
    <flux:modal name="read-notification" class="w-[90%] md:w-full max-w-md">
        <div class="space-y-6">
            <div class="space-y-2">
                <div>
                    <flux:heading size="lg">{{ $title_notification }}</flux:heading>
                    <flux:text>{{ $created_at_notification }}</flux:text>
                    @if($alert_uuid)
                        <div class="bg-light dark:bg-neutral-800 inline-flex items-center gap-2 py-2 px-4 rounded-full border border-neutral-300 dark:border-neutral-700 max-w-max">
                            <flux:icon.key variant="mini"/>
                            <flux:text class="text-xs!">{{ __('Cuestionario ID: ') }} {{ $alert_uuid }}</flux:text>
                        </div>
                    @endif
                </div>
                <flux:text class="mt-4">
                    {{ $message_notification }}
                </flux:text>
                @if($url_notification)
                    <flux:link href="{{ $url_notification }}" class="underline! text-primary! text-base!">{{ __('Visitar') }}</flux:link>
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
