<section id="cta-banner" class="relative py-24 lg:py-32 overflow-hidden bg-[#060608] dark:bg-[#060608]">

    <x-main-container>
        <div class="relative flex flex-col items-center text-center">
            <!-- Badge -->
            <div class="mb-8 inline-flex items-center gap-2 border border-orange-500/30 bg-orange-500/10 px-5 py-2">
                <span class="relative flex h-1.5 w-1.5 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-orange-400"></span>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-orange-400/80">{{ __('Prueba gratuita · Sin riesgo') }}</span>
            </div>

            <!-- Headline -->
            <h2 class="mx-auto max-w-3xl text-3xl lg:text-5xl font-extrabold leading-[1.05] tracking-tight text-white uppercase special-font">
                {{ __('Empieza a proteger') }}<br/>
                <span class="bg-clip-text text-transparent bg-linear-to-r from-orange-400 to-orange-600">
                    {{ __('tu empresa hoy') }}
                </span>
            </h2>

            <!-- Subtext -->
            <p class="mt-6 max-w-md text-[15px] leading-relaxed text-white/45">
                {{ __('Configura SIGRIP en menos de 24 horas. Cuestionarios NOM-035 listos desde el primer día, sin complicaciones.') }}
            </p>

            <!-- Trust points -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-x-8 gap-y-2">
                @foreach(['Sin tarjeta de crédito', 'Cancela cuando quieras', 'Soporte incluido', 'Setup en 24h'] as $point)
                <div class="flex items-center gap-2">
                    <svg class="h-3.5 w-3.5 text-orange-400/70 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span class="text-[12px] font-medium text-white/35">{{ __($point) }}</span>
                </div>
                @endforeach
            </div>

            <!-- CTAs -->
            <div class="mt-10 flex flex-col items-center gap-3 sm:flex-row">
                <a href="{{ route('register') }}" wire:navigate
                    class="group inline-flex h-12 min-w-[210px] items-center justify-center bg-linear-to-r from-orange-500 to-orange-600 px-8 text-sm font-bold text-white transition-all duration-300 hover:shadow-xl hover:shadow-orange-600/30 hover:opacity-95">
                    {{ __('Comenzar 14 días gratis') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="#pricing"
                    class="inline-flex h-12 min-w-[160px] items-center justify-center border border-white/10 bg-white/5 px-8 text-sm font-medium tracking-wide text-white/45 backdrop-blur-sm transition-all duration-200 hover:border-white/20 hover:bg-white/10 hover:text-white/80">
                    {{ __('Ver precios') }}
                </a>
            </div>
        </div>
    </x-main-container>
</section>
