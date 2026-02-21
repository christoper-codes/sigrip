
<div>
    <form wire:submit.prevent="searchAnalysis" class="space-y-6">
        <div class="flex flex-col md:flex-row gap-4">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por mes') }}</flux:label>
                <flux:select class="h-12!" name="month" wire:model="month">
                    @foreach ($months as $m)
                        <flux:select.option value="{{ $m['value'] }}">{{ $m['label'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="month" class="mt-0!" />
            </flux:field>

            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Seleccionar cuestionario') }}</flux:label>
                <flux:select class="h-12!" name="questionnaire_id" wire:model="questionnaire_id">
                    <flux:select.option value="0">{{ __('Seleccione un cuestionario') }}</flux:select.option>
                    @foreach ($questionnaires as $q)
                        <flux:select.option value="{{ $q['id'] }}">{{ $q['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="questionnaire_id" class="!mt-0" />
            </flux:field>
        </div>

        <div class="flex flex-col gap-2 max-w-2xl">
            <flux:label>{{ __('Pregunta para la IA (opcional)') }}</flux:label>
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach ($prompt_suggestions as $suggestion)
                    <flux:button wire:click="addSuggestion('{{ $suggestion }}')" type="button" variant="filled" size="sm">
                        <flux:text>{{ $suggestion }}</flux:text>
                    </flux:button>
                @endforeach
            </div>
            <flux:textarea name="prompt" resize="none" wire:model="prompt" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Ejemplo: ¿Cuál usuario sería el más propenso psicológicamente?') }}" />
            <flux:error name="prompt" class="!mt-0" />
        </div>

        <flux:button type="submit" icon="bolt" class="!py-6 !border  !border-primary !bg-primary/10 !rounded-xl !text-sm !cursor-pointer hover:!bg-primary/5 !transition-colors !shadow-xl/50 !shadow-primary/20">
            {{ __('Analizar selección') }}
        </flux:button>
    </form>


     <flux:modal name="show-questionnaire-analysis-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Análisis de selección') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Recomendaciones y análisis basados en las respuestas seleccionadas') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($ai_result)
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles variant="mini" class="text-primary!"/>
                        <flux:heading>{{ __('Análisis AI para la compañía') }}</flux:heading>
                    </div>
                        @if (isset($ai_result))
                            <div class="leading-relaxed whitespace-pre-line text-sm">
                                <div x-data="{
                                    words: [],
                                    index: 0,
                                    interval: null,
                                    start() {
                                        const html = `{!! addslashes($ai_result) !!}`;
                                        const parser = new DOMParser();
                                        const doc = parser.parseFromString(html, 'text/html');
                                        let text = doc.body.innerHTML;
                                        this.words = text.match(/(<[^>]+>|[^\s<]+|\s+)/g);
                                        this.index = 0;
                                        this.interval = setInterval(() => {
                                            if (this.index < this.words.length) {
                                                this.index++;
                                            } else {
                                                clearInterval(this.interval);
                                            }
                                        }, 40);
                                    }
                                }" x-init="start()">
                                    <span x-html="words.slice(0, index).join('')"></span>
                                    <span x-show="index < words.length" class="inline-block animate-pulse">▍</span>
                                </div>
                            </div>
                        @endif
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>
</div>
