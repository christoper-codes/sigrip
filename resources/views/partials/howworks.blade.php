<section id="howworks" class="relative py-24 lg:py-32"
    x-data="{ activeFeature: 0 }"
    x-intersect.once="$el.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => el.classList.add('visible'))"
    >
   <x-main-container>
        <!-- Header -->
        <div class="reveal mx-auto mb-16 max-w-2xl text-center">
            <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">{{ __('Plataforma') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">{{ __('Como funciona') }}</h2>
            <p class="mx-auto mt-8 max-w-2xl text-base leading-relaxed" style="text-wrap:pretty">
                <span class="opacity-70">{{ __('Plataforma impulsada por IA que transforma la gestion del bienestar laboral, previene riesgos psicosociales y humaniza el espacio mediante cuestionarios inteligentes, alertas automatizadas y analisis predictivo.') }}</span>
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-stretch justify-center gap-8 lg:gap-12">
            <!-- Tab list -->
            <div class="reveal-left flex flex-col gap-2 w-full lg:w-2/5">
                <button @click="activeFeature = 0" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 0 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 0 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 0 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Cuestionarios inteligentes') }}</span>
                </button>

                <button @click="activeFeature = 1" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 1 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 1 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 1 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Alertas automaticas') }}</span>
                </button>

                <button @click="activeFeature = 2" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 2 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 2 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 2 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Tickets anonimos') }}</span>
                </button>

                <button @click="activeFeature = 3" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 3 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 3 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 3 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Analisis predictivo') }}</span>
                </button>

                <button @click="activeFeature = 4" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 4 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 4 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 4 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Reportes avanzados') }}</span>
                </button>

                <button @click="activeFeature = 5" class="group flex items-center gap-4 rounded-xl px-5 py-6 text-left transition-all duration-300 cursor-pointer" :class="activeFeature === 5 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-light-variant dark:hover:bg-dark-variant'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 5 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 5 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">{{ __('Notificaciones inteligentes') }}</span>
                </button>
            </div>

            <!-- Feature detail panel -->
            <div class="reveal-right flex items-center w-full lg:w-3/5 rounded-2xl border border-border bg-card p-8 lg:p-12">
                <div>
                    <!-- Feature 0 -->
                    <template x-if="activeFeature === 0">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Cuestionarios inteligentes') }}</h3>
                            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                                <span class="opacity-70">{{ __('Sistema completo con 6 cuestionarios predefinidos y la capacidad de crear evaluaciones personalizadas. La IA analiza respuestas en tiempo real, detecta patrones de riesgo y genera reportes automaticos para cumplimiento normativo.') }}</span>
                            </p>
                            <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 1 -->
                    <template x-if="activeFeature === 1">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Alertas automaticas') }}</h3>
                            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                                <span class="opacity-70">{{ __('Recibe notificaciones inmediatas cuando se detectan niveles de riesgo elevados. El sistema monitorea continuamente y te alerta antes de que los problemas escalen.') }}</span>
                            </p>
                            <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 2 -->
                    <template x-if="activeFeature === 2">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Tickets anonimos') }}</h3>
                            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                                <span class="opacity-70">{{ __('Los empleados pueden reportar situaciones de riesgo de forma anonima. Fomenta la comunicacion honesta y detecta problemas que normalmente pasan desapercibidos.') }}</span>
                            </p>
                            <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 3 -->
                    <template x-if="activeFeature === 3">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Analisis predictivo') }}</h3>
                            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                                <span class="opacity-70">{{ __('Algoritmos de IA que analizan tendencias y predicen riesgos psicosociales antes de que se conviertan en problemas graves. Toma decisiones informadas con datos reales.') }}</span>
                            </p>
                            <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 4 -->
                    <template x-if="activeFeature === 4">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Reportes avanzados') }}</h3>
                        <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                            <span class="opacity-70">{{ __('Genera reportes detallados para cumplimiento normativo con un clic. Exporta resultados inteligentes y mantiene toda la documentacion organizada.') }}</span>
                        </p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 5 -->
                    <template x-if="activeFeature === 5">
                        <div class="animate-feature-in">
                            <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/></svg>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-foreground">{{ __('Notificaciones inteligentes') }}</h3>
                            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                                <span class="opacity-70">{{ __('Sistema de notificaciones contextual que envia alertas relevantes en el momento adecuado a las personas correctas. Sin spam, solo informacion accionable.') }}</span>
                            </p>
                            <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">{{ __('Saber mas') }} <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-main-container>
</section>
