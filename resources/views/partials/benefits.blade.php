{{-- ============================================================
     Benefits — SIGRIP · NOM-035
     Side cards: title top / body centered / footer label at the bottom.
     Middle card: video (top-anchored crop) with just its big title.
     Adaptive to the site's dark mode using light-variant/dark-variant.
     ============================================================ --}}

<section class="w-full py-24 sm:py-32">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">

        <div class="max-w-2xl mb-16 animate-blur-fade-up">
            <span class="block text-dark dark:text-light font-light text-[0.7rem] tracking-[0.2em] uppercase mb-4">
                Beneficios
            </span>
            <h2 class="text-dark dark:text-light text-4xl sm:text-5xl font-normal tracking-tight leading-[1.08]">
                Menos riesgo, más control.
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">

            {{-- Card 1: title top / body centered / footer bottom --}}
            <div class="relative h-95 sm:h-115 rounded-2xl bg-light-variant dark:bg-dark-variant overflow-hidden p-6 sm:p-8">
                <div class="relative z-10 flex flex-col h-full">
                    <h3 class="text-dark dark:text-light text-xl sm:text-2xl font-light leading-tight tracking-tight">
                        Detección temprana<br>de riesgos
                    </h3>

                    <div class="flex-1 flex items-center">
                        <p class="text-sm leading-relaxed text-dark/70 dark:text-light/70 font-light">
                            La plataforma monitorea respuestas, patrones de comportamiento y señales de alerta para identificar riesgos psicosociales antes de que escalen. La IA prioriza los casos que requieren atención inmediata.
                        </p>
                    </div>

                    <p class="text-[11px] font-medium uppercase tracking-[0.15em] text-dark/45 dark:text-light/45">
                        Análisis continuo · 24/7
                    </p>
                </div>
            </div>

            {{-- Card 2: video, top-anchored crop, title only --}}
            <div class="relative h-95 sm:h-115 rounded-2xl bg-light-variant dark:bg-dark-variant overflow-hidden flex flex-col">
                <div class="relative w-full h-3/4 overflow-hidden">
                    <video
                        class="w-full h-full object-cover object-top block"
                        src="{{ asset('videos/benefits.mp4') }}"
                        autoplay
                        muted
                        loop
                        playsinline
                        preload="auto"
                    ></video>
                    <div class="pointer-events-none absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-b from-transparent to-light-variant dark:to-dark-variant"></div>
                </div>

                <div class="flex-1 flex items-center justify-start p-6 sm:p-8">
                    <h3 class="text-dark dark:text-light text-xl sm:text-2xl font-light leading-tight tracking-tight text-left">
                        Conocimiento normativo<br>y experiencia sectorial
                    </h3>
                </div>
            </div>

            {{-- Card 3: title top / body centered / footer bottom --}}
            <div class="relative h-95 sm:h-115 rounded-2xl bg-light-variant dark:bg-dark-variant overflow-hidden p-6 sm:p-8">
                <div class="relative z-10 flex flex-col h-full">
                    <h3 class="text-dark dark:text-light text-xl sm:text-2xl font-light leading-tight tracking-tight">
                        Cumplimiento<br>verificable
                    </h3>

                    <div class="flex-1 flex items-center">
                        <p class="text-sm leading-relaxed text-dark/70 dark:text-light/70 font-light">
                            Cada cuestionario, alerta y reporte queda documentado — evidencia lista para auditorías de la STPS en cualquier momento. Exporta el expediente completo en un clic.
                        </p>
                    </div>

                    <p class="text-[11px] font-medium uppercase tracking-[0.15em] text-dark/45 dark:text-light/45">
                        NOM-035 · STPS 2018
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
