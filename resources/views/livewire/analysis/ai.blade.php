
<div>
    <form wire:submit.prevent="searchAnalysis" class="space-y-6">
        <div class="flex flex-col md:flex-row gap-4">
            <flux:field class="max-w-md w-full">
                <flux:label>Filtrar por mes</flux:label>
                <flux:select class="!h-12" name="month" wire:model="month">
                    @foreach ($months as $m)
                        <flux:select.option value="{{ $m['value'] }}">{{ $m['label'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="month" class="!mt-0" />
            </flux:field>

            <flux:field class="max-w-md w-full">
                <flux:label>Seleccionar cuestionario</flux:label>
                <flux:select class="!h-12" name="questionnaire_id" wire:model="questionnaire_id">
                    <flux:select.option value="0">Seleccione...</flux:select.option>
                    @foreach ($questionnaires as $q)
                        <flux:select.option value="{{ $q['id'] }}">{{ $q['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="questionnaire_id" class="!mt-0" />
            </flux:field>
        </div>

        <div class="flex flex-col gap-2 max-w-2xl">
            <flux:label>Pregunta para la IA (opcional)</flux:label>
            <div class="flex flex-wrap gap-2 mb-2">
                @foreach ($prompt_suggestions as $suggestion)
                    <button type="button"
                        class="px-2 py-1 rounded text-xs transition-colors bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-100"
                        wire:click="addSuggestion('{{ $suggestion }}')">
                        {{ $suggestion }}
                    </button>
                @endforeach
                <button type="button"
                    class="px-2 py-1 rounded text-xs transition-colors bg-red-200 hover:bg-red-300 dark:bg-red-700 dark:hover:bg-red-600 dark:text-neutral-100"
                    wire:click="clearAll">Limpiar</button>
            </div>
            <flux:textarea name="prompt" resize="none" wire:model="prompt" icon="chat-bubble-bottom-center-text" placeholder="Ejemplo: ¿Cuál usuario sería el más propenso psicológicamente?" />
            <flux:error name="prompt" class="!mt-0" />
        </div>

        <flux:button type="submit" variant="primary" class="mt-3">Analizar</flux:button>
    </form>

    {{-- Aquí se mostrará la respuesta de la IA --}}
    @if (isset($ai_result))
        <div class="mt-8 p-4 bg-card rounded-xl border border-border whitespace-pre-line">
            {!! $ai_result !!}
        </div>
    @endif
</div>
