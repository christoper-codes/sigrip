
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

    @if (isset($ai_result))
        <div class="mt-10 p-4 lg:p-7 bg-card rounded-2xl border border-border leading-relaxed whitespace-pre-line text-base" style="font-family: 'Space Grotesk', system-ui, sans-serif;">
            {!! $ai_result !!}
        </div>
    @endif
</div>
