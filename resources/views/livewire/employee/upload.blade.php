<div class="w-full flex flex-col gap-14">
    <flux:button icon="arrow-down" wire:click='downloadTemplate' class="!w-full !max-w-xs !py-8 !border !border-green-600 !bg-green-300/10 !rounded-2xl !text-sm !cursor-pointer hover:!bg-green-300/5 !transition-colors !shadow-xl/50 !shadow-green-500/20">
        {{ __('Descargar plantilla') }}
    </flux:button>

    <div class="w-full flex flex-col">
        <flux:heading size="xl">{{ __('Asociar empleados a un departamento') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Puntos a considerar antes de subir el archivo de empleados:') }}</flux:text>
        <ul class="text-sm opacity-70 space-y-2 mt-6">
            <li class="list-disc list-inside">{{ __('Columnas obligatorias (en minusculas sin tilde): nombre completo, correo electronico y password') }}</li>
            <li class="list-disc list-inside">{{ __('Correo electronico valido') }}</li>
            <li class="list-disc list-inside">{{ __('Password con minimo 8 caracteres') }}</li>
        </ul>

        <form wire:submit.prevent='submit' class="w-full max-w-xl space-y-6 mt-10 p-0 lg:p-10 rounded-2xl lg:border border-neutral-300 dark:border-neutral-900">
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
                <flux:label>{{ __('Subir archivo de empleados') }}</flux:label>
                <flux:input type="file" name="employee_file" wire:model="employee_file" accept=".xlsx, .csv" />
                <div wire:loading wire:target="employee_file">
                    <div class="flex items-center gap-1">
                        <flux:icon.loading class="size-3"/>
                        <flux:text class="!text-xs">{{ __('Cargando archivo') }}</flux:text>
                    </div>
                </div>
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
