<section id="pricing" class="relative py-24 lg:py-32">
    <!-- Glow -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-0 h-125 w-125 -translate-x-1/2 rounded-full bg-primary/8 blur-[130px]"></div>
    </div>

    <div class="relative mx-auto max-w-7xl px-6" x-data="{
        plan: 'monthly',
        get price() { return this.plan === 'annual' ? 16900 : 1690 },
        get label() { return this.plan === 'annual' ? '/año' : '/mes' }
    }">
        <div class="mx-auto mb-14 max-w-xl text-center">
            <span class="mb-3 inline-block text-[10px] font-semibold uppercase tracking-[0.25em] text-primary">{{ __('Precios') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">
                {{ __('Un plan. Todo incluido.') }}
            </h2>
            <p class="text-[15px] leading-relaxed mt-4 text-muted-foreground" style="text-wrap:pretty">
                {{ __('Pensado para mejorar el bienestar laboral, prevenir riesgos psicosociales y evitar demandas costosas.') }}
            </p>

        </div>

        <!-- Billing switcher -->
        <div class="mx-auto mb-14 max-w-xl text-center -mt-4">
            <div class="inline-flex rounded-full bg-muted p-1 border border-border">
                <button @click="plan = 'monthly'" type="button"
                    :class="plan === 'monthly' ? 'bg-primary text-white shadow' : 'text-muted-foreground hover:text-foreground'"
                    class="px-6 py-2 cursor-pointer rounded-full font-semibold text-sm transition-all duration-200">
                    {{ __('Mensual') }}
                </button>
                <button @click="plan = 'annual'" type="button"
                    :class="plan === 'annual' ? 'bg-primary text-white shadow' : 'text-muted-foreground hover:text-foreground'"
                    class="px-6 py-2 cursor-pointer rounded-full font-semibold text-sm transition-all duration-200">
                    {{ __('Anual') }}
                    <span class="ml-1.5 inline-flex items-center rounded-full bg-green-500/15 px-1.5 text-[10px] font-bold text-green-500" :class="plan === 'annual' ? 'bg-white/20 text-white' : ''">
                        -17%
                    </span>
                </button>
            </div>
        </div>

        <!-- Pricing Card -->
        <div class="mx-auto max-w-md">
            <div class="group relative overflow-hidden border-2 border-primary/25 bg-card p-8 backdrop-blur-sm transition-all duration-500 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10 lg:p-10">
                <div class="pointer-events-none absolute -right-16 -top-16 h-44 w-44 rounded-full bg-primary/15 blur-[60px]"></div>
                <div class="pointer-events-none absolute -bottom-16 -left-16 h-36 w-36 rounded-full bg-primary/5 blur-[50px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>

                <div class="relative">
                    <!-- Badge -->
                    <div class="mb-6 inline-flex items-center gap-2 border border-primary/20 bg-primary/8 px-3 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-blue-500">{{ __('Premium') }}</span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-baseline gap-2 mb-1">
                        <span class="font-display text-5xl font-extrabold text-foreground tabular-nums" x-text="'$' + price.toLocaleString('es-MX')"></span>
                        <span class="text-base font-medium text-muted-foreground" x-text="label"></span>
                    </div>
                    <p class="text-[13px] text-muted-foreground mb-2" x-show="plan === 'annual'">
                        {{ __('Equivalente a $1,408/mes · 2 meses gratis') }}
                    </p>
                    <p class="mt-3 text-[13px] leading-relaxed text-muted-foreground">{{ __('Solución completa que escala con tu empresa. Todo lo que necesitas para cumplimiento NOM-035.') }}</p>

                    <!-- CTA -->
                    <a href="{{ route('register') }}" wire:navigate class="mt-8 flex w-full items-center justify-center bg-primary py-3.5 text-sm font-bold text-white transition-all duration-300 hover:opacity-90 hover:shadow-lg hover:shadow-orange-600/25">
                        {{ __('Comenzar prueba gratuita') }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <p class="mt-3 text-center text-[11px] font-medium tracking-wide text-muted-foreground/50 uppercase">
                        {{ __('Sin tarjeta de crédito · Cancela cuando quieras') }}
                    </p>

                    <!-- Feature list -->
                    <div class="mt-8 pt-8 border-t border-border/60 grid grid-cols-1 gap-3">
                        @php
                        $features = [
                            '3 cuestionarios NOM-035 incluidos',
                            '3 cuestionarios de gestión preventiva',
                            'Análisis inteligente con IA',
                            'Exportación inteligente de resultados',
                            'Notificaciones en tiempo real',
                            'Soporte 24/7',
                            'Cuestionarios personalizados ilimitados',
                            'Empleados y departamentos ilimitados',
                            'Módulo de tickets psicosociales',
                            'Predicción IA de problemas',
                            'API de integración',
                            'Capacitación vía videos',
                            'Actualizaciones continuas',
                            'Integración Google Drive (próximamente)',
                        ];
                        @endphp
                        @foreach ($features as $feature)
                        <div class="flex items-center gap-3">
                            <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-primary/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="text-[13px] leading-relaxed text-muted-foreground">{{ __($feature) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
