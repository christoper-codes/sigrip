<section id="howworks" class="relative py-24 lg:py-32"
    x-data="{ activeFeature: 0 }"
    x-intersect.once="$el.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => el.classList.add('visible'))"
>
    <x-main-container>
        <!-- Header -->
        <div class="reveal mx-auto mb-14 max-w-xl text-center">
            <span class="mb-3 inline-block text-[10px] font-semibold uppercase tracking-[0.25em] text-primary">{{ __('Plataforma') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">
                {{ __('Cómo funciona') }}
            </h2>
            <p class="mx-auto mt-5 max-w-lg text-[15px] leading-relaxed text-muted-foreground" style="text-wrap:pretty">
                {{ __('IA que transforma la gestión del bienestar laboral, previene riesgos psicosociales y automatiza el cumplimiento normativo.') }}
            </p>
        </div>

        <!-- 3-step process strip -->
        <div class="reveal mb-16 grid grid-cols-1 md:grid-cols-3 gap-0 border border-border/60 bg-card/30">
            <div class="flex items-start gap-4 p-7 md:border-r border-border/60">
                <span class="shrink-0 flex h-9 w-9 items-center justify-center rounded-full border border-primary/20 bg-primary/5 text-[13px] font-bold text-primary">1</span>
                <div>
                    <p class="text-sm font-semibold text-foreground">{{ __('Configura tu empresa') }}</p>
                    <p class="mt-1 text-[13px] leading-relaxed text-muted-foreground">{{ __('Carga empleados y departamentos en minutos') }}</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-7 md:border-r border-border/60 border-t md:border-t-0">
                <span class="shrink-0 flex h-9 w-9 items-center justify-center rounded-full border border-primary/20 bg-primary/5 text-[13px] font-bold text-primary">2</span>
                <div>
                    <p class="text-sm font-semibold text-foreground">{{ __('Aplica cuestionarios') }}</p>
                    <p class="mt-1 text-[13px] leading-relaxed text-muted-foreground">{{ __('NOM-035 y cuestionarios personalizados') }}</p>
                </div>
            </div>
            <div class="flex items-start gap-4 p-7 border-t md:border-t-0">
                <span class="shrink-0 flex h-9 w-9 items-center justify-center rounded-full border border-primary/20 bg-primary/5 text-[13px] font-bold text-primary">3</span>
                <div>
                    <p class="text-sm font-semibold text-foreground">{{ __('Recibe insights de IA') }}</p>
                    <p class="mt-1 text-[13px] leading-relaxed text-muted-foreground">{{ __('Alertas, predicciones y reportes automáticos') }}</p>
                </div>
            </div>
        </div>

        <!-- Features tabs -->
        <div class="flex flex-col lg:flex-row items-stretch justify-center gap-6 lg:gap-10">
            <!-- Tab list -->
            <div class="reveal-left flex flex-col gap-1 w-full lg:w-2/5">
                @php
                $features = [
                    [0, '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>', 'Cuestionarios inteligentes'],
                    [1, '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>', 'Alertas automáticas'],
                    [2, '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>', 'Tickets anónimos'],
                    [3, '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>', 'Análisis predictivo'],
                    [4, '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>', 'Reportes avanzados'],
                    [5, '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/>', 'Notificaciones inteligentes'],
                ];
                @endphp
                @foreach ($features as [$idx, $svgPath, $label])
                <button
                    @click="activeFeature = {{ $idx }}"
                    class="group flex items-center gap-4 px-5 py-5 text-left transition-all duration-200 cursor-pointer border"
                    :class="activeFeature === {{ $idx }}
                        ? 'border-primary/20 bg-primary/5 shadow-sm'
                        : 'border-transparent hover:bg-muted/50'"
                >
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg transition-all duration-200"
                        :class="activeFeature === {{ $idx }} ? 'bg-primary/15' : 'bg-muted/60 group-hover:bg-muted'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-colors duration-200"
                            :class="activeFeature === {{ $idx }} ? 'text-primary' : 'text-muted-foreground group-hover:text-foreground'"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            {!! $svgPath !!}
                        </svg>
                    </div>
                    <span class="text-sm font-medium transition-colors duration-200"
                        :class="activeFeature === {{ $idx }} ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">
                        {{ __($label) }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-auto h-3.5 w-3.5 shrink-0 transition-all duration-200"
                        :class="activeFeature === {{ $idx }} ? 'text-primary opacity-100' : 'text-muted-foreground/0'"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
                @endforeach
            </div>

            <!-- Feature detail panel -->
            <div class="relative overflow-hidden reveal-right flex items-center w-full lg:w-3/5 border border-border bg-card p-8 lg:p-12">
                <div class="pointer-events-none absolute -left-16 -top-16 h-56 w-56 rounded-full bg-primary/8 blur-[70px]"></div>
                <div class="relative w-full">
                    <!-- Feature 0 -->
                    <template x-if="activeFeature === 0">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Cuestionarios inteligentes') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Sistema completo con 6 cuestionarios predefinidos NOM-035 y la capacidad de crear evaluaciones personalizadas. La IA analiza respuestas en tiempo real, detecta patrones de riesgo y genera reportes automáticos para cumplimiento normativo.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                    <!-- Feature 1 -->
                    <template x-if="activeFeature === 1">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Alertas automáticas') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Recibe notificaciones inmediatas cuando se detectan niveles de riesgo elevados. El sistema monitorea continuamente y te alerta antes de que los problemas escalen, protegiendo a tu equipo.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                    <!-- Feature 2 -->
                    <template x-if="activeFeature === 2">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Tickets anónimos') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Los empleados pueden reportar situaciones de riesgo de forma anónima. Fomenta la comunicación honesta y detecta problemas que normalmente pasan desapercibidos en la organización.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                    <!-- Feature 3 -->
                    <template x-if="activeFeature === 3">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Análisis predictivo') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Algoritmos de IA que analizan tendencias y predicen riesgos psicosociales antes de que se conviertan en problemas graves. Toma decisiones informadas con datos reales de tu empresa.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                    <!-- Feature 4 -->
                    <template x-if="activeFeature === 4">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Reportes avanzados') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Genera reportes detallados para cumplimiento normativo con un clic. Exporta resultados inteligentes y mantén toda la documentación organizada y lista para auditorías de la STPS.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                    <!-- Feature 5 -->
                    <template x-if="activeFeature === 5">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/></svg>
                            </div>
                            <h3 class="font-display text-xl font-bold text-foreground">{{ __('Notificaciones inteligentes') }}</h3>
                            <p class="text-[15px] leading-relaxed mt-3 text-muted-foreground" style="text-wrap:pretty">
                                {{ __('Sistema de notificaciones contextual que envía alertas relevantes en el momento adecuado a las personas correctas. Sin ruido, solo información accionable que importa.') }}
                            </p>
                            <a href="{{ route('register') }}" wire:navigate class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary transition-colors hover:text-primary/80">
                                {{ __('Probar gratis') }}
                                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-main-container>
</section>
