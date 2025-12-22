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
                        {{ __('Alertas nuevas') }}
                    </flux:heading>
                    <div class="hidden text-red-500 text-yellow-500 border-l-red-500 border-l-yellow-500 dark:border-l-red-500 dark:border-l-yellow-500"></div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-5">
                        @foreach ($unread_alerts as $alert)
                            <div class="border dark:border-dark-variant border-l-[5px] border-l-{{ $alert['risk_level'] }}-500 dark:border-l-{{ $alert['risk_level'] }}-500 rounded-2xl p-7 flex flex-col gap-10">
                                <div class="flex items-start gap-2">
                                    <flux:icon.exclamation-triangle class="text-{{ $alert['risk_level'] }}-500" />
                                     <div>
                                        <flux:heading>{{ ucfirst(strtolower($alert['name'])) }}</flux:heading>
                                        <flux:text class="mt-2">{{ ucfirst(strtolower($alert['subject'])) }}</flux:text>
                                    </div>
                                </div>

                                <section class="flex flex-col gap-3">
                                    <div class="flex items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800">
                                            <flux:icon.exclamation-circle variant="mini"/>
                                            <flux:text class="text-xs!">
                                                <span>{{ __('Riesgo ') }}</span>
                                                <span class="font-bold text-{{ $alert['risk_level'] }}-500">{{ $alert['risk_level'] == 'red' ? 'Alto' : 'Medio' }}</span>
                                            </flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800">
                                            <flux:icon.clipboard-document-list variant="mini"/>
                                            <flux:text class="text-xs!">{{ ucfirst(str_replace('-', ' ', explode('-', $alert['application']['slug'], -1) ? implode('-', explode('-', $alert['application']['slug'], -1)) : $alert['application']['slug'])) }}</flux:text>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800">
                                            <flux:icon.calendar variant="mini"/>
                                            <flux:text class="text-xs!"> {{ $alert['created_at'] }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800">
                                            <flux:icon.user variant="mini"/>
                                            <flux:text class="text-xs!">{{ $alert['user'] ? $alert['user']['name'] : 'Empleado anonimo' }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800">
                                            <flux:icon.calendar variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Promedio ') }} {{ $alert['risk_score'] ?? '' }}</flux:text>
                                        </div>
                                    </div>
                                </section>
                                <div class="flex items-center gap-3">
                                    <flux:button variant="primary" wire:click="readResponse({{ $alert }})">
                                        {{ __('Respuestas') }}
                                    </flux:button>
                                    <flux:button variant="filled" class="border! border-primary! bg-primary/10!">
                                        {{ $alert['user'] ? __('Analisis Ai (dpto)') :  __('Analisis Ai')}}
                                    </flux:button>
                                    @if($alert['user'])
                                        <flux:button variant="filled" class="border! border-primary! bg-primary/10!">
                                            {{ __('Analisis Ai (empleado)') }}
                                        </flux:button>
                                    @endif
                                </div>
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

    <flux:modal name="read-response-alert" class="w-[90%] md:w-full">
        <div class="space-y-6">
            <div class="space-y-2">
                <div>
                    <flux:heading size="lg">{{ __('Respuestas criticas') }}</flux:heading>
                    {{-- <flux:text>{{ __('Aplicación: ') }} {{ ucfirst(str_replace('-', ' ', explode('-', $questionnaire_response['application']['slug'], -1) ? implode('-', explode('-', $questionnaire_response['application']['slug'], -1)) : $questionnaire_response['application']['slug'])) }}</flux:text> --}}
                    <flux:text>{{ __('ID:sSD12df') }}</flux:text>
                </div>
                <flux:text class="mt-4">
                    {{ __('Meesage') }}
                </flux:text>
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
