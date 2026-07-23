<div>
    <!-- Progress Steps -->
    <div class="flex items-center gap-5 mb-10">
        @for ($step = 1; $step <= 3; $step++)
            <div class="flex items-center">
                <div class="text-center flex items-center justify-center rounded-full size-12
                    @if ($step < $current_step)
                        bg-green-500 text-white border-green-300
                    @elseif ($step === $current_step)
                        dark:bg-light bg-dark border dark:border-neutral-300 border-neutral-700 text-light dark:text-dark
                    @else
                        bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700
                    @endif">
                    @if ($step < $current_step)
                        <flux:icon.check class="size-5" />
                    @else
                        <span>{{ $step }}</span>
                    @endif
                </div>
            </div>
        @endfor
    </div>

    <!-- Step 1: Create Company -->
    @if ($current_step === 1)
        <div class="max-w-2xl">
            <flux:heading size="xl">{{ __('Crea tu compañía') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Completa el formulario para configurar tu cuenta y agregar departamentos.') }}</flux:text>
            <div class="mt-5">
                <livewire:company.store wizard="true"/>
            </div>
        </div>
    @endif

    <!-- Step 2: Create Department -->
    @if ($current_step === 2)
        <div class="max-w-2xl">
            <flux:heading size="xl">{{ __('Crea un departamento') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Completa el formulario para crear aplicaciones y usuarios.') }} <br> <span class="font-bold">{{ __('(Es necesario tener un departamento de RH para continuar)') }}</span> </flux:text>
            <div class="mt-5">
                <livewire:department.store :hr_department="true" />
            </div>
        </div>
    @endif

    <!-- Step 3: Setup Applications -->
    @if ($current_step === 3)
        <div class="max-w-2xl">
            <flux:heading size="xl">{{ __('Manejar aplicaciones') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Configura y crea aplicaciones (formularios) para tu organización.') }}</flux:text>
            <div class="mt-10">
                <flux:button
                    href="{{ route('application.index') }}"
                    icon:trailing="arrow-right"
                    variant="primary"
                    class="py-7! px-10!"
                >
                    {{ __('Crear aplicación') }}
                </flux:button>
            </div>
        </div>
    @endif
</div>
