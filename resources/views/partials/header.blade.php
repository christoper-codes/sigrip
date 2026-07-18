<div>
    <header class="fixed top-0 inset-x-0 z-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
            <span class="text-2xl sm:text-[27px] font-normal tracking-tight leading-[1.08] animate-blur-fade-up select-none text-dark dark:text-dark">
                Sigrip
            </span>

            <div class="hidden md:flex items-center gap-5">
                <flux:switch x-data x-model="$flux.dark" />

                <a
                    href="{{ route('login') }}" wire:navigate
                    class="liquid-glass rounded-full w-fit animate-blur-fade-up block"
                    style="animation-delay: 560ms;"
                    >
                        <span class="block font-light text-[0.7rem] tracking-[0.2em] uppercase text-white px-8 py-3.5 select-none">
                            Iniciar sesión
                        </span>
                </a>

                <x-ui.btn-primary href="{{ route('register') }}" wire:navigate class="px-6! py-2.5! text-[14px]!">
                    Comenzar gratis
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
