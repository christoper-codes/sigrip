<section id="pricing" class="relative py-24 lg:py-32">
    <!-- Glow -->
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-1/2 top-0 h-[400px] w-[400px] -translate-x-1/2 rounded-full bg-primary/10 blur-[120px]"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-6" x-data="{
        plan: 'monthly',
        get price() { return this.plan === 'annual' ? 1690 * 10 : 1690 },
        get label() { return this.plan === 'annual' ? '/año' : '/mes' }
    }">
        <div class="mx-auto mb-16 max-w-2xl text-center">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5">
                <span class="text-xs font-medium text-primary">{{ __('2 meses gratis en el plan anual') }}</span>
            </div>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">{{ __('Planes adaptados para ti') }}</h2>
            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                <span class="opacity-70">{{ __('Pensados para mejorar el bienestar laboral, prevenir riesgos psicosociales y evitar demandas costosas.') }}</span>
            </p>
            <!-- Switcher -->
            <div class="flex justify-center mt-8">
                <div class="inline-flex rounded-full bg-muted p-1 border-2 border-border">
                    <button @click="plan = 'monthly'" type="button" :class="plan === 'monthly' ? 'bg-primary text-light dark:text-dark shadow' : 'text-foreground'" class="px-5 py-2 cursor-pointer rounded-full font-semibold text-sm transition-all">{{ __('Mensual') }}</button>
                    <button @click="plan = 'annual'" type="button" :class="plan === 'annual' ? 'bg-primary text-light dark:text-dark shadow' : 'text-foreground'" class="px-5 py-2 cursor-pointer rounded-full font-semibold text-sm transition-all">{{ __('Anual') }}</button>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="mx-auto max-w-lg">
        <div class="group relative overflow-hidden rounded-4xl border-[3px] border-primary/20 bg-card p-8 backdrop-blur-sm transition-all duration-500 hover:border-primary/30 hover:shadow-2xl hover:shadow-primary/10 lg:p-10">
            <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-primary/20 blur-[60px]"></div>
            <div class="pointer-events-none absolute -bottom-10 -left-10 h-32 w-32 rounded-full bg-primary/5 blur-[40px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>

            <div class="relative">
                <span class="text-xs font-medium uppercase tracking-[0.15em] text-primary">{{ __('Premium') }}</span>
                <div class="mt-4 flex items-baseline gap-1">
                    <template x-if="plan === 'monthly'" x>
                        <span class="font-display text-5xl font-bold text-foreground block">$1,690</span>
                    </template>
                    <template x-if="plan === 'annual'">
                        <span class="font-display text-5xl font-bold text-foreground block">$16,900</span>
                    </template>
                    <span class="text-muted-foreground" x-text="plan === 'annual' ? '/año' : '/mes'"></span>
                </div>
                <p class="mt-3 text-sm leading-relaxed text-muted-foreground">{{ __('Lo mejor para empezar. Solucion completa y potente que escala contigo.') }}</p>

                <a href="{{ route('register') }}" class="text-light dark:text-dark mt-8 flex w-full items-center justify-center rounded-full bg-primary py-3 text-base font-semibold transition-all duration-300 hover:opacity-90 hover:shadow-lg hover:shadow-primary/25">
                    {{ __('Comenzar prueba gratuita') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>

                <div class="mt-10 space-y-4">
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('3 cuestionarios NOM-035 incluidos') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('3 cuestionarios de gestión preventiva incluidos') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Analisis inteligente con IA') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Exportacion inteligente de resultados') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Notificaciones en tiempo real') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Soporte 24/7') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Cuestionarios personalizados ilimitados') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Empleados y departamentos ilimitados') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Modulo de tickets psicosociales') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Prediccion IA de problemas') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('API de integracion') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Capacitacion via videos') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Actualizacion continua') }}</span></div>
                    <div class="flex items-center gap-3"><div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary/10"><svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div><span class="text-sm leading-relaxed text-muted-foreground">{{ __('Integracion Google Drive (proximamente)') }}</span></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
