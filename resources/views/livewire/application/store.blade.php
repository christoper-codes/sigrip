<div>
    <form wire:submit.prevent="submit" class="space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Departamento emisor') }}</flux:label>
            <flux:select class="!h-12" name="issuing_department" wire:model="form.issuing_department">
                <flux:select.option value="{{ $form->department['id'] }}">{{ $form->department['name'] }}</flux:select.option>
            </flux:select>
            <flux:error name="form.issuing_department" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Departamento receptor') }}</flux:label>
            <flux:select class="!h-12" name="executing_department" wire:model="form.executing_department">
                <flux:select.option value="" >{{ __('Seleccione un departamento') }}</flux:select.option>
                @foreach ($form->departments as $department)
                    <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="form.executing_department" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Cuestionario') }}</flux:label>
            <flux:select class="!h-12" name="questionnaire" wire:model="form.questionnaire">
                <flux:select.option value="" >{{ __('Seleccione un cuestionario') }}</flux:select.option>
                @foreach ($form->questionnaires as $questionnaire)
                    <flux:select.option value="{{ $questionnaire['id'] }}">{{ $questionnaire['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="form.questionnaire" class="!mt-0"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Fecha de inicio') }}</flux:label>
            <flux:input type="date" name="start_date" wire:model="form.start_date" icon="calendar" placeholder="{{ __('Fecha de inicio') }}"/>
            <flux:error name="form.start_date" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Fecha de expiración') }}</flux:label>
            <flux:input type="date" name="expiration_date" wire:model="form.expiration_date" icon="calendar" placeholder="{{ __('Fecha de expiración') }}"/>
            <flux:error name="form.expiration_date" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Requiere autenticación') }}</flux:label>
            <flux:switch wire:model="form.auth_required" align="left" name="auth_required"/>
            <flux:error name="form.auth_required" />
        </flux:field>

        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>

    <flux:modal name="qr-application-modal" class="w-[90%] md:w-full!">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">{{ __('Aplicación creada correctamente') }}</flux:heading>
                <flux:text class="mt-3">{{ __('Puedes descargar el código QR de la aplicación o copiar el link y compartirlo con los empleados.') }}</flux:text>
            </div>
            <div class="flex flex-col items-center gap-4">
                @if($form->url_qr && $form->slug)
                    <img src="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" alt="QR" class="border w-48 h-48 mx-auto" />
                    <a href="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" download class="mt-2">
                        <flux:button icon="arrow-down-on-square" variant="outline">{{ __('Descargar') }}</flux:button>
                    </a>
                    <div class="mt-2 text-xs break-all text-center">
                        <span>{{ $form->url_qr }}</span>
                    </div>
                @endif
            </div>
            <div class="flex gap-2">
                 <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
