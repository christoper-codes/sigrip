<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 }, { passive: true })"
    :class="scrolled
        ? 'backdrop-blur-xl bg-[#060608]/90 border-white/[0.07]'
        : 'border-transparent bg-[#060608]/90 dark:bg-transparent'"
    class="w-full z-50 fixed top-0 left-0 right-0 border-b transition-all duration-500"
>
    <div class="mx-auto max-w-6xl px-5 lg:px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2.5 shrink-0">
                <x-app-logo-icon />
                <span class="text-sm font-bold tracking-widest text-white/90 uppercase">SIGRIP</span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center gap-8">
                <a href="#howworks"    class="text-[12px] font-medium tracking-wide text-white/40 transition-colors duration-200 hover:text-white">Características</a>
                <a href="#testimonials" class="text-[12px] font-medium tracking-wide text-white/40 transition-colors duration-200 hover:text-white">Testimonios</a>
                <a href="#pricing"     class="text-[12px] font-medium tracking-wide text-white/40 transition-colors duration-200 hover:text-white">Precios</a>
                <a href="#faqs"        class="text-[12px] font-medium tracking-wide text-white/40 transition-colors duration-200 hover:text-white">FAQ</a>
            </nav>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-2">
                <!-- Theme toggle -->
                <button
                    x-on:click="$flux.dark = !$flux.dark"
                    :title="$flux.appearance === 'dark' ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
                    class="flex h-8 w-8 items-center justify-center text-white/35 transition-colors duration-200 hover:text-white"
                >
                    <flux:icon.sun  x-show="$flux.appearance === 'dark'"  variant="mini" class="size-4!" />
                    <flux:icon.moon x-show="$flux.appearance === 'light'" variant="mini" class="size-4!" />
                </button>

                <a href="{{ route('login') }}" wire:navigate class="px-4 py-2 text-[12px] font-medium tracking-wide text-white/45 transition-colors hover:text-white">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" wire:navigate class="border border-white/15 bg-white/5 px-5 py-2 text-[12px] font-medium tracking-wide text-white/80 backdrop-blur-sm transition-all duration-200 hover:border-white/30 hover:bg-white/10 hover:text-white">
                    Comenzar →
                </a>
            </div>

            <!-- Mobile right side -->
            <div class="flex lg:hidden items-center gap-1">
                <!-- Theme toggle mobile -->
                <button
                    x-on:click="$flux.dark = !$flux.dark"
                    class="flex h-9 w-9 items-center justify-center text-white/40 transition-colors hover:text-white"
                >
                    <flux:icon.sun  x-show="$flux.appearance === 'dark'"  variant="mini" class="size-4!" />
                    <flux:icon.moon x-show="$flux.appearance === 'light'" variant="mini" class="size-4!" />
                </button>

                <!-- Hamburger -->
                <button @click="mobileOpen = !mobileOpen" class="p-2 -mr-2 text-white/50 hover:text-white transition-colors">
                    <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="lg:hidden border-t border-white/5 pb-5"
        >
            <nav class="flex flex-col mt-2">
                <a @click="mobileOpen=false" href="#howworks"     class="block px-1 py-3.5 text-sm font-medium text-white/55 hover:text-white border-b border-white/5 transition-colors">Características</a>
                <a @click="mobileOpen=false" href="#testimonials" class="block px-1 py-3.5 text-sm font-medium text-white/55 hover:text-white border-b border-white/5 transition-colors">Testimonios</a>
                <a @click="mobileOpen=false" href="#pricing"      class="block px-1 py-3.5 text-sm font-medium text-white/55 hover:text-white border-b border-white/5 transition-colors">Precios</a>
                <a @click="mobileOpen=false" href="#faqs"         class="block px-1 py-3.5 text-sm font-medium text-white/55 hover:text-white transition-colors">FAQ</a>
            </nav>
            <div class="mt-5 flex flex-col gap-2">
                <a href="{{ route('login') }}" wire:navigate class="block w-full py-3 text-center text-sm font-medium text-white/55 border border-white/10 hover:border-white/25 hover:text-white transition-all">
                    Iniciar sesión
                </a>
                <a href="{{ route('register') }}" wire:navigate class="block w-full py-3 text-center text-sm font-semibold text-white bg-primary hover:bg-primary/90 transition-colors">
                    Comenzar gratis →
                </a>
            </div>
        </div>
    </div>
</header>
