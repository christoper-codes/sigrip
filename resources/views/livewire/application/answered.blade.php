<div class="text-center flex items-center justify-center">
    <div>
        <flux:icon.check-circle class="size-16! text-green-500 mx-auto mb-6" />
         <flux:heading size="xl" class="uppercase!">{{ __('Aplicación respondida') }}</flux:heading>
        <flux:text class="mt-4 mb-8">
            {{ __('Esta aplicación ya ha sido respondida, no se pueden enviar más respuestas.') }}
            @auth
                <flux:link href="{{ route('application.index') }}">{{ __('Mis aplicaciones') }}</flux:link>
            @endauth
        </flux:text>
    </div>
</div>
