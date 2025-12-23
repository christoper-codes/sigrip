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
                    <div class="hidden text-red-500 text-yellow-500 border-l-red-500 border-l-yellow-500 dark:border-l-red-500 dark:border-l-yellow-500 bg-red-500/10 bg-yellow-500/10"></div>
                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-7 mt-5">
                        @foreach ($unread_alerts as $alert)
                            <div class="border dark:border-dark-variant border-l-[5px] border-l-{{ $alert['risk_level'] }}-500 dark:border-l-{{ $alert['risk_level'] }}-500 rounded-2xl p-7 flex flex-col gap-10 shadow-xl">
                                <div class="flex flex-col-reverse lg:flex-row m items-start justify-between gap-2">
                                    <div>
                                        <flux:heading>{{ ucfirst(strtolower($alert['name'])) }}</flux:heading>
                                        <flux:text class="mt-2">{{ ucfirst(strtolower($alert['subject'])) }}</flux:text>
                                    </div>
                                    <div class="flex items-center justify-center border border-{{ $alert['risk_level'] }}-500 bg-{{ $alert['risk_level'] }}-500/10 p-2.5 rounded-full">
                                        <flux:icon.exclamation-triangle class="text-{{ $alert['risk_level'] }}-500" />
                                    </div>
                                </div>

                                <section class="flex flex-col gap-3">
                                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.exclamation-circle variant="mini"/>
                                            <flux:text class="text-xs!">
                                                <span>{{ __('Riesgo ') }}</span>
                                                <span class="font-bold text-{{ $alert['risk_level'] }}-500">{{ $alert['risk_level'] == 'red' ? 'Alto' : 'Medio' }}</span>
                                            </flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.calendar variant="mini"/>
                                            <flux:text class="text-xs!">{{ dateFormat($alert['created_at']) }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.arrow-trending-up variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Promedio ') }} {{ $alert['risk_score'] ?? '' }}</flux:text>
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.key variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Cuestionario ID: ') }} {{ $alert['questionnaire_response_uuid'] }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.clipboard-document-list variant="mini"/>
                                            <flux:text class="text-xs!">{{ ucfirst(str_replace('-', ' ', explode('-', $alert['application']['slug'], -1) ? implode('-', explode('-', $alert['application']['slug'], -1)) : $alert['application']['slug'])) }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.building-office variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Departamento: ') }} {{ $alert['department']['name'] }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.user variant="mini"/>
                                            <flux:text class="text-xs!">{{ $alert['user'] ? $alert['user']['name'] : 'Empleado anonimo' }}</flux:text>
                                        </div>
                                    </div>
                                </section>
                                <div class="flex flex-wrap gap-3 items-center">
                                    @if ($alert['ai_response']['questions_alert'])
                                        <flux:button class="basis-full sm:basis-auto md:basis-auto" variant="primary" wire:click="readResponse({{ $alert['id'] }}, 'responses')">
                                            {{ __('Respuestas') }}
                                        </flux:button>
                                    @endif
                                    <flux:button class="basis-full sm:basis-auto md:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'department')">
                                        {{ $alert['user'] ? __('Analisis Ai (dpto)') :  __('Analisis Ai')}}
                                    </flux:button>
                                    @if($alert['user'])
                                        <flux:button class="basis-full sm:basis-auto md:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'employee')">
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
               <div>
                    <flux:heading>
                        {{ __('Alertas leídas') }}
                    </flux:heading>
                    <div class="hidden text-red-500 text-yellow-500 border-l-red-500 border-l-yellow-500 dark:border-l-red-500 dark:border-l-yellow-500 bg-red-500/10 bg-yellow-500/10"></div>
                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-7 mt-5">
                        @foreach ($read_alerts as $alert)
                            <div class="border dark:border-dark-variant border-l-[5px] border-l-{{ $alert['risk_level'] }}-500 dark:border-l-{{ $alert['risk_level'] }}-500 rounded-2xl p-7 flex flex-col gap-10 shadow-xl">
                                <div class="flex flex-col-reverse lg:flex-row m items-start justify-between gap-2">
                                    <div>
                                        <flux:heading>{{ ucfirst(strtolower($alert['name'])) }}</flux:heading>
                                        <flux:text class="mt-2">{{ ucfirst(strtolower($alert['subject'])) }}</flux:text>
                                    </div>
                                    <div class="flex items-center justify-center border border-{{ $alert['risk_level'] }}-500 bg-{{ $alert['risk_level'] }}-500/10 p-2.5 rounded-full">
                                        <flux:icon.exclamation-triangle class="text-{{ $alert['risk_level'] }}-500" />
                                    </div>
                                </div>

                                <section class="flex flex-col gap-3">
                                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.exclamation-circle variant="mini"/>
                                            <flux:text class="text-xs!">
                                                <span>{{ __('Riesgo ') }}</span>
                                                <span class="font-bold text-{{ $alert['risk_level'] }}-500">{{ $alert['risk_level'] == 'red' ? 'Alto' : 'Medio' }}</span>
                                            </flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.calendar variant="mini"/>
                                            <flux:text class="text-xs!">{{ dateFormat($alert['created_at']) }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.arrow-trending-up variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Promedio ') }} {{ $alert['risk_score'] ?? '' }}</flux:text>
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.key variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Cuestionario ID: ') }} {{ $alert['questionnaire_response_uuid'] }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.clipboard-document-list variant="mini"/>
                                            <flux:text class="text-xs!">{{ ucfirst(str_replace('-', ' ', explode('-', $alert['application']['slug'], -1) ? implode('-', explode('-', $alert['application']['slug'], -1)) : $alert['application']['slug'])) }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.building-office variant="mini"/>
                                            <flux:text class="text-xs!">{{ __('Departamento: ') }} {{ $alert['department']['name'] }}</flux:text>
                                        </div>
                                        <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full border dark:border-neutral-800 max-w-max">
                                            <flux:icon.user variant="mini"/>
                                            <flux:text class="text-xs!">{{ $alert['user'] ? $alert['user']['name'] : 'Empleado anonimo' }}</flux:text>
                                        </div>
                                    </div>
                                </section>
                                <div class="flex flex-wrap gap-3 items-center">
                                    @if ($alert['ai_response']['questions_alert'])
                                        <flux:button class="basis-full sm:basis-auto md:basis-auto" variant="primary" wire:click="readResponse({{ $alert['id'] }}, 'responses')">
                                            {{ __('Respuestas') }}
                                        </flux:button>
                                    @endif
                                    <flux:button class="basis-full sm:basis-auto md:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'department')">
                                        {{ $alert['user'] ? __('Analisis Ai (dpto)') :  __('Analisis Ai')}}
                                    </flux:button>
                                    @if($alert['user'])
                                        <flux:button class="basis-full sm:basis-auto md:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'employee')">
                                            {{ __('Analisis Ai (empleado)') }}
                                        </flux:button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No hay alertas') }}" />
        @endif
    </div>

    <flux:modal name="read-responses-alert" class="w-[90%] md:w-full">
        @if($questionnaire_response)
            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="space-y-2">
                        <flux:heading size="lg">{{ __('Respuestas criticas') }}</flux:heading>
                        <flux:text>{{ __('Aplicación: ') }} {{ ucfirst(str_replace('-', ' ', explode('-', $questionnaire_response['application']['slug'], -1) ? implode('-', explode('-', $questionnaire_response['application']['slug'], -1)) : $questionnaire_response['application']['slug']))}}</flux:text>
                        <flux:text>{{ __('Cuestionario ID: ') }} {{ $questionnaire_response['questionnaire_response_uuid'] }}</flux:text>
                    </div>
                    <div class="mt-5 bg-light-variant dark:bg-dark-variant p-5 rounded-xl border border-neutral-300 dark:border-neutral-700">
                        <div class="space-y-4">
                            @foreach ($questionnaire_response['ai_response']['questions_alert'] as $answer)
                                <flux:heading>{{ $answer['question'] }}</flux:heading>
                                <flux:text class="mt-2">{{ ucfirst(strtolower($answer['label'])) }}</flux:text>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        @endif
    </flux:modal>
    <flux:modal name="read-department-alert" class="w-[90%] md:w-full">
        @if($questionnaire_response)
            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="space-y-2">
                        <flux:heading size="lg">{{ __('Recomendaciones para el departamento') }}</flux:heading>
                        <flux:text>{{ __('Aplicación: ') }} {{ ucfirst(str_replace('-', ' ', explode('-', $questionnaire_response['application']['slug'], -1) ? implode('-', explode('-', $questionnaire_response['application']['slug'], -1)) : $questionnaire_response['application']['slug']))}}</flux:text>
                        <flux:text>{{ __('Cuestionario ID: ') }} {{ $questionnaire_response['questionnaire_response_uuid'] }}</flux:text>
                    </div>
                    <div class="mt-5 bg-light-variant dark:bg-dark-variant p-5 rounded-xl border border-neutral-300 dark:border-neutral-700">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <flux:icon.sparkles variant="mini" class="text-primary!"/>
                                <flux:heading>{{ __('Análisis AI para el departamento') }}</flux:heading>
                            </div>
                            <flux:text class="mt-2 leading-relaxed">{{ $questionnaire_response['ai_response']['recommendation_for_department'] }}</flux:text>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        @endif
    </flux:modal>
    <flux:modal name="read-employee-alert" class="w-[90%] md:w-full">
        @if($questionnaire_response && ! empty($questionnaire_response['ai_response']['recommendation_for_user']))
            <div class="space-y-6">
                <div class="space-y-2">
                    <div class="space-y-2">
                        <flux:heading size="lg">{{ __('Recomendaciones para el empleado') }}</flux:heading>
                        <flux:text>{{ __('Aplicación: ') }} {{ ucfirst(str_replace('-', ' ', explode('-', $questionnaire_response['application']['slug'], -1) ? implode('-', explode('-', $questionnaire_response['application']['slug'], -1)) : $questionnaire_response['application']['slug']))}}</flux:text>
                        <flux:text>{{ __('Cuestionario ID: ') }} {{ $questionnaire_response['questionnaire_response_uuid'] }}</flux:text>
                    </div>
                    <div class="mt-5 bg-light-variant dark:bg-dark-variant p-5 rounded-xl border border-neutral-300 dark:border-neutral-700">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <flux:icon.sparkles variant="mini" class="text-primary!"/>
                                <flux:heading>{{ __('Análisis AI para el empleado') }}</flux:heading>
                            </div>
                            <flux:text class="mt-2 leading-relaxed">{{ $questionnaire_response['ai_response']['recommendation_for_user'] }}</flux:text>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        @endif
    </flux:modal>
</div>
