<div x-data="{ mobileMenuOpen: false }">
    <header class="absolute top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 animate-blur-fade-up">
                 <button
                    x-data
                    x-on:click="$flux.dark = !$flux.dark"
                    class="liquid-glass-fixed w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                    aria-label="Cambiar tema"
                >
                    <svg x-show="$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <svg x-show="!$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
                <span class="font-light text-sm tracking-[0.2em] uppercase select-none text-dark dark:text-dark">
                    Sigrip
                </span>
            </div>

            <nav class="animate-blur-fade-up hidden md:flex items-center gap-5 text-dark dark:text-dark font-light text-[0.7rem] tracking-[0.2em] uppercase">
                <a href="#servicios">Servicios</a>
                <a href="#como-funciona">Como funciona</a>
            </nav>

            <div class="animate-blur-fade-up hidden md:flex items-center gap-5">
                <a
                    href="{{ route('login') }}" wire:navigate
                    class="text-dark dark:text-dark font-light text-[0.7rem] tracking-[0.2em] uppercase"
                    >
                    Iniciar sesión
                </a>

                <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>
                    Comenzar
                </x-ui.btn-primary>
            </div>

            {{-- Mobile Hamburger Button --}}
            <button
                class="liquid-glass-fixed md:hidden relative w-9 h-9 rounded-full flex items-center justify-center z-60 select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                @click="mobileMenuOpen = !mobileMenuOpen"
                :aria-expanded="mobileMenuOpen.toString()"
                aria-label="Abrir menú"
            >
                <span class="relative w-4 h-3.5 flex flex-col justify-between">
                    <span
                        class="w-full h-0.5 rounded-full bg-black transition-all duration-300 origin-center"
                        :class="mobileMenuOpen ? 'rotate-45 translate-y-1.75' : ''"
                    ></span>
                    <span
                        class="w-full h-0.5 rounded-full bg-black transition-all duration-300"
                        :class="mobileMenuOpen ? 'opacity-0 scale-0' : ''"
                    ></span>
                    <span
                        class="w-full h-0.5 rounded-full bg-black transition-all duration-300 origin-center"
                        :class="mobileMenuOpen ? '-rotate-45 -translate-y-1.75' : ''"
                    ></span>
                </span>
            </button>
        </div>
    </header>

    {{-- Mobile navigation overlay --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="mobileMenuOpen = false"
        @keydown.escape.window="mobileMenuOpen = false"
        class="md:hidden fixed inset-0 z-50 backdrop-blur-2xl bg-white/85 dark:bg-black/85 flex flex-col items-center justify-center gap-10"
    >
        <nav class="flex flex-col items-center gap-6 text-dark dark:text-light font-light text-2xl tracking-widest uppercase">
            <a href="#servicios" @click="mobileMenuOpen = false">Servicios</a>
            <a href="#como-funciona" @click="mobileMenuOpen = false">Como funciona</a>
        </nav>

        <div class="flex flex-col items-center gap-5">
            <a
                href="{{ route('login') }}" wire:navigate
                class="text-dark dark:text-light font-light text-sm tracking-[0.2em] uppercase"
                @click="mobileMenuOpen = false"
            >
                Iniciar sesión
            </a>

            <x-ui.btn-primary href="{{ route('register') }}" wire:navigate :adaptive="true" @click="mobileMenuOpen = false">
                Comenzar
            </x-ui.btn-primary>
        </div>
    </div>
</div>
