{{-- ============================================================
     Footer — SIGRIP · NOM-035
     Video card + nav columns + newsletter, with a big watermark
     wordmark sized to fit via Alpine (no plain <script>).
     ============================================================ --}}

<footer class="w-full pt-12 sm:pt-16 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-[350px_1fr] gap-4 items-stretch relative z-10">

        {{-- Left card: looped video, nothing overlaid on top --}}
        <div class="relative min-h-[400px] rounded-[28px] overflow-hidden">
            <video
                class="absolute inset-0 w-full h-full object-cover pointer-events-none"
                src="{{ asset('videos/footer.mp4') }}"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
            ></video>
        </div>

        {{-- Right card --}}
        <div class="relative bg-light-variant dark:bg-dark-variant rounded-[28px] p-6 sm:p-10 shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex flex-col justify-between">

            {{-- Playful "verified" graphic --}}
            <div class="absolute -top-9 right-6 sm:right-10 z-10 flex flex-col items-start gap-1.5">
                <div class="w-18 h-18 sm:w-24 sm:h-24 bg-light-variant dark:bg-dark-variant rounded-[22px] -rotate-12 shadow-[inset_2px_2px_6px_rgba(255,255,255,0.7),inset_-2px_-2px_8px_rgba(0,0,0,0.10),0_8px_20px_rgba(0,0,0,0.10)] dark:shadow-[inset_3px_3px_8px_rgba(255,255,255,0.35),inset_-3px_-3px_12px_rgba(0,0,0,0),8px_14px_28px_rgba(0,0,0,0)] flex items-center justify-center">
                    <button
                        x-data
                        x-on:click="$flux.dark = !$flux.dark"
                        class="w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                        :class="$flux.dark ? 'liquid-glass' : 'liquid-glass-light'"
                        aria-label="Cambiar tema"
                    >
                        <svg x-show="$flux.dark" class="w-3.5 h-3.5" :class="$flux.dark ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                        </svg>
                        <svg x-show="!$flux.dark" class="w-3.5 h-3.5" :class="$flux.dark ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-1.5 -rotate-4 mt-1">
                    <svg class="w-5.5 h-5.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 20 C 6 14, 10 9, 18 5"/>
                        <path d="M18 5 L 12 5"/>
                        <path d="M18 5 L 18 11"/>
                    </svg>
                    <span class="font-['Caveat'] text-xl font-semibold text-gray-400 whitespace-nowrap">100% NOM-035</span>
                </div>
            </div>

            {{-- Nav columns --}}
            <div class="flex flex-row gap-12 sm:gap-18 pt-2">
                <div>
                    <div class="font-light text-[0.7rem] tracking-[0.2em] uppercase text-gray-400 mb-4.5">Navegación</div>
                    <a href="#servicios" class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Servicios</a>
                    <a href="#como-funciona" class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Cómo funciona</a>
                    <a href="{{ route('register') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Comenzar gratis</a>
                </div>
                <div>
                    <div class="font-light text-[0.7rem] tracking-[0.2em] uppercase text-gray-400 mb-4.5">Empresa</div>
                    <a href="{{ route('terms.use') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Términos de uso</a>
                    <a href="{{ route('privacy.policy') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Aviso de privacidad</a>
                    <a href="{{ route('login') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 transition-colors duration-200">Iniciar sesión</a>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 mt-12">
                <div class="text-[12.5px] font-medium text-gray-400">
                    © {{ date('Y') }} SIGRIP. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </div>

    <div
        x-data
        x-init="
            const fit = () => {
                try {
                    const box = $refs.watermarkText.getBBox();
                    $refs.watermarkSvg.setAttribute('viewBox', `${box.x} ${box.y} ${box.width} ${box.height}`);
                } catch (e) {}
            };
            (document.fonts && document.fonts.ready) ? document.fonts.ready.then(fit) : fit();
            window.addEventListener('resize', fit);
        "
        class="max-w-7xl max-h-[430px] overflow-hidden mx-auto -mt-15 relative z-0 pointer-events-none select-none leading-none"
        aria-hidden="true"
    >
        <svg x-ref="watermarkSvg" viewBox="0 0 900 175" preserveAspectRatio="xMidYMid meet" class="block w-full h-auto overflow-visible">
            <text
                x-ref="watermarkText"
                x="500" y="240"
                text-anchor="middle"
                font-size="320"
                class="font-bold tracking-tighter fill-black/4 dark:fill-white/5"
            >SIGRIP</text>
        </svg>
    </div>
</footer>
