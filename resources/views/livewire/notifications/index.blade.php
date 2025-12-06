<div>
    <div class="w-full max-w-2xl flex flex-col gap-10">
        @if($notifications)
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
