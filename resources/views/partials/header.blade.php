<div>
    <header class="absolute top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
            <span class="text-2xl sm:text-[27px] font-normal tracking-tight leading-[1.08] animate-blur-fade-up select-none text-dark dark:text-dark">
                Sigrip
            </span>

            <div class="hidden md:flex items-center gap-5">
                <button
                    x-data
                    x-on:click="$flux.dark = !$flux.dark"
                    class="liquid-glass-light w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                    aria-label="Cambiar tema"
                >
                    <svg x-show="$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <svg x-show="!$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

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
                class="md:hidden relative w-6 h-4 flex flex-col justify-between z-60"
                @click="mobileMenuOpen = !mobileMenuOpen"
                aria-label="Abrir menú"
            >
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="['bg-black', mobileMenuOpen ? 'rotate-45 translate-y-1.75' : '']"
                ></span>
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="['bg-black', mobileMenuOpen ? 'opacity-0' : '']"
                ></span>
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="['bg-black', mobileMenuOpen ? '-rotate-45 -translate-y-1.75' : '']"
                ></span>
            </button>
        </div>
    </header>
</div>
