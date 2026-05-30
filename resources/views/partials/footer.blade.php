{{-- ============================================================
     Footer — minimal · Apple / iOS · NOM-035
     ============================================================ --}}
<footer
    x-data
    :class="$store.appearance.dark ? 'bg-[#050505] border-zinc-800' : 'bg-zinc-50 border-zinc-200'"
    class="border-t transition-colors duration-300"
>
    <div
        class="max-w-7xl mx-auto border-x"
        :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
    >

        {{-- Main row --}}
        <div
            class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-8 px-8 sm:px-10 lg:px-16 py-10 border-b"
            :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
        >
            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <svg viewBox="0 0 32 32" fill="none" class="w-5 h-5 shrink-0">
                        <path d="M16 3L5 7.5V15c0 5.8 4.6 10.8 11 12.5C22.4 25.8 27 20.8 27 15V7.5L16 3Z" fill="url(#ft-g)"/>
                        <path d="M11.5 15.8l3 3 6.5-6.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <linearGradient id="ft-g" x1="16" y1="3" x2="16" y2="27.5" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#0ea5e9"/><stop offset="1" stop-color="#2563eb"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'" class="text-sm font-extrabold tracking-widest uppercase">SIGRIP</span>
                </div>
                <p class="text-xs leading-relaxed max-w-xs" :class="$store.appearance.dark ? 'text-zinc-600' : 'text-zinc-400'">
                    Plataforma NOM-035 · STPS México.<br>Bienestar laboral, automatizado.
                </p>
            </div>

            {{-- Links --}}
            <nav class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-8">
                @foreach ([
                    ['#howworks',                  'Cómo funciona'],
                    ['#pricing',                   'Precios'],
                    [route('terms.use'),           'Términos'],
                    [route('privacy.policy'),      'Privacidad'],
                    ['mailto:soporte@sigrip.com',  'Contacto'],
                ] as [$href, $label])
                <a
                    href="{{ $href }}"
                    :class="$store.appearance.dark ? 'text-zinc-500 hover:text-zinc-200' : 'text-zinc-400 hover:text-zinc-800'"
                    class="text-xs font-medium transition-colors duration-200"
                >{{ $label }}</a>
                @endforeach
            </nav>
        </div>

        {{-- Bottom bar --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-between gap-3 px-8 sm:px-10 lg:px-16 py-5"
        >
            <p class="text-[11px]" :class="$store.appearance.dark ? 'text-zinc-700' : 'text-zinc-400'">
                &copy; {{ date('Y') }} SIGRIP. Todos los derechos reservados.
            </p>

            <div class="flex items-center gap-4">
                {{-- Social --}}
                <div class="flex items-center gap-3">
                    <a href="#" aria-label="LinkedIn" :class="$store.appearance.dark ? 'text-zinc-700 hover:text-zinc-400' : 'text-zinc-300 hover:text-zinc-600'" class="transition-colors duration-200">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="X / Twitter" :class="$store.appearance.dark ? 'text-zinc-700 hover:text-zinc-400' : 'text-zinc-300 hover:text-zinc-600'" class="transition-colors duration-200">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.254 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                        </svg>
                    </a>
                </div>

                {{-- Status --}}
                <div class="flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-[10px] uppercase tracking-widest" :class="$store.appearance.dark ? 'text-zinc-700' : 'text-zinc-400'">Todos los sistemas operativos</span>
                </div>
            </div>
        </div>

    </div>
</footer>
