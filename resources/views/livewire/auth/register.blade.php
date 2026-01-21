<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Crear una cuenta')" :description="__('Ingresa tus datos a continuación para crear tu cuenta')" />

        <flux:button href="{{ route('auth.google') }}" class="w-full py-6">
            <x-slot name="icon">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.06 12.25C23.06 11.47 22.99 10.72 22.86 10H12.5V14.26H18.42C18.16 15.63 17.38 16.79 16.21 17.57V20.34H19.78C21.86 18.42 23.06 15.6 23.06 12.25Z" fill="#4285F4"/><path d="M12.4997 23C15.4697 23 17.9597 22.02 19.7797 20.34L16.2097 17.57C15.2297 18.23 13.9797 18.63 12.4997 18.63C9.63969 18.63 7.20969 16.7 6.33969 14.1H2.67969V16.94C4.48969 20.53 8.19969 23 12.4997 23Z" fill="#34A853"/><path d="M6.34 14.0899C6.12 13.4299 5.99 12.7299 5.99 11.9999C5.99 11.2699 6.12 10.5699 6.34 9.90995V7.06995H2.68C1.93 8.54995 1.5 10.2199 1.5 11.9999C1.5 13.7799 1.93 15.4499 2.68 16.9299L5.53 14.7099L6.34 14.0899Z" fill="#FBBC05"/><path d="M12.4997 5.38C14.1197 5.38 15.5597 5.94 16.7097 7.02L19.8597 3.87C17.9497 2.09 15.4697 1 12.4997 1C8.19969 1 4.48969 3.47 2.67969 7.07L6.33969 9.91C7.20969 7.31 9.63969 5.38 12.4997 5.38Z" fill="#EA4335"/></svg>
            </x-slot>
            {{ __('Continuar con Google') }}
        </flux:button>

        <flux:separator text="or" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6" x-data="{ busy: false }" x-on:submit="busy = true">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nombre completo')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Nombre completo')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Contraseña')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirmar contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirmar contraseña')"
                viewable
            />

            <div class="flex items-center justify-end w-full">
                <flux:button type="submit" x-bind:disabled="busy" class="!whitespace-nowrap !w-full !py-6 cursor-pointer! rounded-full! !text-base !bg-dark dark:!bg-light hover:!bg-neutral-800 dark:hover:!bg-neutral-200 !transition-all !duration-500 !text-center !text-white dark:!text-neutral-800">
                   {{ __('Crear cuenta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('¿Ya tienes una cuenta?') }}</span>
            <flux:link :href="route('login')" variant="ghost" class="hover:!no-underline" wire:navigate>{{ __('Iniciar sesión') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>
