<div>
   <form wire:submit.prevent='searchApplications'>
        <div class="flex items-center gap-3">

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

        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar aplicaciones') }}</flux:button>
   </form>


    <flux:modal name="edit-application-modal" class="w-[90%] md:w-2xl!" @close="editModalClosed()">
        <form wire:submit.prevent="confirmUpdateApplication" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Editar aplicación') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Actualizar los detalles y guardar los cambios.') }}</flux:text>
            </div>
            <flux:field>
                <flux:label>{{ __('Departamento emisor') }}</flux:label>
                <flux:select class="!h-12" name="issuing_department" wire:model="form.issuing_department">
                    @if ($form->department)
                        <flux:select.option value="{{ $form->department['id'] }}">{{ $form->department['name'] }}</flux:select.option>
                    @endif
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
                <div x-data>
                    <div @click="$refs.dateInput.showPicker()" class="relative cursor-pointer">
                        <flux:input type="date" name="start_date" wire:model="form.start_date" icon="calendar" placeholder="{{ __('Fecha de inicio') }}" x-ref="dateInput" />
                    </div>
                </div>
                <flux:error name="form.start_date" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Fecha de expiración') }}</flux:label>
                <div x-data>
                    <div @click="$refs.dateInput.showPicker()" class="relative cursor-pointer">
                        <flux:input type="date" name="expiration_date" wire:model="form.expiration_date" icon="calendar" placeholder="{{ __('Fecha de expiración') }}" x-ref="dateInput" />
                    </div>
                </div>
                <flux:error name="form.expiration_date" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Requiere autenticación') }}</flux:label>
                <flux:switch wire:model="form.auth_required" align="left" name="auth_required"/>
                <flux:error name="form.auth_required" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Requiere datos del empleado') }}</flux:label>
                <flux:switch wire:model="form.employee_data_required" align="left" name="employee_data_required"/>
                <flux:error name="form.employee_data_required" />
            </flux:field>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">{{ __('Actualizar') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="destroy-application-modal" class="w-[90%] md:max-w-md!">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de que deseas eliminar esta aplicación?') }}</flux:heading>
                <flux:text class="mt-3 font-semibold">{{ $application_name }}</flux:text>
            </div>
            <div class="flex gap-2">
                 <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                <flux:button variant="danger" wire:click="destroy">
                    {{ __('Eliminar') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="index-qr-application-modal" class="w-[90%] md:w-full!">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Compartir aplicación') }}</flux:heading>
                <flux:text class="mt-3">{{ __('Puedes descargar el código QR de la aplicación o copiar el link y compartirlo con los empleados.') }}</flux:text>
            </div>
            <div class="flex flex-col items-center gap-4">
                @if($form->url_qr && $form->slug)
                    <img src="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" alt="QR" class="border w-48 h-48 mx-auto" />
                    <a href="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" download class="mt-2">
                        <flux:button class="cursor-pointer" icon="arrow-down-on-square" variant="outline">{{ __('Descargar') }}</flux:button>
                    </a>
                    <div class="mt-2 break-all text-center">
                        <div x-data="{ copied: false }" class="flex items-center gap-2">
                            <flux:heading size="lg" class="truncate! w-52! md:w-80! block">{{ $form->url_qr }}</flux:heading>
                            <flux:icon.clipboard-document class="cursor-pointer" variant="solid" x-show="!copied" @click="navigator.clipboard.writeText('{{ $form->url_qr }}'); copied = true; setTimeout(() => copied = false, 1500)" />
                            <flux:icon.check variant="solid" x-show="copied" disabled />
                        </div>
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

