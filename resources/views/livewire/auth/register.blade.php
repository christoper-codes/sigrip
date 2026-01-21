<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Crear una cuenta')" :description="__('Ingresa tus datos a continuación para crear tu cuenta')" />

        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('auth.google') }}"
            class="!whitespace-nowrap !w-full !py-6 rounded-full !text-base !bg-red-600 hover:!bg-red-700 !transition-all !duration-500 !text-center !text-white">
                {{ __('Continuar con Google') }}
            </a>
        </div>

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
