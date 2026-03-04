<header
    x-data="{ scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'backdrop-blur-xl' : 'bg-transparent'"
    class="w-full mx-auto max-w-6xl z-30 flex items-center justify-between px-4 py-5 lg:py-7 lg:px-0 fixed top-0 left-0 right-0 transition-all duration-300"
>    <div class="flex items-center gap-2">
       <x-app-logo-icon />
    </div>

    <nav class="flex items-center gap-2">
        <a href="{{ route('register') }}" wire:navigate class="rounded-none border border-white/20 bg-white/5 px-5 py-2 text-xs font-medium tracking-wide text-white/80 backdrop-blur-sm transition-all duration-200 hover:border-white/40 hover:bg-white/10 hover:text-white">
            Comenzar →
        </a>
    </nav>
</header>
