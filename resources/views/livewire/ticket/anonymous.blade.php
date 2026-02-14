<div class="mx-auto lg:px-8 py-12 w-full max-w-2xl">
    @if (! $submitted)
        <div class="py-2 px-4 rounded-full text-center text-sm border bg-primary/20 border-primary inline-block mx-auto">
            {{ $company_name }}
        </div>
        <h1 class="text-3xl max-w-4xl uppercase mb-4 mt-3">
            {{ __('Reporta una incidencia') }}</span>
        </h1>
        <flux:text>
            {{ __('Utiliza este formulario para levantar un ticket de incidencia en cualquier departamento, sin necesidad de revelar tu identidad') }}
        </flux:text>
        <div class="mb-10 mt-3">
            <flux:text>
                {{ __('¿Ya has reportado una incidencia antes?') }} <flux:link class="ml-1!" href="{{ route('ticket.track.form') }}" wire:navigate>{{ __('Ver seguimiento') }}</flux:link>
            </flux:text>
        </div>

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
                <flux:label class="font-semibold">{{ __('Correo electrónico (opcional)') }}</flux:label>
                <flux:input wire:model="contact_email" type="email" placeholder="{{ __('Tu correo electrónico') }}" class="mt-2" icon="envelope" />
                <flux:error name="contact_email" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold">{{ __('Nombre (opcional)') }}</flux:label>
                <flux:input wire:model="contact_name" type="text" placeholder="{{ __('Tu nombre') }}" class="mt-2" icon="user" />
                <flux:error name="contact_name" />
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
                <flux:button type="submit" variant="primary" class="flex-1 py-6!">
                    {{ __('Crear incidencia') }}
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

            <div class="bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-2xl p-8 space-y-4">
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

            <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800 rounded-2xl p-6">
                <flux:text class="text-neutral-700 dark:text-neutral-300 mb-4">
                    {{ __('Puedes dar seguimiento a tu ticket en cualquier momento usando el código anterior en:') }}
                </flux:text>
                <a href="{{ route('ticket.track.form') }}" target="_blank" class="inline-flex items-center gap-2">
                    <flux:icon.link class="size-5" />
                    <span class="truncate max-w-[200px] md:max-w-none md:whitespace-normal block">
                        {{ route('ticket.track.form') }}
                    </span>
                </a>
            </div>

            <div class="flex gap-3 justify-center">
                <flux:button wire:click="resetForm" variant="filled">
                    {{ __('Crear otro ticket') }}
                </flux:button>
                <flux:button variant="primary" href="{{ route('ticket.track.form') }}" target="_blank">
                    {{ __('Ver seguimiento') }}
                </flux:button>
            </div>
        </div>
    @endif
</div>
