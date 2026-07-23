<div>
    <div class="w-full flex flex-col gap-8">
        @if($alerts)
            <div class="flex flex-col lg:flex-row lg:items-center gap-3 bg-card border border-border rounded-2xl p-3">
                <form wire:submit.prevent='searchAlert' class="flex-1">
                    <div class="flex items-center gap-2">
                        <flux:input class="flex-1" icon="magnifying-glass" name="alert_uuid" wire:model="alert_uuid" placeholder="{{ __('Buscar por folio de alerta, ej. 00972204') }}"/>
                        <flux:button type="submit" variant="primary">{{ __('Buscar') }}</flux:button>
                        @if($alert_uuid)
                            <flux:button type="button" variant="ghost" wire:click="resetSearch">{{ __('Limpiar') }}</flux:button>
                        @endif
                    </div>
                    <flux:error name="alert_uuid" class="mt-1!"/>
                </form>

                <div class="w-full lg:w-px h-px lg:h-8 bg-border"></div>

                <form wire:submit.prevent='loadAlerts'>
                    <div class="flex items-center gap-2">
                        <flux:icon.adjustments-horizontal variant="mini" class="opacity-50 shrink-0"/>
                        <flux:select class="w-full lg:w-40" name="items_per_page" wire:model.live="items_per_page">
                            @foreach ($search_options as $option)
                                <flux:select.option value="{{ $option['value'] }}">{{ $option['label'] }}</flux:select.option>)
                            @endforeach
                        </flux:select>
                    </div>
                </form>
            </div>

            {{-- Tailwind JIT safelist: risk_level ('red'/'yellow') drives the dynamic classes used below --}}
            <div class="hidden text-red-500 text-yellow-500 bg-red-500/10 bg-yellow-500/10 bg-red-500/15 bg-yellow-500/15 border-red-500/30 border-yellow-500/30"></div>

            <div
                x-data="{ animation: false }"
                x-init="$nextTick(() => animation = true)"
                x-show="animation"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="grid grid-cols-1 gap-5"
            >
                @foreach ($alerts as $alert)
                    @php
                        $is_read = (bool) $alert['read_by_department'];
                        $fields = [
                            [
                                'icon' => 'exclamation-circle',
                                'label' => __('Riesgo'),
                                'value' => $alert['risk_level'] == 'red' ? __('Alto') : __('Medio'),
                                'accent' => true,
                            ],
                            ['icon' => 'calendar', 'label' => __('Fecha'), 'value' => dateFormat($alert['created_at'])],
                            ['icon' => 'arrow-trending-up', 'label' => __('Promedio'), 'value' => $alert['risk_score'] ?? '-'],
                            ['icon' => 'key', 'label' => __('Cuestionario ID'), 'value' => $alert['questionnaire_response_uuid']],
                            ['icon' => 'clipboard-document-list', 'label' => __('Aplicación'), 'value' => ucfirst(str_replace('-', ' ', explode('-', $alert['application']['slug'], -1) ? implode('-', explode('-', $alert['application']['slug'], -1)) : $alert['application']['slug']))],
                            ['icon' => 'building-office', 'label' => __('Departamento'), 'value' => $alert['department']['name']],
                            ['icon' => 'user', 'label' => __('Empleado'), 'value' => $alert['metadata']['employee_name'] ?? __('Anónimo')],
                        ];
                    @endphp
                    <div class="bg-card border border-border rounded-2xl overflow-hidden">
                        <div class="flex items-center justify-between gap-4 px-6 py-4 bg-{{ $alert['risk_level'] }}-500/10 border-b border-{{ $alert['risk_level'] }}-500/30">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="flex items-center justify-center size-10 rounded-full bg-{{ $alert['risk_level'] }}-500/15 shrink-0">
                                    <flux:icon.exclamation-triangle class="size-5 text-{{ $alert['risk_level'] }}-500"/>
                                </div>
                                <div class="min-w-0">
                                    <flux:heading size="lg" class="truncate!">{{ ucfirst(strtolower($alert['name'])) }}</flux:heading>
                                    <flux:text class="text-xs! opacity-60">{{ __('Folio') }} {{ $alert['uuid'] }}</flux:text>
                                </div>
                            </div>
                            <flux:badge class="shrink-0" :color="$is_read ? null : ($alert['risk_level'] == 'red' ? 'red' : 'yellow')">
                                {{ $is_read ? __('Leída') : __('Nueva') }}
                            </flux:badge>
                        </div>

                        <div class="px-6 py-5">
                            <flux:text>{{ ucfirst(strtolower($alert['subject'])) }}</flux:text>

                            <dl class="grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-5 mt-5">
                                @foreach ($fields as $field)
                                    <div>
                                        <dt class="flex items-center gap-1.5 text-[11px] font-medium uppercase tracking-wide opacity-50">
                                            <flux:icon :icon="$field['icon']" variant="micro"/>
                                            {{ $field['label'] }}
                                        </dt>
                                        <dd class="text-sm mt-1 {{ ($field['accent'] ?? false) ? 'font-bold text-'.$alert['risk_level'].'-500' : 'font-medium' }}">{{ $field['value'] }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>

                        <div class="flex flex-wrap gap-2 px-6 py-4 bg-light-variant dark:bg-dark-variant border-t border-border">
                            @if ($alert['ai_response']['questions_alert'])
                                <flux:button class="basis-full sm:basis-auto" variant="primary" wire:click="readResponse({{ $alert['id'] }}, 'responses')">
                                    {{ __('Respuestas') }}
                                </flux:button>
                            @endif
                            <flux:button class="basis-full sm:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'department')">
                                {{ __('Análisis Ai (dpto)') }}
                            </flux:button>
                            <flux:button class="basis-full sm:basis-auto border! border-primary! bg-primary/10!" variant="filled" icon="sparkles" wire:click="readResponse({{ $alert['id'] }}, 'employee')">
                                {{ __('Análisis Ai (empleado)') }}
                            </flux:button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-lg w-full">
                <flux:callout color="yellow" icon="information-circle" heading="{{ __('No hay alertas') }}" />
            </div>
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
                            <div
                                wire:key="ai-{{ $questionnaire_response['questionnaire_response_uuid'] }}"
                                x-data="typeWords(@js($questionnaire_response['ai_response']['recommendation_for_department']))"
                                x-init="
                                    start();
                                    window.addEventListener('read-department-alert', () => {
                                        start();
                                    });
                                "
                            >
                                <flux:text class="mt-2 leading-relaxed">
                                    <template x-for="(word, i) in visibleWords" :key="i">
                                        <span x-text="word" class="inline-block mr-1 animate-word"></span>
                                    </template>
                                    <span x-show="typing" class="inline-block animate-pulse">▍</span>
                                </flux:text>
                            </div>
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
                            <div
                                wire:key="ai-user-{{ $questionnaire_response['questionnaire_response_uuid'] }}"
                                x-data="typeWords(@js($questionnaire_response['ai_response']['recommendation_for_user']))"
                                x-init="
                                    start();
                                    window.addEventListener('read-employee-alert', () => {
                                        start();
                                    });
                                "
                            >
                                <flux:text class="mt-2 leading-relaxed">
                                    <template x-for="(word, i) in visibleWords" :key="i">
                                        <span x-text="word" class="inline-block mr-1 animate-word"></span>
                                    </template>
                                    <span x-show="typing" class="inline-block animate-pulse">▍</span>
                                </flux:text>
                            </div>
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
