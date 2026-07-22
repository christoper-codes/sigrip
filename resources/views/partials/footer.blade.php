{{-- ============================================================
     Footer — SIGRIP · NOM-035
     Video card + nav columns + newsletter, with a big watermark
     wordmark sized to fit via Alpine (no plain <script>).
     ============================================================ --}}

<footer class="w-full py-12 sm:py-16 px-4 sm:px-6">
    <div class="max-w-[1150px] mx-auto grid grid-cols-1 md:grid-cols-[350px_1fr] gap-4 items-stretch relative z-10">

        {{-- Left card: looped video, nothing overlaid on top --}}
        <div class="relative min-h-150 rounded-[28px] overflow-hidden shadow-[0_12px_40px_rgba(21,76,189,0.25)] bg-[#1e4fc0]">
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
        <div class="relative bg-[#f0f1f5] dark:bg-zinc-900 rounded-[28px] p-6 sm:p-10 shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex flex-col justify-between">

            {{-- Playful "verified" graphic --}}
            <div class="absolute -top-9 right-6 sm:right-10 z-10 flex flex-col items-start gap-1.5">
                <div class="w-18 h-18 sm:w-24 sm:h-24 rounded-[22px] -rotate-12 bg-gradient-to-br from-[#5b9ffb] via-[#1e5dd7] to-[#1448be] shadow-[inset_3px_3px_8px_rgba(255,255,255,0.35),inset_-3px_-3px_12px_rgba(0,0,0,0.18),8px_14px_28px_rgba(20,72,200,0.35)] flex items-center justify-center">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white rotate-12" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="filter: drop-shadow(0 3px 6px rgba(0,0,0,0.25));">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                    </svg>
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
                    <div class="font-['Caveat'] italic text-2xl font-semibold text-gray-400 mb-4.5">Navegación</div>
                    <a href="#servicios" class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Servicios</a>
                    <a href="#como-funciona" class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Cómo funciona</a>
                    <a href="{{ route('register') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Comenzar gratis</a>
                </div>
                <div>
                    <div class="font-['Caveat'] italic text-2xl font-semibold text-gray-400 mb-4.5">Empresa</div>
                    <a href="{{ route('terms.use') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Términos de uso</a>
                    <a href="{{ route('privacy.policy') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Aviso de privacidad</a>
                    <a href="{{ route('login') }}" wire:navigate class="block text-sm font-semibold text-gray-900 dark:text-white mb-3.5 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">Iniciar sesión</a>
                </div>
            </div>

            {{-- Bottom: copyright + newsletter --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 mt-12">
                <div class="text-[12.5px] font-medium text-gray-400">
                    © {{ date('Y') }} SIGRIP. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </div>

    {{-- Watermark wordmark, auto-fit to its own bounding box via Alpine --}}
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
        class="max-w-[1150px] mx-auto -mt-15 relative z-0 pointer-events-none select-none leading-none"
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
