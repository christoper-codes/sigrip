{{-- ============================================================
     Hero — cinematic · iOS/Apple style · NOM-035
     ============================================================ --}}
<section
    id="hero"
    class="relative min-h-screen overflow-hidden bg-[#f0f0ee]"
>
    {{-- Background video --}}
    <video
        class="absolute inset-0 h-full w-full object-cover"
        src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260508_215831_c6a8989c-d716-4d8d-8745-e972a2eec711.mp4"
        autoplay
        loop
        muted
        playsinline
        aria-hidden="true"
    ></video>

    {{-- Foreground --}}
    <div class="relative z-10 flex min-h-screen flex-col">

        {{-- ── Navbar (centered · two-pill · iOS rounded) ───────────── --}}
        <nav
            class="flex items-center justify-center gap-2 px-4 pt-4 sm:gap-2.5 sm:px-8 sm:pt-6"
            aria-label="Navegación principal"
        >
            {{-- Logo circle --}}
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full sm:h-11 sm:w-11"
                style="background-color: #EDEDED;"
            >
                <svg width="18" height="18" viewBox="0 0 256 256" fill="none" aria-hidden="true">
                    <path
                        fill="rgb(84, 84, 84)"
                        d="M 160 88 L 194 34 L 216 0 L 256 0 L 256 40 L 221.5 93.5 L 200 128 L 256 128 L 256 256 L 96 256 L 96 168 L 64.246 220 L 40 256 L 0 256 L 0 216 L 34 162 L 56 128 L 0 128 L 0 0 L 160 0 Z"
                    />
                </svg>
            </div>

            {{-- Links pill — rounded-full (iOS pill shape) --}}
            <div
                class="flex items-center gap-4 rounded-full px-5 py-2.5 sm:gap-8 sm:px-9 sm:py-3"
                style="background-color: #EDEDED;"
            >
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

        {{-- ── Hero content (vertically centered · left-padded) ───────── --}}
        <div class="flex flex-1 items-center px-6 sm:px-14 md:px-20 lg:px-28">
            <div class="max-w-sm">

                {{-- Badge — iOS notification pill --}}
                <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-blue-50/90 px-3.5 py-1.5 backdrop-blur-sm">
                    <span class="size-1.5 rounded-full bg-blue-500"></span>
                    <span class="text-[12.5px] font-medium text-blue-600">Plataforma NOM-035 · STPS México</span>
                </div>

                {{-- H1 — Apple semibold · tight tracking --}}
                <h1 class="mb-4 text-[1.75rem] font-semibold leading-[1.13] tracking-tight text-gray-900 sm:text-[2.2rem]">
                    Automatiza el cumplimiento normativo de tu empresa.
                </h1>

                {{-- Subtext --}}
                <p class="mb-8 text-[15px] leading-relaxed text-gray-500">
                    Prevención de riesgos psicosociales, cuestionarios NOM-035 inteligentes y gestión de incidentes — todo en un solo lugar.
                </p>

                {{-- CTAs — iOS button pair --}}
                <div class="flex flex-wrap items-center gap-3">

                    {{-- Primary: Apple dark solid pill --}}
                    <a
                        href="{{ route('register') }}"
                        wire:navigate
                        class="inline-flex items-center rounded-full bg-[#1d1d1f] px-7 py-3.5 text-[15px] font-medium text-white transition-all duration-200 hover:bg-[#3a3a3c] active:scale-[0.97]"
                    >
                        Comenzar gratis
                    </a>

                    {{-- Secondary: ghost pill · iOS frosted border --}}
                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        class="group inline-flex items-center gap-1.5 rounded-full border border-gray-300/80 bg-white/55 px-7 py-3.5 text-[15px] font-medium text-gray-800 backdrop-blur-sm transition-all duration-200 hover:border-gray-400 hover:bg-white/80 active:scale-[0.97]"
                    >
                        Iniciar sesión
                        <span class="inline-block text-gray-400 transition-transform duration-200 group-hover:translate-x-0.5">→</span>
                    </a>

                </div>

                {{-- Fine print --}}
                <p class="mt-4 text-[12px] text-gray-400/80">
                    Sin tarjeta de crédito &middot; Cancela cuando quieras
                </p>

            </div>
        </div>{{-- /content --}}

    </div>{{-- /foreground --}}
</section>
