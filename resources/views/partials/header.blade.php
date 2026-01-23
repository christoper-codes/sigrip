<header
    x-data="{
        scrolled: false,
        mobileMenuOpen: false,
        checkScroll() {
            if (window.innerWidth < 1024) {
                this.scrolled = true
            } else {
                this.scrolled = window.scrollY > 50
            }
        }
    }"
    x-init="
        checkScroll()
        window.addEventListener('scroll', () => checkScroll())
        window.addEventListener('resize', () => checkScroll())
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'pt-5' : 'pt-2'"
    >
    <div
        class="mx-auto transition-all duration-500 ease-in-out"
        :class="scrolled ? 'max-w-5xl px-6' : 'max-w-full px-0'"
    >
        <div
            class="border-0 border-transparent transition-all duration-500 ease-in-out [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_100ms_ease-in-out] overflow-hidden dark:overflow-visible"
            :class="scrolled
                ? 'backdrop-blur-lg bg-neutral-500/5 rounded-full !border-[1px] !border-neutral-200 dark:!border-neutral-800 [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_300ms_ease-in-out_500ms]'
                : 'border-0 border-transparent'"
        >
            <x-main-container>
                <nav class="flex items-center justify-between transition-all duration-500 py-2.5" :class="scrolled ? 'px-1 lg:px-5' : ''">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-app-logo-icon class="w-24"/>
                    </a>
                    <div class="lg:hidden flex items-center gap-3">
                        <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer size-7! border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center!">
                            <x-icon.sun variant="mini" class="size-4! text-dark! dark:text-light!"/>
                        </flux:link>
                        <button @click="mobileMenuOpen = true">
                            <flux:icon.bars-2 class="size-7"/>
                        </button>
                    </div>
                    <div class="transition-all duration-500 hidden lg:block">
                        <div class="flex items-center gap-5 text-base">
                            <a href="#">{{ __('Como funciona') }}</a>
                            <a href="#">{{ __('Preguntas') }}</a>
                            <a href="#">{{ __('Precios') }}</a>
                             <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                                <flux:icon.sun x-show="$flux.appearance === 'light'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                                <flux:icon.sun x-show="$flux.appearance === 'dark'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center gap-3">
                        @guest
                            <x-links.secondary url="{{ route('login') }}" title="{{ __('Iniciar sesion') }}"/>
                            <x-links.primary url="{{ route('register') }}" title="{{ __('Registrarse') }}" />
                        @endguest
                        @auth
                         <x-links.primary url="{{ route('dashboard') }}" title="{{ __('Panel de control') }}" />
                        @endauth
                    </div>
                </nav>
            </x-main-container>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div
        x-show="mobileMenuOpen"
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black/50 backdrop-blur-lg z-[60] lg:hidden"
        :class="mobileMenuOpen ? 'min-h-screen' : ''"
        @click="mobileMenuOpen = false"
    >
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-[-100%]"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-[-100%]"
            class="bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800 shadow-lg"
            @click.stop
        >
            <div class="px-6 py-6">
                <div class="flex items-center justify-between mb-8">
                    <x-app-logo-icon class="w-[90px]"/>
                    <button @click="mobileMenuOpen = false" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                        <flux:icon.x-mark class="size-6"/>
                    </button>
                </div>

                <nav class="space-y-6 text-base">
                    <a href="#" @click="mobileMenuOpen = false" class="block py-3 border-b border-neutral-200 dark:border-neutral-800">
                        {{ __('Como funciona') }}
                    </a>
                    <a href="#" @click="mobileMenuOpen = false" class="block py-3 border-b border-neutral-200 dark:border-neutral-800">
                        <span>{{ __('Preguntas') }}</span>
                    </a>
                    <a href="#" @click="mobileMenuOpen = false" class="block py-3 border-b border-neutral-200 dark:border-neutral-800">
                        {{ __('Precios') }}
                    </a>
                </nav>

                <div class="mt-8 flex flex-col gap-3">
                    @guest
                        <x-links.secondary
                            url="{{ route('login') }}"
                            title="{{ __('Iniciar sesion') }}"
                            class="!w-full"
                        />
                        <x-links.primary
                            url="{{ route('register') }}"
                            title="{{ __('Registrarse') }}"
                            class="!w-full "
                        />
                    @endguest

                    @auth
                        <x-links.primary
                            url="{{ route('dashboard') }}"
                            title="{{ __('Panel de control') }}"
                            class="!w-full "
                        />
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
