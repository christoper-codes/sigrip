<div>
    <div class="w-full flex flex-col gap-10">
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
                    <div class="hidden border-red-300 dark:border-red-700 border-yellow-300 dark:border-yellow-700"></div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-7 mt-5">
                        @foreach ($unread_alerts as $alert)
                            <div class="border border-{{ $alert['risk_level'] }}-300 dark:border-{{ $alert['risk_level'] }}-700 rounded-2xl p-5 flex flex-col gap-3">
                                <div>
                                    <flux:heading>{{ $alert['name'] }}</flux:heading>
                                    <flux:text class="mt-2">{{ $alert['subject'] }}</flux:text>
                                    <flux:text class="mt-2">{{ $alert['created_at'] }}</flux:text>
                                </div>
                                <section class="mt-7 bg-light-variant dark:bg-dark-variant rounded-xl p-5">
                                    <div class="flex items-center gap-2">
                                       <flux:text>{{ __('Nivel de riesgo: ') }}</flux:text>
                                        <div class="flex items-center gap-2">
                                            <span class="size-4 block rounded bg-{{ $alert['risk_level'] }}-500"></span>
                                            <flux:text>{{ ucfirst($alert['risk_level']) }}</flux:text>
                                        </div>
                                    </div>
                                    <flux:text class="mt-2">{{ __('Puntaje promedio: ') }} {{ $alert['risk_score'] ?? '' }}</flux:text>
                                </section>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($read_alerts)
               <div>hey</div>
            @endif
        @else
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No hay alertas') }}" />
        @endif
    </div>
</div>
