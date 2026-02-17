<x-layouts.guest.zero>
    @include('partials.header')

    <main>
        <!-- ========== HERO ========== -->
        @include('partials.hero')

        <!-- ========== LOGO MARQUEE ========== -->
        @include('partials.brands')

        <!-- ========== FEATURES ========== -->
        @include('partials.howworks')

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
