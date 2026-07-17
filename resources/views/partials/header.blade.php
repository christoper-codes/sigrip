{{-- ============================================================
     Header — SIGRIP · NOM-035
     Fixed transparent navbar over the hero video, exact structure
     from the Mainframe reference design (logo left, actions right,
     animated mobile hamburger + fullscreen overlay).
     Dark mode synced to flux.appearance in localStorage.
     ============================================================ --}}

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

<div x-data="siteHeader()">

    {{-- Interactive Navbar --}}
    <header class="fixed top-0 inset-x-0 z-50 px-5 sm:px-8 py-4 sm:py-5 flex flex-row justify-between items-center bg-transparent">
        {{-- Logo --}}
        <div class="flex flex-row gap-2.5 items-center select-none">
            <svg viewBox="0 0 32 32" fill="none" class="w-7 h-7 sm:w-8 sm:h-8 shrink-0">
                <path d="M16 3L5 7.5V15c0 5.8 4.6 10.8 11 12.5C22.4 25.8 27 20.8 27 15V7.5L16 3Z" fill="url(#sh-nav)"/>
                <path d="M16 5.5L7 9.4V15c0 4.6 3.6 8.5 9 10.2 5.4-1.7 9-5.6 9-10.2V9.4L16 5.5Z" fill="white" fill-opacity="0.12"/>
                <path d="M11.5 15.8l3 3 6.5-6.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                    <linearGradient id="sh-nav" x1="16" y1="3" x2="16" y2="27.5" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0ea5e9"/><stop offset="1" stop-color="#2563eb"/>
                    </linearGradient>
                </defs>
            </svg>
            <span
                class="text-[21px] sm:text-[26px] tracking-tight font-medium select-none"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >SIGRIP</span>
        </div>

        {{-- Desktop actions --}}
        <div class="hidden md:flex flex-row items-center gap-6">
            {{-- Theme toggle --}}
            <button
                @click="$store.appearance.toggle()"
                class="w-8 h-8 rounded-full border flex items-center justify-center transition-all duration-200"
                :class="$store.appearance.dark
                    ? 'border-white/20 text-white hover:opacity-60'
                    : 'border-black/15 text-black hover:opacity-60'"
                aria-label="Cambiar tema"
            >
                <svg x-show="$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg x-show="!$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            <a
                href="{{ route('login') }}" wire:navigate
                class="text-[19px] hover:opacity-60 transition-opacity"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >Iniciar sesión</a>

            <a
                href="{{ route('register') }}" wire:navigate
                class="text-[19px] underline underline-offset-2 hover:opacity-60 transition-opacity"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >Comenzar gratis</a>
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
    </header>

    {{-- Mobile Navigation Overlay --}}
    <div
        class="fixed inset-0 z-40 backdrop-blur-sm transition-opacity duration-300 md:hidden flex flex-col items-center justify-center gap-8"
        :class="[
            $store.appearance.dark ? 'bg-black/95' : 'bg-white/95',
            mobileMenuOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        ]"
    >
        <a
            href="{{ route('login') }}" wire:navigate
            class="text-4xl font-medium hover:opacity-60 transition-opacity"
            :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            @click="mobileMenuOpen = false"
        >Iniciar sesión</a>
        <a
            href="{{ route('register') }}" wire:navigate
            class="mt-4 text-2xl font-medium underline underline-offset-4"
            :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            @click="mobileMenuOpen = false"
        >Comenzar gratis</a>
    </div>
</div>
