<div>
    <header class="absolute top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
            <span class="text-2xl sm:text-[27px] font-normal tracking-tight leading-[1.08] animate-blur-fade-up select-none text-dark dark:text-dark">
                Sigrip
            </span>

            <div class="hidden md:flex items-center gap-5">
                <a
                    href="{{ route('login') }}" wire:navigate
                    class="text-dark dark:text-dark font-light text-[0.7rem] tracking-[0.2em] uppercase"
                    >
                    Iniciar sesión
                </a>

                <a
                    href="{{ route('login') }}" wire:navigate
                    class="text-light dark:text-light py-3 px-8 rounded-full bg-dark font-light text-[0.7rem] tracking-[0.2em] uppercase"
                    >
                    Comenzar
                </a>
            </div>

            {{-- Mobile Hamburger Button --}}
            <button
                class="md:hidden relative w-6 h-4 flex flex-col justify-between z-60"
                @click="mobileMenuOpen = !mobileMenuOpen"
                aria-label="Abrir menú"
            >
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="[$store.appearance.dark ? 'bg-white' : 'bg-black', mobileMenuOpen ? 'rotate-45 translate-y-1.75' : '']"
                ></span>
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="[$store.appearance.dark ? 'bg-white' : 'bg-black', mobileMenuOpen ? 'opacity-0' : '']"
                ></span>
                <span
                    class="w-6 h-0.5 transition-all duration-300"
                    :class="[$store.appearance.dark ? 'bg-white' : 'bg-black', mobileMenuOpen ? '-rotate-45 -translate-y-1.75' : '']"
                ></span>
            </button>
        </div>
    </header>
</div>
