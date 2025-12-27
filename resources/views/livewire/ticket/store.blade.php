<div>
    <form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Departamendo donde surge la incidencia') }}</flux:label>
            <flux:select class="!h-12" name="department" wire:model.live="department">
                <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                @foreach ($departments as $department)
                    <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="department" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Selecciona un tipo de incidente') }}</flux:label>
            <flux:select class="!h-12" name="incident_type" wire:model.live="incident_type">
                <flux:select.option value="" >{{ __('Selecciona un tipo de incidente') }}</flux:select.option>
                @foreach ($incident_types as $incident_type)
                    <flux:select.option value="{{ $incident_type['id'] }}">{{ $incident_type['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="incident_type" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Incidencia') }}</flux:label>
            <flux:input name="title" wire:model="title" icon="exclamation-triangle" placeholder="{{ __('Título de la incidencia') }}"/>
            <flux:error name="title" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Descripción de la incidencia') }}</flux:label>
            <flux:textarea name="description" resize="none" wire:model="description" icon="chat-bubble-bottom-center-text" placeholder="{{ __('Descripción detallada') }}"/>
            <flux:error name="description"/>
        </flux:field>
        <flux:field>
            <flux:switch label="Es prioridad" wire:model="is_priority" align="left" name="is_priority"/>
            <flux:error name="is_priority" />
        </flux:field>
        <flux:field>
            <flux:switch label="Es anónimo" wire:model="is_anonymous" align="left" name="is_anonymous"/>
            <flux:error name="is_anonymous" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Subir evidencias (archivos, imágenes, documentos)') }}</flux:label>
            <flux:input type="file" name="evidence_files" wire:model="evidence_files" multiple accept=".xlsx, .csv, .pdf, .jpg, .png" />

            <div wire:loading wire:target="evidence_files">
                <div class="flex items-center gap-1">
                    <flux:icon.loading class="size-3"/>
                    <flux:text class="!text-xs">{{ __('Cargando archivo') }}</flux:text>
                </div>
            </div>
            <flux:error name="evidence_files" class="!mt-0"/>
        </flux:field>

        <flux:button type="submit" variant="primary">{{ __('Crear ticket') }}</flux:button>
    </form>
</div>
