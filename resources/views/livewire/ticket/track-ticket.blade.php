<div class="mx-auto px-8 py-12 w-full max-w-3xl">
    <flux:heading size="xl" class="text-3xl mb-4">{{ __('Seguimiento de incidencia') }}</flux:heading>
    <flux:text class="text-neutral-600 dark:text-neutral-500 mb-8">
        {{ __('Ingresa tu código de seguimiento para ver el estado de tu ticket') }}
    </flux:text>

    <div class="bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-2xl p-8 mb-8">
        <form wire:submit="searchTicket" class="space-y-4">
            <flux:field>
                <flux:label class="font-semibold">{{ __('Código de seguimiento') }}</flux:label>
                <flux:input wire:model="tracking_code" type="text" placeholder="{{ __('Ej: 00855982') }}" class="mt-2" icon="magnifying-glass" />
                <flux:error name="tracking_code" />
            </flux:field>

            <flux:button type="submit" variant="primary">
                {{ __('Buscar incidencia') }}
            </flux:button>
        </form>
    </div>

    @if($searched)
        @if($found && $ticket)
            <div class="bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-2xl p-8 space-y-6">
                <div class="flex items-start justify-between">
                    <div>
                        <flux:heading size="lg" class="mb-2">{{ $ticket->title }}</flux:heading>
                        <flux:text class="text-neutral-600 dark:text-neutral-400">
                            {{ __('Creado el') }}: {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </flux:text>
                    </div>
                    <flux:badge size="lg" :color="$ticket->supportTicketStatus->name === 'abierto' ? 'blue' : ($ticket->supportTicketStatus->name === 'cerrado' ? 'green' : 'yellow')">
                        {{ ucfirst($ticket->supportTicketStatus->name) }}
                    </flux:badge>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-1">{{ __('Empresa') }}</flux:text>
                        <flux:text class="text-lg">{{ $ticket->company->name }}</flux:text>
                    </div>
                    <div>
                        <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-1">{{ __('Departamento') }}</flux:text>
                        <flux:text class="text-lg">{{ $ticket->department->name }}</flux:text>
                    </div>
                    <div>
                        <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-1">{{ __('Tipo de Incidente') }}</flux:text>
                        <flux:text class="text-lg">{{ $ticket->incidentType->name }}</flux:text>
                    </div>
                    <div>
                        <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-1">{{ __('Prioridad') }}</flux:text>
                        <flux:text class="text-lg">{{ $ticket->is_priority ? __('Alta') : __('Normal') }}</flux:text>
                    </div>
                </div>

                <div>
                    <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-2">{{ __('Descripción') }}</flux:text>
                    <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-neutral-200 dark:border-neutral-700">
                        <flux:text>{{ $ticket->description }}</flux:text>
                    </div>
                </div>

                @if($ticket->contact_email)
                    <div>
                        <flux:text class="font-semibold text-sm text-neutral-500 dark:text-neutral-400 mb-1">{{ __('Email de Contacto') }}</flux:text>
                        <flux:text>{{ $ticket->contact_email }}</flux:text>
                    </div>
                @endif

                @if($ticket->resolved_at)
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <flux:text class="font-semibold text-green-800 dark:text-green-300">
                            {{ __('Ticket Resuelto el') }}: {{ $ticket->resolved_at->format('d/m/Y H:i') }}
                        </flux:text>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center">
                <div class="inline-flex items-center justify-center mb-4">
                    <div class="size-16 rounded-full bg-red-100 dark:bg-red-900/20 flex items-center justify-center">
                        <flux:icon.x-mark variant="solid" class="size-8 text-red-600 dark:text-red-500" />
                    </div>
                </div>
                <flux:heading size="lg" class="mb-2">{{ __('Incidencia no encontrada') }}</flux:heading>
                <flux:text class="text-neutral-600 dark:text-neutral-400">
                    {{ __('No se encontró ninguna incidencia con ese código de seguimiento') }}
                </flux:text>
            </div>
        @endif
    @endif
</div>
