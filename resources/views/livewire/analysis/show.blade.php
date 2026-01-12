<div>
    <form wire:submit.prevent='searchApplications'>
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                            <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
            </flux:field>
        </div>
        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar aplicaciones') }}</flux:button>
   </form>

   <flux:modal name="select-application" class="w-[90%] md:w-md space-y-7">
        <div>
            <flux:heading size="lg">{{ __('Seleccione una aplicación') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Ver resultados detallados') }}</flux:text>
        </div>
        <div>
            @if($applications)
                <flux:radio.group wire:model="application">
                    @foreach ($applications as $application)
                        <flux:radio
                            name="application"
                            value="{{ $application['id'] }}"
                            label="{{ ucfirst(str_replace('-', ' ', explode('-', $application['slug'], -1) ? implode('-', explode('-', $application['slug'], -1)) : $application['slug'])) }}"
                            description="{{'Inicio: ' . $application['start_date'] . ' - Término: ' . $application['expiration_date'] }}"
                        />
                    @endforeach
                </flux:radio.group>
                @if($application_error)
                    <div class="flex items-start gap-2 mt-2">
                        <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                        <flux:text class="!text-red-500">{{ $application_error }}</flux:text>
                    </div>
                @endif
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cancelar') }}</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" wire:click="resultApplication">{{ __('Buscar resultados') }}</flux:button>
        </div>
    </flux:modal>
</div>
