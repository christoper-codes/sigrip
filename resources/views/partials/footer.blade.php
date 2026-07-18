<footer class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-between">
    <div class="flex items-center gap-2 animate-blur-fade-up">
            <button
            x-data
            x-on:click="$flux.dark = !$flux.dark"
            class="liquid-glass-light w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
            aria-label="Cambiar tema"
        >
            <svg x-show="$flux.dark" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
            </svg>
            <svg x-show="!$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>
        <span class="font-light text-sm tracking-[0.2em] uppercase select-none text-dark dark:text-light">
            Sigrip
        </span>
    </div>
</footer>
