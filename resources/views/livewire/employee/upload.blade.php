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
        <div class="flex flex-col border border-neutral-200 dark:border-neutral-900 p-5 rounded-2xl w-full">
            <flux:icon.exclamation-circle />
            <flux:heading size="lg" class="mt-2">{{ __('Contraseñas') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Se recomienda utilizar contraseñas seguras para proteger la información de los empleados.') }}</flux:text>
        </div>
    </div>
</div>
