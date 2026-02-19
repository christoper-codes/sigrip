<div>
    <flux:button id="ticket-btn" class="hidden!" variant="primary">{{ __('test') }}</flux:button>

    <form wire:submit.prevent='searchTickets' class="mb-10">
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model.live="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                        <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>)
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
            </flux:field>
            <flux:field class="max-w-32 w-full">
                <flux:label>{{ __('Total de registros') }}</flux:label>
                <flux:select class="!h-12" name="items_per_page" wire:model.live="items_per_page">
                    @foreach ($search_options as $option)
                        <flux:select.option value="{{ $option['value'] }}">{{ $option['label'] }}</flux:select.option>)
                    @endforeach
                </flux:select>
                <flux:error name="items_per_page" class="!mt-0"/>
            </flux:field>
        </div>

        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar tickets') }}</flux:button>
   </form>

    @if($tickets)
        <div x-data="{ animation: false }"
            x-init="$nextTick(() => animation = true)"
            x-show="animation"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="flex gap-4 overflow-x-auto h-[70vh] overflow-y-hidden">
            @foreach ($ticket_statuses as $status)
                <div class="min-w-[320px] flex flex-col gap-5 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-lg p-5 overflow-y-auto mb-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="hidden border-orange-500 border-blue-500 border-green-500 border-red-500"></span>
                            <span class="inline-block size-5 rounded-full border-[3px] border-{{ $status['color'] }}-500"></span>
                            <span class="font-bold text-lg">{{ $status['name'] }}</span>
                        </div>
                        <flux:text class="mt-2">{{ $status['description'] }}</flux:text>
                    </div>
                    <div class="flex-1 space-y-4">
                        @php
                            $tickets_by_status = collect($tickets)->where('support_ticket_status_id', $status['id']);
                        @endphp
                        @foreach ($tickets_by_status as $ticket)
                            <div wire:click="showTicketDetails({{ $ticket['id'] }})" class="bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 border-l-4 border-l-neutral-300 dark:border-l-neutral-700 p-3 rounded-xl cursor-pointer hover:scale-105 transition-all duration-500">
                                <div class="flex items-start gap-3 w-full">
                                    <div class="w-full">
                                        <flux:heading>{{ $ticket['title'] }}</flux:heading>
                                    </div>
                                    @if($ticket['is_priority'] && $ticket['support_ticket_status_id'] !== 3 && $ticket['support_ticket_status_id'] !== 4)
                                        <span class="relative flex size-3">
                                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-75"></span>
                                            <span class="relative inline-flex size-3 rounded-full bg-primary"></span>
                                        </span>
                                    @endif
                                    @if($ticket['support_ticket_status_id'] == 3)
                                        <span class="relative flex size-3">
                                            <span class="relative inline-flex size-3 rounded-full bg-green-500"></span>
                                        </span>
                                    @endif
                                    @if($ticket['support_ticket_status_id'] == 4)
                                        <span class="relative flex size-3">
                                            <span class="relative inline-flex size-3 rounded-full bg-neutral-300 dark:bg-neutral-600"></span>
                                        </span>
                                    @endif
                                </div>
                                <flux:text class="mt-2">{{ $ticket['created_at'] }}</flux:text>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($notify_message && ! $tickets)
        <div class="max-w-xl w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ $notify_message }}" />
        </div>
    @endif

    @if(! $notify_message && ! $tickets)
        <div class="max-w-md! w-full!">
            <flux:callout class="w-auto! h-auto!" color="yellow" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
        </div>
    @endif

    @if($detail_ticket)
        <flux:modal name="ticket-details-modal" flyout variant="floating" class="md:w-lg space-y-8" @close="ticketDetailModalClosed()">
            <div class="space-y-3">
                <flux:heading size="xl">{{ $detail_ticket['title'] }}</flux:heading>
                <flux:text>{{ $detail_ticket['description'] }}</flux:text>
                @if(isset($detail_ticket['metadata']['evidences']) && is_array($detail_ticket['metadata']['evidences']) && count($detail_ticket['metadata']['evidences']) > 0)
                    <div>
                        <ul class="list-disc ml-6 space-y-1">
                            @foreach($detail_ticket['metadata']['evidences'] as $evidence)
                                <li>
                                    <a href="{{ asset('storage/' . $evidence) }}" target="_blank" class="text-primary underline text-xs">
                                        {{ basename($evidence) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($detail_ticket['created_by_ai'])
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles variant="mini" class="text-primary"/>
                        <flux:text>{{ __('Generado por Ai') }}</flux:text>
                    </div>
                @endif
            </div>
            <div class="space-y-2">
                <div class="flex items-center gap-1">
                    <flux:icon.exclamation-triangle variant="mini" class="text-primary"/>
                    <flux:text class="text-primary">{{ $detail_ticket['incident_type']['name'] }}</flux:text>
                </div>
                <flux:text>{{ $detail_ticket['incident_type']['description'] }}</flux:text>
            </div>
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <flux:icon.finger-print variant="mini"/>
                    <flux:text>{{ __('Tipo de ticket ') }} {{ $detail_ticket['created_by_user'] ? __('autenticado') : __('anónimo') }}</flux:text>
                </div>
                @if($detail_ticket['metadata']['user']['contact_name'])
                    <div class="flex items-center gap-2">
                        <flux:icon.user variant="mini"/>
                        <flux:text>{{ __('Creado por ') }} {{ $detail_ticket['metadata']['user']['contact_name'] }}</flux:text>
                    </div>
                @endif
                 @if($detail_ticket['metadata']['user']['contact_email'])
                    <div class="flex items-center gap-2">
                        <flux:icon.envelope variant="mini"/>
                        <flux:text>{{ $detail_ticket['metadata']['user']['contact_email'] }}</flux:text>
                    </div>
                 @endif
                @if($detail_ticket['created_by_user'])
                    <div class="flex items-center gap-2">
                        <flux:icon.user variant="mini"/>
                        <flux:text>{{ __('Creado por ') }} {{ $detail_ticket['created_by_user']['name'] }}</flux:text>
                    </div>
                @endif
                @if(isset($detail_ticket['alert_uuid']))
                    <div class="flex items-center gap-2">
                        <flux:icon.key variant="mini"/>
                        <flux:text class="text-xs!">{{ __('Alerta ID: ') }} {{ $detail_ticket['alert_uuid'] }}</flux:text>
                    </div>
                @endif
                <div class="flex items-center gap-2">
                    <flux:icon.calendar variant="mini"/>
                    <flux:text>{{ dateFormat($detail_ticket['created_at']) }}</flux:text>
                </div>
            </div>

            <flux:button icon="sparkles" class="border! border-primary! bg-primary/10! flex! items-center! gap-1! h-full! w-full! py-2!"
                wire:click="analyzeTicketAi({{ $detail_ticket['id'] }})">
                {{ __('Analisis Ai') }}
            </flux:button>
            @if ($detail_ticket['ticket_responses'] && count($detail_ticket['ticket_responses']) > 0)
                <div class="space-y-2">
                    <flux:heading size="lg" class="mb-3">{{ __('Respuestas para la incidencia') }}</flux:heading>
                    @foreach ($detail_ticket['ticket_responses'] as $index => $response)
                        <div x-data="{ ticketResponse: -1 }" class="max-w-4xl mx-auto space-y-4 z-20 relative">
                            <div class="bg-light-variant dark:bg-neutral-700 border border-neutral-300 dark:border-neutral-700 rounded-2xl overflow-hidden">
                                <button type="button" @click="ticketResponse = ticketResponse === {{ $index }} ? -1 : {{ $index }}" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                                    <flux:text>{{ __('Respuesta') . ' ' . ($index + 1) }}</flux:text>
                                    <flux:icon.plus x-show="ticketResponse !== {{ $index }}" class="size-5 text-neutral-600 dark:text-neutral-400" />
                                    <flux:icon.minus x-show="ticketResponse === {{ $index }}" class="size-5 text-primary" />
                                </button>
                                <div x-show="ticketResponse === {{ $index }}" class="px-6 pb-5 space-y-4" x-transition>
                                    <div class="space-y-4">
                                        @if (isset($response['metadata']['text_response']) && $response['metadata']['text_response'])
                                            <div class="flex items-start gap-2">
                                                <flux:icon.chat-bubble-oval-left-ellipsis variant="mini"/>
                                                <flux:text>{{ $response['metadata']['text_response'] }}</flux:text>
                                            </div>
                                        @endif
                                        @if(isset($response['metadata']['files_response']) && is_array($response['metadata']['files_response']) && count($response['metadata']['files_response']) > 0)
                                            <div>
                                                <ul class="list-disc ml-6 space-y-1">
                                                    @foreach($response['metadata']['files_response'] as $evidence)
                                                        <li>
                                                            <a href="{{ asset('storage/' . $evidence) }}" target="_blank" class="text-primary underline text-xs">
                                                                {{ basename($evidence) }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="flex items-start gap-2">
                                            <flux:icon.calendar variant="mini"/>
                                            <flux:text>{{ dateFormat($response['created_at']) }}</flux:text>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <form wire:submit.prevent="submit" class="space-y-4">
                <flux:field>
                    <flux:switch label="Es prioritario" wire:model="is_priority" align="left" name="is_priority"/>
                    <flux:error name="is_priority" />
                </flux:field>
                <flux:field>
                    <flux:radio.group wire:model="ticket_status" variant="segmented" size="sm">
                        @foreach($ticket_statuses as $ticket_status)
                            <flux:radio value="{{ $ticket_status['id'] }}" label="{{ $ticket_status['name'] }}" />
                        @endforeach
                    </flux:radio.group>
                </flux:field>
                <div x-data="{ openTicketResponse: 1 }" class="max-w-4xl mx-auto space-y-4 z-20 relative mt-5">
                    <div class="bg-light-variant dark:bg-neutral-700 border border-neutral-300 dark:border-neutral-700 rounded-2xl overflow-hidden">
                        <button type="button" @click="openTicketResponse = openTicketResponse === 0 ? -1 : 0" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                            <flux:text>{{ __('Agregar respuesta') }}</flux:text>
                            <flux:icon.plus x-show="openTicketResponse !== 0" class="size-5 text-neutral-600 dark:text-neutral-400" />
                            <flux:icon.minus x-show="openTicketResponse === 0" class="size-5 text-primary" />
                        </button>
                        <div x-show="openTicketResponse === 0" class="px-6 pb-5 space-y-4" x-transition>
                            <flux:field>
                                <flux:label>{{ __('Respuesta') }}</flux:label>
                                <flux:textarea name="ticket_text_response" resize="none" wire:model="ticket_text_response" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Escribe la respuesta para el ticket') }}"/>
                                <flux:error name="ticket_text_response"/>
                            </flux:field>
                            <flux:field>
                                <flux:label>{{ __('Subir evidencias (archivos, imágenes, documentos)') }}</flux:label>
                                <flux:input type="file" name="ticket_files_response" wire:model="ticket_files_response" multiple accept=".xlsx, .csv, .pdf, .jpg, .png" />

                                <div wire:loading wire:target="ticket_files_response">
                                    <div class="flex items-center gap-1">
                                        <flux:icon.loading class="size-3"/>
                                        <flux:text class="!text-xs">{{ __('Cargando archivo') }}</flux:text>
                                    </div>
                                </div>
                                <flux:error name="ticket_files_response" class="!mt-0"/>
                            </flux:field>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 mt-7">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button type="button" variant="filled">{{ __('Cerrar') }}</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary">{{ __('Guardar actualización') }}</flux:button>
                </div>
            </form>

            <flux:modal name="analyze-ticket-ai-modal" class="w-[90%] md:w-xl">
                <div class="space-y-5">
                    <div>
                        <flux:heading size="lg">{{ __('Análisis AI') }}</flux:heading>
                        <flux:text>{{ __('Recomendaciones generadas para el manejo del ticket') }}</flux:text>
                    </div>
                    <div class="bg-light-variant dark:bg-dark-variant p-5 rounded-xl border border-neutral-300 dark:border-neutral-700">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <flux:icon.sparkles variant="mini" class="text-primary!"/>
                                <flux:heading>{{ __('Análisis AI para el departamento') }}</flux:heading>
                            </div>
                            @if($analyze_ticket_ai_response)
                                <div
                                    x-data="typeWords(@js($analyze_ticket_ai_response))"
                                    x-init="
                                        start();
                                        window.addEventListener('read-ticket-ai-response', () => {
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
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <flux:spacer />
                        <flux:modal.close>
                            <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                        </flux:modal.close>
                    </div>
                </div>
            </flux:modal>
        </flux:modal>
    @endif
</div>
