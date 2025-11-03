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
            class="border-0 border-transparent transition-all duration-500 ease-in-out [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_100ms_ease-in-out]"
            :class="scrolled ? 'backdrop-blur-lg bg-light/5 rounded-full !border-[1px] !border-neutral-700 [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_300ms_ease-in-out_500ms]' : 'border-0 border-transparent'"
        >
            <x-main-container>
                <nav class="flex items-center justify-between gap-5 transition-all duration-500" :class="scrolled ? 'px-5' : ''">
                    <div>
                        <x-app-logo-icon class="size-5 fill-current uppercase tracking-widest [filter:drop-shadow(0px_0px_15px_rgb(255_255_255_/_100%))]"/>
                    </div>
                    <div class="transition-all duration-500">
                        <flux:navbar>
                            <flux:navbar.item href="#" icon="bolt">{{ __('Como funciona') }}</flux:navbar.item>
                            <flux:navbar.item href="#" icon="chat-bubble-bottom-center">{{ __('Preguntas') }}</flux:navbar.item>
                            <flux:navbar.item href="#" icon="cube">{{ __('Precios') }}</flux:navbar.item>
                        </flux:navbar>
                    </div>
                    <div>
                        <flux:button variant="primary">{{ __('Iniciar sesión') }}</flux:button>
                    </div>
                </nav>
            </x-main-container>
        </div>
    </div>
</header>
