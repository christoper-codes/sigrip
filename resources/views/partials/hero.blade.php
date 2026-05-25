{{-- ============================================================
     Hero — cinematic · iOS/Apple · NOM-035
     ============================================================ --}}
<section
    id="hero"
    class="relative min-h-screen overflow-hidden bg-[#FDFBFB]"
>
    {{-- ── Background video: sólo lado derecho (55 % del viewport) ─── --}}
    <video
        class="video-hero absolute right-0 top-0 h-full w-[55%] object-cover"
        src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260508_215831_c6a8989c-d716-4d8d-8745-e972a2eec711.mp4"
        autoplay
        loop
        muted
        playsinline
        aria-hidden="true"
    ></video>



    {{-- ── Foreground ──────────────────────────────────────────────── --}}
    <div class="relative z-10 flex min-h-screen flex-col">

        {{-- ── Navbar: centered, two-pill, iOS glass ─────────────────── --}}
        <nav
            class="flex items-center justify-center gap-2 px-4 pt-4 sm:gap-2.5 sm:px-8 sm:pt-6"
            aria-label="Navegación principal"
            >
            {{-- Logo circle --}}
            <div class="ios-glass flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-black/[0.07] sm:h-11 sm:w-11">
                {{-- SIGRIP mark: shield + pulse ring + checkmark --}}
                <svg
                    viewBox="0 0 32 32"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 sm:h-5.5 sm:w-5.5"
                    aria-label="SIGRIP"
                >
                    {{-- Shield body --}}
                    <path
                        d="M16 3L5 7.5V15c0 5.8 4.6 10.8 11 12.5C22.4 25.8 27 20.8 27 15V7.5L16 3Z"
                        fill="url(#sg-grad)"
                    />
                    {{-- Inner shield highlight --}}
                    <path
                        d="M16 5.5L7 9.4V15c0 4.6 3.6 8.5 9 10.2 5.4-1.7 9-5.6 9-10.2V9.4L16 5.5Z"
                        fill="white"
                        fill-opacity="0.15"
                    />
                    {{-- Checkmark --}}
                    <path
                        d="M11.5 15.8l3 3 6.5-6.5"
                        stroke="white"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <defs>
                        <linearGradient id="sg-grad" x1="16" y1="3" x2="16" y2="27.5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#0ea5e9"/>
                            <stop offset="1" stop-color="#2563eb"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            {{-- Links pill --}}
            <div class="ios-glass flex items-center gap-4 rounded-full border border-black/[0.07] px-5 py-2.5 sm:gap-8 sm:px-9 sm:py-3">
                @foreach ([
                    ['#howworks',     'Cómo funciona'],
                    ['#pricing',      'Precios'],
                    ['#testimonials', 'Testimonios'],
                    ['#faqs',         'FAQ'],
                ] as [$href, $label])
                <a
                    href="{{ $href }}"
                    class="text-[12px] font-medium text-gray-600 transition-colors duration-200 hover:text-gray-900 sm:text-[13.5px]"
                >{{ $label }}</a>
                @endforeach
            </div>
        </nav>

        {{-- ── Hero content: vertically centered · max-w-7xl ─────────── --}}
        <div class="flex flex-1 items-center">
            <div class="mx-auto w-full max-w-6xl px-6 lg:px-0">
                <div class="max-w-xl">

                    {{-- Badge — iOS notification pill --}}
                    <div class="ios-glass mb-5 inline-flex items-center gap-2 rounded-full border border-black/[0.07] px-3.5 py-1.5">
                        <span class="size-1.5 rounded-full bg-blue-500"></span>
                        <span class="text-[12.5px] font-medium text-blue-600">Plataforma NOM-035 · STPS México</span>
                    </div>

                    {{-- H1 --}}
                    <h1 class="mb-4 text-[1.75rem] font-semibold leading-[1.12] tracking-tight text-gray-900 sm:text-[2.2rem]">
                        Automatiza el cumplimiento normativo de tu empresa.
                    </h1>

                    {{-- Subtext --}}
                    <p class="mb-8 text-[15px] leading-relaxed text-gray-500">
                        Prevención de riesgos psicosociales, cuestionarios NOM-035 inteligentes y gestión de incidentes — todo en un solo lugar.
                    </p>

                    {{-- CTAs --}}
                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>
                            Comenzar gratis
                        </x-ui.btn-primary>

                        <x-ui.btn-secondary href="{{ route('login') }}" wire:navigate>
                            Iniciar sesión
                            <span class="inline-block text-gray-400 transition-transform duration-200 group-hover:translate-x-0.5">→</span>
                        </x-ui.btn-secondary>
                    </div>

                    <p class="mt-4 text-[12px] text-gray-400/80">
                        Sin tarjeta de crédito &middot; Cancela cuando quieras
                    </p>

                </div>
            </div>
        </div>{{-- /content --}}

    </div>{{-- /foreground --}}
</section>

<script>
(function () {
    var video = document.querySelector('.video-hero');
    if (!video) return;

    var FADE_INITIAL = 2;    /* s — first-load fade-in */
    var FADE_LOOP    = 1.5;  /* s — each leg of the loop crossfade */
    var fading = false;

    /* ── Initial fade-in ─────────────────────────────────────────
       CSS sets opacity:0. Two rAFs ensure the browser has painted
       the initial frame before we start the transition.           */
    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            video.style.transition = 'opacity ' + FADE_INITIAL + 's ease-out';
            video.style.opacity    = '1';
        });
    });

    /* ── Loop crossfade via timeupdate ───────────────────────────
       timeupdate fires ~4× per second — plenty for 1.5 s fades.  */
    video.addEventListener('timeupdate', function () {
        var dur = video.duration;
        if (!dur || !isFinite(dur)) return;

        var remaining = dur - video.currentTime;

        /* Last FADE_LOOP seconds → fade out */
        if (remaining <= FADE_LOOP && !fading) {
            fading = true;
            video.style.transition = 'opacity ' + FADE_LOOP + 's ease-in-out';
            video.style.opacity    = '0';
        }

        /* First FADE_LOOP seconds after restart → fade back in */
        if (video.currentTime <= FADE_LOOP && fading) {
            fading = false;
            video.style.transition = 'opacity ' + FADE_LOOP + 's ease-in-out';
            video.style.opacity    = '1';
        }
    });
})();
</script>
