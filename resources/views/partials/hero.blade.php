<section id="hero">
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
                <span class="text-xs font-medium text-primary">{{ __('Impulsado por Inteligencia Artificial') }}</span>
            </div>

            <!-- Heading -->
            <h1 class="animate-fade-up font-display text-4xl font-bold leading-tight tracking-tight opacity-0 animation-delay-200 sm:text-5xl md:text-6xl lg:text-7xl" style="text-wrap:balance">
                {{ __('Bienestar laboral y cumplimiento') }}
                <span class="relative inline-block text-primary">
                {{ __('NOM-035') }}
                <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M1 5.5C47 2 153 2 199 5.5" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-dasharray="200" stroke-dashoffset="200" style="animation:draw 1.5s ease-out 1s forwards"/>
                </svg>
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="animate-fade-up mx-auto mt-6 max-w-2xl text-base leading-relaxed opacity-0 animation-delay-400" style="text-wrap:pretty">
                <span class="opacity-70">{{ __('Automatiza el cumplimiento de la NOM-035 con IA que previene riesgos laborales, detecta problemas antes de que ocurran y protege tu empresa de demandas costosas. Cuestionarios inteligentes y alertas automaticas.') }}</span>
            </p>

            <!-- CTAs -->
            <div class="animate-fade-up mt-10 flex flex-col items-center justify-center gap-4 opacity-0 animation-delay-600 sm:flex-row">
                <a href="#" class="group relative inline-flex items-center overflow-hidden rounded-full bg-primary px-8 py-3 text-base font-semibold transition-all duration-300 hover:opacity-90 hover:shadow-xl hover:shadow-primary/25">
                <span class="relative z-10 flex items-center text-dark">
                    {{ __('Comenzar gratis') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
                </a>
                <a href="#" class="inline-flex items-center rounded-full border border-neutral-300 dark:border-neutral-700 bg-transparent px-8 py-3 text-base text-foreground transition-all duration-300 hover:border-primary/40 hover:bg-primary/5">
                {{ __('Ver demo') }}
                </a>
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <!-- Stat 1 -->
                <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span class="font-display text-2xl font-bold text-foreground">{{ __('100%') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('Cumplimiento NOM-035') }}</span>
                </div>
                <!-- Stat 2 -->
                <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 6 8 12 8 12s8-6 8-12a8 8 0 0 0-8-8z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span class="font-display text-2xl font-bold text-foreground">{{ __('Tiempo real') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('Analisis con IA') }}</span>
                </div>
                <!-- Stat 3 -->
                <div class="group flex flex-col items-center gap-2 rounded-2xl border border-border bg-card px-6 py-5 transition-all hover:border-primary/20 hover:shadow-lg hover:shadow-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    <span class="font-display text-2xl font-bold text-foreground">{{ __('24/7') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('Alertas automaticas') }}</span>
                </div>
            </div>
            </div>
        </div>
    </section>
</section>
