<div class="mx-auto px-8 py-12 w-full max-w-2xl">
    <flux:heading size="xl" class="text-3xl mb-4">{{ __('Crear un nuevo ticket') }}</flux:heading>
    <flux:text class="text-neutral-600 dark:text-neutral-500 mb-8">
        {{ __('Completa el formulario para crear un nuevo ticket.') }}
    </flux:text>

    @if (!$submitted)
        <form wire:submit="createTicket" class="space-y-6 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-2xl p-8">

            <flux:field>
                <flux:label class="font-semibold">{{ __('Departamento donde surge la incidencia') }}</flux:label>
                <flux:select wire:model="department_id" class="mt-2 !h-12">
                    <flux:select.option value="">{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach($departments as $id => $name)
                        <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department_id" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold">{{ __('Tipo de incidente') }}</flux:label>
                <flux:select wire:model="incident_type_id" class="mt-2 !h-12">
                    <flux:select.option value="">{{ __('Selecciona un tipo de incidente') }}</flux:select.option>
                    @foreach($incident_types as $id => $name)
                        <flux:select.option value="{{ $id }}">{{ $name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="incident_type_id" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold">{{ __('Incidencia') }}</flux:label>
                <flux:input wire:model="title" type="text" placeholder="{{ __('Breve descripción del problema') }}" class="mt-2" icon="exclamation-triangle" />
                <flux:error name="title" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold">{{ __('Descripción de la incidencia') }}</flux:label>
                <flux:textarea wire:model="description" placeholder="{{ __('Describe con detalle el problema...') }}" rows="6" class="mt-2" resize="none" icon="chat-bubble-bottom-center-text" />
                <flux:error name="description" />
            </flux:field>

            <flux:field>
                <flux:switch label="{{ __('Es prioridad') }}" wire:model="is_priority" align="left" name="is_priority"/>
                <flux:error name="is_priority" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold">{{ __('Subir evidencias (archivos, imágenes, documentos)') }}</flux:label>
                <flux:input type="file" name="evidence_files" wire:model="evidence_files" multiple accept=".xlsx, .csv, .pdf, .jpg, .png" class="mt-2" />

                <div wire:loading wire:target="evidence_files" class="mt-2">
                    <div class="flex items-center gap-1">
                        <flux:icon.loading class="size-3"/>
                        <flux:text class="!text-xs">{{ __('Cargando archivos...') }}</flux:text>
                    </div>
                </div>
                <flux:error name="evidence_files" class="!mt-0"/>
            </flux:field>

            <div class="flex gap-3">
                <flux:button type="submit" variant="primary" class="flex-1">
                    {{ __('Crear Ticket') }}
                </flux:button>
            </div>
        </form>
    @else
        <div class="text-center space-y-6">
            <div class="inline-flex items-center justify-center">
                <div class="size-16 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                    <flux:icon.check variant="solid" class="size-8 text-green-600" />
                </div>
            </div>
            <flux:heading size="lg">{{ __('¡Ticket creado exitosamente!') }}</flux:heading>

            <div class="bg-light-variant dark:bg-dark-variant border-2 border-green-500/30 rounded-2xl p-8 space-y-4">
                <flux:text class="font-semibold text-neutral-800 dark:text-neutral-200">
                    {{ __('Tu código de seguimiento es:') }}
                </flux:text>
                <div class="bg-white dark:bg-neutral-800 rounded-lg p-4 border border-neutral-300 dark:border-neutral-700">
                    <code class="text-sm md:text-base text-green-600 dark:text-green-400 font-mono break-all">
                        {{ $ticket_reference }}
                    </code>
                </div>
                <flux:text class="text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Guarda este código para dar seguimiento a tu ticket') }}
                </flux:text>
            </div>

            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-2xl p-6">
                <flux:text class="text-neutral-700 dark:text-neutral-300 mb-4">
                    {{ __('Puedes dar seguimiento a tu ticket en cualquier momento usando el código anterior en:') }}
                </flux:text>
                <a href="{{ route('ticket.track', ['uuid' => $ticket_reference]) }}" target="_blank" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:underline font-semibold">
                    <flux:icon.link class="size-5" />
                    {{ route('ticket.track', ['uuid' => $ticket_reference]) }}
                </a>
            </div>

            @if($contact_email)
                <flux:text class="text-neutral-600 dark:text-neutral-400">
                    {{ __('También recibirás un correo de confirmación en:') }}
                    <span class="font-semibold">{{ $contact_email }}</span>
                </flux:text>
            @endif

            <div class="flex gap-3 justify-center">
                <flux:button type="button" wire:click="resetForm" variant="primary">
                    {{ __('Crear otro ticket') }}
                </flux:button>
                <flux:button type="button" href="{{ route('ticket.track', ['uuid' => $ticket_reference]) }}" target="_blank" variant="ghost">
                    {{ __('Ver mi ticket') }}
                </flux:button>
            </div>
        </div>
    @endif
</div>
