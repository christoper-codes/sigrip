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
                <livewire:company.store />
            </div>
        </div>
    @endif

    <!-- Step 2: Create Department -->
    @if ($current_step === 2)
        <div class="max-w-2xl">
            <flux:heading size="xl">{{ __('Crea un departamento') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Completa el formulario para crear aplicaciones y usuarios. (Es necesario tener un departamento de RH)') }}</flux:text>
            <div class="mt-5">
                <livewire:department.store />
            </div>
        </div>
    @endif

    <!-- Step 3: Setup Applications (Ejemplo) -->
    @if ($current_step === 3)
        <div class="max-w-2xl">
            <flux:heading size="xl">{{ __('Configura aplicaciones') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Configura las aplicaciones y formularios para tu organización.') }}</flux:text>
            <div class="mt-5">
                {{-- <livewire:application.store /> --}}
                <div class="p-6 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl text-center">
                    <flux:icon.cog-6-tooth class="size-12 mx-auto mb-4 text-neutral-400" />
                    <p class="text-neutral-600 dark:text-neutral-400">{{ __('Componente de aplicaciones próximamente') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
