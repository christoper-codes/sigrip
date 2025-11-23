<div class="w-full flex flex-col gap-14">
    <div wire:click='downloadTemplate' class="w-full max-w-xs flex items-center justify-center gap-2 p-5 border border-green-600 bg-green-300/10 rounded-2xl text-sm cursor-pointer hover:bg-green-300/5 transition-colors shadow-xl/50 shadow-green-500/20">
        <flux:icon.arrow-down-tray />
        <p>{{ __('Descargar plantilla') }}</p>
    </div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 items-start">
        <div class="flex flex-col border border-neutral-300 dark:border-neutral-900 p-5 rounded-2xl w-full">
            <flux:icon.shield-check />
            <flux:heading size="lg" class="mt-2">{{ __('Cifrado de datos') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Los datos están protegidos mediante cifrado para garantizar la seguridad durante el guardado.') }}</flux:text>
        </div>
        <div class="flex flex-col border border-neutral-300 dark:border-neutral-900 p-5 rounded-2xl w-full">
            <flux:icon.exclamation-circle />
            <flux:heading size="lg" class="mt-2">{{ __('Contraseñas') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Se recomienda utilizar contraseñas seguras para proteger la información de los empleados.') }}</flux:text>
        </div>
    </div>

    <div class="w-full flex flex-col border border-neutral-300 dark:border-neutral-900 p-5 md:p-10 rounded-2xl">
        <form wire:submit.prevent='submit' class="w-full max-w-md space-y-6">
            <flux:field>
                <flux:label>{{ __('Selecciona un departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model.live="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                        <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
            </flux:field>
            <flux:field>
                <flux:label class="!mb-3">{{ __('Asignar roles a los empleados') }}</flux:label>
                <flux:checkbox.group wire:model="user_roles">
                    @foreach ($roles as $role)
                        <flux:checkbox
                            value="{{ $role['id'] }}"
                            label="{{ $role['name'] }}"
                        />
                    @endforeach
                </flux:checkbox.group>
                <flux:error name="user_roles" class="!mt-0"/>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Selecciona un archivo a importar') }}</flux:label>
                <flux:input type="file" name="employee_file" wire:model="employee_file" accept=".xlsx, .csv" />
                <flux:error name="employee_file" class="!mt-0"/>
            </flux:field>

            <flux:button type="submit" variant="primary">{{ __('Guardar empleados') }}</flux:button>
            @if($import_errors)
                <div class="flex items-start gap-2 ">
                    <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                    <flux:text class="!text-red-500">{{ $import_errors }}</flux:text>
                </div>
            @endif
        </form>
    </div>
</div>
