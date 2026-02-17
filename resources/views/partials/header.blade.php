<header
    x-data="{
        scrolled: false,
        scrolledMobile: false,
        mobileMenuOpen: false,
        mobileOpen: false,
        checkScroll() {
            if (window.innerWidth >= 1024) {
                this.scrolled = window.scrollY > 50
            }
            if (window.innerWidth < 1024) {
                this.scrolledMobile = window.scrollY > 50
            }
        }
    }"
    x-init="
        checkScroll()
        window.addEventListener('scroll', () => checkScroll())
        window.addEventListener('resize', () => checkScroll())
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'pt-5' : 'lg:pt-2'"
    >
        <div
        class="mx-auto transition-all duration-500 ease-in-out"
        :class="scrolled ? 'max-w-5xl px-6' : 'max-w-full px-0'"
    >
        <div
            class="border-0 border-transparent transition-all duration-500 ease-in-out [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_100ms_ease-in-out] overflow-hidden dark:overflow-visible"
            :class="scrolled
                ? 'backdrop-blur-lg bg-neutral-500/5 rounded-full !border-[1px] !border-neutral-200 dark:!border-neutral-800 [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_300ms_ease-in-out_500ms]'
                : (scrolledMobile
                    ? 'backdrop-blur-lg bg-neutral-500/5 dark:bg-neutral-900/5 shadow-md'
                    : 'border-0 border-transparent')"
        >
        <x-main-container>
            <div class="mx-auto flex items-center justify-between px-6 py-5 lg:py-4">
                <!-- Logo -->
                <a href="#" class="group flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary transition-transform duration-300 group-hover:scale-110">
                    <span class="text-sm font-bold text-dark">Ai</span>
                    </div>
                    <span class="font-display text-lg font-bold tracking-tight">NEURA</span>
                </a>

                <!-- Desktop nav -->
                <nav class="hidden items-center gap-8 md:flex">
                    <a href="#como-funciona" class="relative text-sm transition-colors duration-500 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-primary after:transition-all after:duration-500 hover:after:w-full">{{ __('Como funciona') }}</a>
                    <a href="#faqs" class="relative text-sm transition-colors duration-500 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-primary after:transition-all after:duration-500 hover:after:w-full">{{ __('Preguntas') }}</a>
                    <a href="#pricing" class="relative text-sm transition-colors duration-500 after:absolute after:-bottom-1 after:left-0 after:h-px after:w-0 after:bg-primary after:transition-all after:duration-500 hover:after:w-full">{{ __('Precios') }}</a>
                </nav>

                <!-- Desktop actions -->
                <div class="hidden items-center gap-3 md:flex">
                    <!-- Theme toggle -->
                    <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                        <flux:icon.sun x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                    </div>
                    <a href="{{ route('login') }}" wire:navigate class="text-sm px-3 py-1.5">{{ __('Iniciar sesion') }}</a>
                    <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center rounded-full bg-primary px-5 py-2 text-sm font-medium transition-all duration-300 hover:opacity-90 hover:shadow-lg hover:shadow-primary/20 text-light dark:text-dark">{{ __('Registrarse') }}</a>
                </div>

                <!-- Mobile actions -->
                <div class="flex items-center gap-2 md:hidden">
                    <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                        <flux:icon.sun x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                    </div>
                    <button @click="mobileOpen = !mobileOpen">
                        <flux:icon.bars-2 x-show="!mobileOpen" class="size-7"/>
                        <flux:icon.x-mark x-show="mobileOpen" class="size-7"/>
                    </button>
                </div>
            </div>
        </x-main-container>
        </div>
        </div>

        <!-- Mobile menu -->
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="h-screen bg-neutral-500/5 dark:bg-neutral-900/5 border-t border-t-neutral-300 dark:border-t-neutral-600 backdrop-blur-xl md:hidden"
            >
            <nav class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-6">
                <a href="#como-funciona" @click="mobileOpen = false" class="text-sm">{{ __('Como funciona') }}</a>
                <a href="#faqs" @click="mobileOpen = false" class="text-sm">{{ __('Preguntas') }}</a>
                <a href="#pricing" @click="mobileOpen = false" class="text-sm">{{ __('Precios') }}</a>
                <div class="flex flex-col gap-3 pt-4">
                    <a href="{{ route('login') }}" wire:navigate class="inline-flex text-center justify-center items-center rounded-full border dark:border-neutral-700 px-8 py-3 text-base  border-primary/40 bg-primary/5">
                        {{ __('Iniciar sesion') }}
                    </a>
                    <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center justify-center rounded-full bg-primary px-8 py-3 text-sm font-medium hover:opacity-90 text-light dark:text-dark">{{ __('Registrarse') }}</a>
                </div>
            </nav>
        </div>
    </header>
