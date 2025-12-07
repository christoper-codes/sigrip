<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Inicia sesión en tu cuenta')" :description="__('Bienvenido de nuevo, inicia sesión para continuar')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6" x-data="{ busy: false }" x-on:submit="busy = true">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Correo electrónico')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Contraseña')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0 hover:!no-underline" variant="ghost" :href="route('password.request')" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Recordar sesión')" :checked="old('remember')" />

            <div class="flex items-center justify-end w-full">
                <flux:button x-bind:disabled="busy" type="submit" class="!whitespace-nowrap !w-full !py-6 cursor-pointer! rounded-full! !text-base !bg-dark dark:!bg-light hover:!bg-neutral-800 dark:hover:!bg-neutral-200 !transition-all !duration-500 !text-center !text-white dark:!text-neutral-800">
                    {{ __('Iniciar sesión') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('¿No tienes una cuenta?') }}</span>
                <flux:link :href="route('register')" variant="ghost" class="hover:!no-underline" wire:navigate>{{ __('Regístrate') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts.auth>
