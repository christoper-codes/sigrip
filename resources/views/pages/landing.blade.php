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
        @include('partials.testimonials')

        <!-- ========== PRICING ========== -->
        @include('partials.pricing')

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
