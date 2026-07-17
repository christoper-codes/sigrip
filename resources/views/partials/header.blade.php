{{-- ============================================================
     Header — SIGRIP · NOM-035
     Fixed-feel top nav · animated mobile hamburger + overlay
     Dark mode synced to flux.appearance in localStorage
     ============================================================ --}}

{{-- Alpine store: shared appearance state (read by all partials) --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('appearance', {
        dark: localStorage.getItem('flux.appearance') === 'dark',
        toggle() {
            this.dark = !this.dark;
            localStorage.setItem('flux.appearance', this.dark ? 'dark' : 'light');
        }
    });
});

function siteHeader() {
    return {
        mobileMenuOpen: false,
    };
}
</script>

<div
    x-data="siteHeader()"
    :class="$store.appearance.dark ? 'bg-[#050505] text-white' : 'bg-white text-zinc-950'"
    class="relative z-50 transition-colors duration-300"
>
    <div
        class="max-w-7xl mx-auto border-x"
        :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
    >
        <header
            class="px-6 lg:px-12 py-4 flex items-center justify-between border-b relative z-40"
            :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
            aria-label="Navegación"
        >
            {{-- Logo --}}
            <div class="flex items-center gap-2.5 select-none">
                <svg viewBox="0 0 32 32" fill="none" class="w-7 h-7 shrink-0">
                    <path d="M16 3L5 7.5V15c0 5.8 4.6 10.8 11 12.5C22.4 25.8 27 20.8 27 15V7.5L16 3Z" fill="url(#sh-nav)"/>
                    <path d="M16 5.5L7 9.4V15c0 4.6 3.6 8.5 9 10.2 5.4-1.7 9-5.6 9-10.2V9.4L16 5.5Z" fill="white" fill-opacity="0.12"/>
                    <path d="M11.5 15.8l3 3 6.5-6.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <defs>
                        <linearGradient id="sh-nav" x1="16" y1="3" x2="16" y2="27.5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#0ea5e9"/><stop offset="1" stop-color="#2563eb"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'" class="font-extrabold tracking-widest text-sm uppercase">SIGRIP</span>
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Theme toggle --}}
                <button
                    @click="$store.appearance.toggle()"
                    :class="$store.appearance.dark
                        ? 'border-white/10 text-zinc-400 hover:text-white hover:border-white/20'
                        : 'border-zinc-200 text-zinc-400 hover:text-zinc-700 hover:border-zinc-300'"
                    class="w-8 h-8 rounded-full border flex items-center justify-center transition-all duration-200"
                    aria-label="Cambiar tema"
                >
                    <svg x-show="$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <svg x-show="!$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                {{-- Desktop: Iniciar sesión --}}
                <a
                    href="{{ route('login') }}" wire:navigate
                    :class="$store.appearance.dark ? 'text-zinc-400 hover:text-white' : 'text-zinc-500 hover:text-zinc-900'"
                    class="hidden sm:block text-sm font-medium transition-colors duration-200 px-1"
                >Iniciar sesión</a>

                {{-- Comenzar gratis --}}
                <a
                    href="{{ route('register') }}" wire:navigate
                    :class="$store.appearance.dark
                        ? 'bg-white text-black hover:bg-zinc-100'
                        : 'bg-zinc-950 text-white hover:bg-zinc-800'"
                    class="px-4 py-2 rounded-lg text-xs font-bold tracking-wide transition-all duration-200 active:scale-95"
                >Comenzar gratis</a>

                {{-- Mobile hamburger --}}
                <button
                    class="sm:hidden relative w-6 h-4 flex flex-col justify-between"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    aria-label="Abrir menú"
                >
                    <span
                        class="w-6 h-0.5 transition-all duration-300"
                        :class="[$store.appearance.dark ? 'bg-white' : 'bg-zinc-950', mobileMenuOpen ? 'rotate-45 translate-y-1.75' : '']"
                    ></span>
                    <span
                        class="w-6 h-0.5 transition-all duration-300"
                        :class="[$store.appearance.dark ? 'bg-white' : 'bg-zinc-950', mobileMenuOpen ? 'opacity-0' : '']"
                    ></span>
                    <span
                        class="w-6 h-0.5 transition-all duration-300"
                        :class="[$store.appearance.dark ? 'bg-white' : 'bg-zinc-950', mobileMenuOpen ? '-rotate-45 -translate-y-1.75' : '']"
                    ></span>
                </button>
            </div>
        </header>
    </div>

    {{-- Mobile nav overlay --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        :class="$store.appearance.dark ? 'bg-[#050505]/98' : 'bg-white/98'"
        class="sm:hidden fixed inset-0 z-50 backdrop-blur-xl pt-20 px-6"
    >
        <div class="flex flex-col gap-3 mt-4">
            <a
                href="{{ route('login') }}" wire:navigate
                :class="$store.appearance.dark ? 'border-white/10 text-zinc-300' : 'border-zinc-200 text-zinc-700'"
                class="py-4 text-center border rounded-xl text-sm font-semibold"
                @click="mobileMenuOpen = false"
            >Iniciar sesión</a>
            <a
                href="{{ route('register') }}" wire:navigate
                :class="$store.appearance.dark ? 'bg-white text-black' : 'bg-zinc-950 text-white'"
                class="py-4 text-center rounded-xl text-sm font-extrabold"
                @click="mobileMenuOpen = false"
            >Comenzar gratis</a>
        </div>
    </div>
</div>
