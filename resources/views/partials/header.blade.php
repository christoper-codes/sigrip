<header
    x-data="{ scrolled: false }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 50
        })
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'pt-4' : 'pt-0'"
    >
    <div class="mx-auto transition-all duration-500 ease-in-out" :class="scrolled ? 'max-w-4xl px-6' : 'max-w-full px-0'">
        <div
            class="border-0 border-transparent transition-all duration-500 ease-in-out [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_100ms_ease-in-out] overflow-hidden dark:overflow-visible"
            :class="scrolled ? 'backdrop-blur-lg bg-neutral-500/5 rounded-full !border-[1px] !border-neutral-200 dark:!border-neutral-800 [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_300ms_ease-in-out_500ms]' : 'border-0 border-transparent'"
        >
            <x-main-container>
                <nav class="flex items-center justify-between gap-5 transition-all duration-500 py-2.5" :class="scrolled ? 'px-5' : ''">
                    <div>
                        <x-app-logo-icon class="fill-current uppercase tracking-[5px] mr-5"/>
                    </div>
                    <div class="transition-all duration-500">
                        <nav class="flex items-center gap-5">
                            <a href="#" class="uppercase text-xs">{{ __('Como funciona') }}</a>
                            <div class="flex items-center gap-2">
                                <flux:icon.chat-bubble-left class="size-4" />
                                <a href="#" icon="chat-bubble-bottom-center" class="uppercase text-xs">{{ __('Preguntas') }}</a>
                            </div>
                            <a href="#" class="uppercase text-xs">{{ __('Precios') }}</a>
                        </nav>
                    </div>
                    <div class="flex items-center gap-3">
                        <flux:link href="{{ route('login') }}" class="btn uppercase hover:!no-underline" variant="ghost">
                            {{ __('Iniciar sesion') }}
                        </flux:link>
                        <flux:link href="{{ route('register') }}" class="hover:!no-underline" variant="ghost" wire:navigate>
                            <x-buttons.primary title="{{ __('Registrarse') }}" />
                        </flux:link>
                    </div>
                </nav>
            </x-main-container>
        </div>
    </div>
</header>
