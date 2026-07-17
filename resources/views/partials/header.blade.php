{{-- ============================================================
     Header — SIGRIP · NOM-035
     Apple/iOS style: frosted blurred bar, text-only wordmark,
     rounded-full pill CTA.
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

    {{-- Frosted navbar --}}
    <header
        class="fixed top-0 inset-x-0 z-50 border-b transition-colors duration-300"
        :class="$store.appearance.dark ? 'ios-glass-dark border-white/8' : 'ios-glass border-black/6'"
    >
        <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
            {{-- Wordmark --}}
            <span
                class="font-['Space_Grotesk'] text-2xl sm:text-[27px] font-bold tracking-tight select-none"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >SIGRIP</span>

            {{-- Desktop actions --}}
            <div class="hidden md:flex items-center gap-5">
                <button
                    @click="$store.appearance.toggle()"
                    class="w-9 h-9 rounded-full border flex items-center justify-center transition-all duration-200"
                    :class="$store.appearance.dark
                        ? 'border-white/15 text-white hover:bg-white/5'
                        : 'border-black/10 text-black hover:bg-black/5'"
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
                    class="text-[15px] font-medium hover:opacity-60 transition-opacity"
                    :class="$store.appearance.dark ? 'text-white' : 'text-black'"
                >Iniciar sesión</a>

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

    {{-- Mobile Navigation Overlay --}}
    <div
        class="fixed inset-0 z-40 backdrop-blur-2xl transition-opacity duration-300 md:hidden flex flex-col items-center justify-center gap-4"
        :class="[
            $store.appearance.dark ? 'bg-black/80' : 'bg-white/80',
            mobileMenuOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        ]"
    >
        <x-ui.btn-secondary href="{{ route('login') }}" wire:navigate class="text-base! px-8! py-4! w-64 justify-center" @click="mobileMenuOpen = false">
            Iniciar sesión
        </x-ui.btn-secondary>
        <x-ui.btn-primary href="{{ route('register') }}" wire:navigate class="text-base! px-8! py-4! w-64 justify-center" @click="mobileMenuOpen = false">
            Comenzar gratis
        </x-ui.btn-primary>
    </div>
</div>
