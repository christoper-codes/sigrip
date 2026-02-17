<x-layouts.guest.zero>
    @include('partials.header1')

    <main>
        <!-- ========== HERO ========== -->
        <section class="relative flex min-h-screen items-center overflow-hidden pt-10">
            <!-- Background glows -->
            <div class="pointer-events-none absolute inset-0">
                <div class="animate-pulse-glow absolute -top-40 left-1/2 h-[600px] w-[600px] -translate-x-1/2 rounded-full bg-primary/15 blur-[120px]"></div>
                <div class="animate-pulse-glow absolute -right-20 top-1/3 h-[300px] w-[300px] rounded-full bg-primary/5 blur-[80px]" style="animation-delay:2s"></div>
                <div class="animate-pulse-glow absolute -left-20 bottom-1/4 h-[250px] w-[250px] rounded-full bg-primary/5 blur-[80px]" style="animation-delay:4s"></div>
            </div>
            <!-- Grid pattern -->
            <div class="pointer-events-none absolute inset-0 dark:opacity-[0.04] opacity-[0.09]" style="background-image:linear-gradient(hsl(var(--foreground)) 1px,transparent 1px),linear-gradient(90deg,hsl(var(--foreground)) 1px,transparent 1px);background-size:100px 100px"></div>
            <!-- Radial fade -->
            <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(ellipse at center,transparent 50%,hsl(var(--background)) 100%)"></div>

            <div class="relative mx-auto max-w-7xl px-6 py-20 lg:py-32">
                <div class="mx-auto max-w-4xl text-center">
                <!-- Badge -->
                <div class="animate-fade-up mb-8 inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5 opacity-0">
                    <div class="h-1.5 w-1.5 animate-pulse rounded-full bg-primary"></div>
                    <span class="text-xs font-medium text-primary">Impulsado por Inteligencia Artificial</span>
                </div>

                <!-- Heading -->
                <h1 class="animate-fade-up font-display text-4xl font-bold leading-tight tracking-tight opacity-0 animation-delay-200 sm:text-5xl md:text-6xl lg:text-7xl" style="text-wrap:balance">
                    Bienestar laboral y cumplimiento
                    <span class="relative inline-block text-primary">
                    NOM-035
                    <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M1 5.5C47 2 153 2 199 5.5" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-dasharray="200" stroke-dashoffset="200" style="animation:draw 1.5s ease-out 1s forwards"/>
                    </svg>
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="animate-fade-up mx-auto mt-6 max-w-2xl text-base leading-relaxed opacity-0 animation-delay-400 md:text-lg" style="text-wrap:pretty">
                    Automatiza el cumplimiento de la NOM-035 con IA que previene riesgos laborales, detecta problemas antes de que ocurran y protege tu empresa de demandas costosas. Cuestionarios inteligentes y alertas automaticas.
                </p>

                <!-- CTAs -->
                <div class="animate-fade-up mt-10 flex flex-col items-center justify-center gap-4 opacity-0 animation-delay-600 sm:flex-row">
                    <a href="#" class="group relative inline-flex items-center overflow-hidden rounded-full bg-primary px-8 py-3 text-base font-semibold transition-all duration-300 hover:opacity-90 hover:shadow-xl hover:shadow-primary/25">
                    <span class="relative z-10 flex items-center text-dark">
                        Comenzar gratis
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </span>
                    </a>
                    <a href="#" class="inline-flex items-center rounded-full border border-neutral-300 dark:border-neutral-700 bg-transparent px-8 py-3 text-base text-foreground transition-all duration-300 hover:border-primary/40 hover:bg-primary/5">
                    Ver demo
                    </a>
                </div>

                <!-- Stats -->
                <div class="mt-16 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <!-- Stat 1 -->
                    <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span class="font-display text-2xl font-bold text-foreground">100%</span>
                        <span class="text-xs text-muted-foreground">Cumplimiento NOM-035</span>
                    </div>
                    <!-- Stat 2 -->
                    <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 6 8 12 8 12s8-6 8-12a8 8 0 0 0-8-8z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span class="font-display text-2xl font-bold text-foreground">Tiempo real</span>
                        <span class="text-xs text-muted-foreground">Analisis con IA</span>
                    </div>
                    <!-- Stat 3 -->
                    <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        <span class="font-display text-2xl font-bold text-foreground">24/7</span>
                        <span class="text-xs text-muted-foreground">Alertas automaticas</span>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- ========== LOGO MARQUEE ========== -->
        <section class="relative border-y border-border/30 bg-card/30 py-10" x-data x-intersect.once="$el.querySelector('.reveal').classList.add('visible')">
            <p class="reveal mb-8 text-center text-xs font-medium uppercase tracking-[0.2em] text-muted-foreground/60">Confiado por empresas lideres</p>
            <div class="relative overflow-hidden">
                <div class="pointer-events-none absolute left-0 top-0 z-10 h-full w-24 bg-gradient-to-r from-background to-transparent"></div>
                <div class="pointer-events-none absolute right-0 top-0 z-10 h-full w-24 bg-gradient-to-l from-background to-transparent"></div>
                <div class="animate-marquee flex w-max">
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">PEMEX</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">CFE</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">GRUPO BIMBO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">AMERICA MOVIL</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">CEMEX</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">BANORTE</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">WALMART MEXICO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">OXXO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">LIVERPOOL</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">TELEVISA</span></div>
                <!-- Duplicate for seamless loop -->
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">PEMEX</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">CFE</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">GRUPO BIMBO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">AMERICA MOVIL</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">CEMEX</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">BANORTE</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">WALMART MEXICO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">OXXO</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">LIVERPOOL</span></div>
                <div class="flex items-center justify-center px-8"><span class="whitespace-nowrap text-sm font-semibold tracking-wider text-muted-foreground/50 transition-colors duration-300 hover:text-muted-foreground">TELEVISA</span></div>
                </div>
            </div>
        </section>

        <!-- ========== FEATURES ========== -->
        <section id="como-funciona" class="relative py-24 lg:py-32"
            x-data="{ activeFeature: 0 }"
            x-intersect.once="$el.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => el.classList.add('visible'))"
            >
            <div class="mx-auto max-w-7xl px-6">
                <!-- Header -->
                <div class="reveal mx-auto mb-16 max-w-2xl text-center">
                <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">Plataforma</span>
                <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">Como Funciona</h2>
                <p class="mt-4 leading-relaxed text-muted-foreground" style="text-wrap:pretty">Plataforma impulsada por IA que transforma la gestion del bienestar laboral, previene riesgos psicosociales y humaniza el espacio mediante cuestionarios inteligentes, alertas automatizadas y analisis predictivo.</p>
                </div>

                <div class="grid gap-8 lg:grid-cols-5 lg:gap-12">
                <!-- Tab list -->
                <div class="reveal-left flex flex-col gap-2 lg:col-span-2">
                    <!-- Feature 0: Cuestionarios Inteligentes -->
                    <button @click="activeFeature = 0" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 0 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 0 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 0 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Cuestionarios Inteligentes</span>
                    </button>
                    <!-- Feature 1: Alertas Automaticas -->
                    <button @click="activeFeature = 1" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 1 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 1 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 1 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Alertas Automaticas</span>
                    </button>
                    <!-- Feature 2: Tickets Anonimos -->
                    <button @click="activeFeature = 2" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 2 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 2 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 2 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Tickets Anonimos</span>
                    </button>
                    <!-- Feature 3: Analisis Predictivo -->
                    <button @click="activeFeature = 3" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 3 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 3 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 3 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Analisis Predictivo</span>
                    </button>
                    <!-- Feature 4: Reportes Avanzados -->
                    <button @click="activeFeature = 4" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 4 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 4 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 4 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Reportes Avanzados</span>
                    </button>
                    <!-- Feature 5: Notificaciones Inteligentes -->
                    <button @click="activeFeature = 5" class="group flex items-center gap-4 rounded-xl px-5 py-4 text-left transition-all duration-300" :class="activeFeature === 5 ? 'border border-primary/20 bg-primary/5 shadow-sm shadow-primary/5' : 'border border-transparent hover:bg-secondary/50'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 transition-all duration-300" :class="activeFeature === 5 ? 'scale-110 text-primary' : 'text-muted-foreground group-hover:text-foreground'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/></svg>
                    <span class="text-sm font-medium transition-colors duration-300" :class="activeFeature === 5 ? 'text-foreground' : 'text-muted-foreground group-hover:text-foreground'">Notificaciones Inteligentes</span>
                    </button>
                </div>

                <!-- Feature detail panel -->
                <div class="reveal-right flex items-center lg:col-span-3">
                    <div class="w-full rounded-2xl border border-border/40 bg-card/80 p-8 backdrop-blur-sm lg:p-12">

                    <!-- Feature 0 -->
                    <template x-if="activeFeature === 0">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Cuestionarios Inteligentes</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Sistema completo con 6 cuestionarios predefinidos y la capacidad de crear evaluaciones personalizadas. La IA analiza respuestas en tiempo real, detecta patrones de riesgo y genera reportes automaticos para cumplimiento normativo.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 1 -->
                    <template x-if="activeFeature === 1">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Alertas Automaticas</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Recibe notificaciones inmediatas cuando se detectan niveles de riesgo elevados. El sistema monitorea continuamente y te alerta antes de que los problemas escalen.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 2 -->
                    <template x-if="activeFeature === 2">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Tickets Anonimos</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Los empleados pueden reportar situaciones de riesgo de forma anonima. Fomenta la comunicacion honesta y detecta problemas que normalmente pasan desapercibidos.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 3 -->
                    <template x-if="activeFeature === 3">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Analisis Predictivo</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Algoritmos de IA que analizan tendencias y predicen riesgos psicosociales antes de que se conviertan en problemas graves. Toma decisiones informadas con datos reales.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 4 -->
                    <template x-if="activeFeature === 4">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Reportes Avanzados</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Genera reportes detallados para cumplimiento normativo con un clic. Exporta resultados inteligentes y mantiene toda la documentacion organizada.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>
                    <!-- Feature 5 -->
                    <template x-if="activeFeature === 5">
                        <div class="animate-feature-in">
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/><path d="M2 8c0-2.2.7-4.3 2-6"/><path d="M22 8a10 10 0 0 0-2-6"/></svg>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-foreground">Notificaciones Inteligentes</h3>
                        <p class="mt-4 leading-relaxed text-muted-foreground">Sistema de notificaciones contextual que envia alertas relevantes en el momento adecuado a las personas correctas. Sin spam, solo informacion accionable.</p>
                        <a href="#" class="group mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary transition-colors hover:text-primary/80">Saber mas <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">-&gt;</span></a>
                        </div>
                    </template>

                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- ========== TESTIMONIALS ========== -->
        <section class="relative py-24 lg:py-32">
            <div class="mx-auto max-w-7xl px-6">
                <div class="mx-auto mb-16 max-w-2xl text-center">
                <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">Testimonios</span>
                <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">Por que nuestros usuarios eligen Neura</h2>
                <p class="mt-4 leading-relaxed text-muted-foreground" style="text-wrap:pretty">Descubre como Neura transforma la gestion del bienestar laboral y previene riesgos psicosociales.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                <!-- Testimonial 1 -->
                <div class="group relative rounded-2xl border border-border/40 bg-card/50 p-8 backdrop-blur-sm transition-all duration-500 hover:-translate-y-1 hover:border-primary/20 hover:bg-card/80 hover:shadow-xl hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/20 transition-colors duration-300 group-hover:text-primary/40" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="leading-relaxed text-muted-foreground">"Neura transformo nuestra gestion del bienestar laboral. La IA detecta riesgos psicosociales antes de que se conviertan en problemas reales. Una solucion invaluable."</p>
                    <div class="mt-8 flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">AM</div>
                    <div>
                        <p class="text-sm font-semibold text-foreground">Ana Martinez</p>
                        <p class="text-xs text-muted-foreground">Gerente de Recursos Humanos</p>
                    </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="group relative rounded-2xl border border-border/40 bg-card/50 p-8 backdrop-blur-sm transition-all duration-500 hover:-translate-y-1 hover:border-primary/20 hover:bg-card/80 hover:shadow-xl hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/20 transition-colors duration-300 group-hover:text-primary/40" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="leading-relaxed text-muted-foreground">"Los cuestionarios personalizados y alertas automaticas mejoraron nuestro ambiente laboral. Cumplimos NOM-035 sin esfuerzo. Neura es indispensable para RH."</p>
                    <div class="mt-8 flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">LG</div>
                    <div>
                        <p class="text-sm font-semibold text-foreground">Luis Gomez</p>
                        <p class="text-xs text-muted-foreground">Director de Operaciones</p>
                    </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="group relative rounded-2xl border border-border/40 bg-card/50 p-8 backdrop-blur-sm transition-all duration-500 hover:-translate-y-1 hover:border-primary/20 hover:bg-card/80 hover:shadow-xl hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/20 transition-colors duration-300 group-hover:text-primary/40" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="leading-relaxed text-muted-foreground">"Los tickets anonimos fomentaron comunicacion honesta con empleados. Humanizamos nuestro espacio laboral y mejoramos la confianza organizacional de todos."</p>
                    <div class="mt-8 flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">CR</div>
                    <div>
                        <p class="text-sm font-semibold text-foreground">Carla Ruiz</p>
                        <p class="text-xs text-muted-foreground">Especialista en Bienestar Laboral</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- ========== PRICING ========== -->
        <section id="precios" class="relative py-24 lg:py-32">
        <!-- Glow -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-0 h-[400px] w-[400px] -translate-x-1/2 rounded-full bg-primary/5 blur-[120px]"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6">
            <div class="mx-auto mb-16 max-w-2xl text-center">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5">
                <span class="text-xs font-medium text-primary">2 meses gratis en el plan anual</span>
            </div>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">Planes adaptados para ti</h2>
            <p class="mt-4 leading-relaxed text-muted-foreground" style="text-wrap:pretty">Pensados para mejorar el bienestar laboral, prevenir riesgos psicosociales y evitar demandas costosas.</p>
            </div>

            <!-- Card -->
            <div class="mx-auto max-w-lg">
            <div class="group relative overflow-hidden rounded-3xl border border-primary/20 bg-card/80 p-8 backdrop-blur-sm transition-all duration-500 hover:border-primary/30 hover:shadow-2xl hover:shadow-primary/10 lg:p-10">
                <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-primary/10 blur-[60px] transition-opacity duration-500 group-hover:opacity-100"></div>
                <div class="pointer-events-none absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-primary/5 blur-[40px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>

                <div class="relative">
                <span class="text-xs font-medium uppercase tracking-[0.15em] text-primary">Premium</span>
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="font-display text-5xl font-bold text-foreground">$1,690</span>
                    <span class="text-muted-foreground">/mes</span>
                </div>
                <p class="mt-3 text-sm leading-relaxed text-muted-foreground">Lo mejor para empezar. Solucion completa y potente que escala contigo.</p>

                <a href="#" class="mt-8 flex w-full items-center justify-center rounded-full bg-primary py-3 text-base font-semibold transition-all duration-300 hover:opacity-90 hover:shadow-lg hover:shadow-primary/25">
                    Comenzar prueba gratuita
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>

                <div class="mt-10 space-y-4">
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">3 cuestionarios NOM-035 incluidos</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">3 cuestionarios onboarding incluidos</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Analisis inteligente con IA</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Exportacion inteligente de resultados</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Notificaciones en tiempo real</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Soporte 24/7</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Cuestionarios personalizados ilimitados</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Empleados y departamentos ilimitados</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Modulo de tickets psicosociales</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Prediccion IA de problemas</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">API de integracion</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Capacitacion via videos</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Actualizacion continua</span></div>
                    <div class="flex items-start gap-3"><div class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">Integracion Google Drive (proximamente)</span></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- ========== FAQ ========== -->
        <section id="preguntas" class="relative py-24 lg:py-32">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-16 text-center">
            <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">FAQ</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">Te estas preguntando</h2>
            <p class="mt-4 text-muted-foreground" style="text-wrap:pretty">
                Necesitas saber mas? contactanos en: <a href="mailto:soporte@neura.com" class="text-primary underline-offset-4 transition-colors duration-300 hover:underline">soporte@neura.com</a>
            </p>
            </div>

            <!-- Accordion -->
            <div class="space-y-3" x-data="{ openFaq: 0 }">
            <!-- FAQ 1 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 0 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 0 ? null : 0" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Puedo crear cuestionarios personalizados ademas de los incluidos?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 0 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 0"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Si, puedes crear y aplicar cuestionarios personalizados ilimitados para adaptarte a las necesidades especificas de tu empresa, ademas de los cuestionarios NOM-035 y de onboarding incluidos.
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 1 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 1 ? null : 1" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Cuantos empleados y departamentos puedo gestionar en la plataforma?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 1 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 1"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Con el plan Premium puedes gestionar empleados y departamentos ilimitados. No hay restricciones en la cantidad de usuarios que puedes administrar.
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 2 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 2 ? null : 2" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Que tipo de soporte ofrecen?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 2 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 2"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Ofrecemos soporte 24/7 a traves de multiples canales. Nuestro equipo esta siempre disponible para ayudarte con cualquier duda o problema que tengas.
                </div>
            </div>
            <!-- FAQ 4 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 3 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 3 ? null : 3" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Que incluye mi suscripcion?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 3 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 3"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Tu suscripcion incluye todos los cuestionarios NOM-035 y onboarding, analisis con IA, exportacion de resultados, notificaciones en tiempo real, modulo de tickets, prediccion de problemas y acceso a la API.
                </div>
            </div>
            <!-- FAQ 5 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 4 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 4 ? null : 4" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Como funciona el analisis con IA?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 4 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 4"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Nuestra IA analiza las respuestas de los cuestionarios en tiempo real, detecta patrones de riesgo psicosocial, predice problemas potenciales y genera recomendaciones accionables para tu equipo de RH.
                </div>
            </div>
            <!-- FAQ 6 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 5 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 5 ? null : 5" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Puedo cancelar mi suscripcion en cualquier momento?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 5 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 5"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Si, puedes cancelar tu suscripcion en cualquier momento sin penalizaciones. Tendras acceso a la plataforma hasta el final de tu periodo de facturacion.
                </div>
            </div>
            <!-- FAQ 7 -->
            <div class="rounded-xl border border-border/40 bg-card/50 px-6 backdrop-blur-sm transition-all duration-300" :class="openFaq === 6 ? 'border-primary/20 bg-card/80 shadow-lg shadow-primary/5' : ''">
                <button @click="openFaq = openFaq === 6 ? null : 6" class="flex w-full items-center justify-between py-5 text-left text-sm font-medium text-foreground transition-colors duration-300">
                Mis datos y los de mi empresa estan seguros?
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300" :class="openFaq === 6 ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div x-show="openFaq === 6"
                    x-transition:enter="transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-700 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="pb-5 text-sm leading-relaxed text-muted-foreground overflow-hidden">
                Absolutamente. Utilizamos cifrado de extremo a extremo, cumplimos con las normas de proteccion de datos y tus datos nunca se comparten con terceros.
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- ========== FOOTER ========== -->
        <footer class="border-t border-border/30 bg-card/30">
            <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
                <a href="#" class="group flex items-center gap-2">
                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary transition-transform duration-300 group-hover:scale-110">
                    <span class="text-xs font-bold">N</span>
                </div>
                <span class="font-display text-base font-bold tracking-tight text-foreground">NEURA</span>
                </a>
                <nav class="flex items-center gap-6">
                <a href="#" class="text-xs text-muted-foreground transition-colors duration-300 hover:text-foreground">Terminos de uso</a>
                <a href="#" class="text-xs text-muted-foreground transition-colors duration-300 hover:text-foreground">Politica de privacidad</a>
                </nav>
                <p class="text-xs text-muted-foreground/60">&copy; 2026 NEURA. Todos los derechos reservados.</p>
            </div>
            </div>
        </footer>
    </main>
</x-layouts.guest.zero>
