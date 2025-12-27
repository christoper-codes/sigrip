<div>
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
        <div class="flex gap-4 overflow-x-auto h-[70vh] overflow-y-hidden">
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
                            <div class="bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 border-l-4 border-l-neutral-300 dark:border-l-neutral-700 p-3 rounded-xl cursor-pointer hover:scale-105 transition-all duration-500">
                                <flux:heading>{{ $ticket['title'] }}</flux:heading>
                                <flux:text class="mt-2">{{ $ticket['created_at'] }}</flux:text>
                                <flux:text class="mt-2 text-primary">{{ $ticket['incident_type']['name'] }}</flux:text>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($notify_message)
        <div class="max-w-xl w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ $notify_message }}" />
        </div>
    @else
        <div class="max-w-md w-full">
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
        </div>
    @endif
</div>
