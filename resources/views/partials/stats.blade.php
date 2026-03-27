<section id="stats" class="relative py-20 lg:py-28 overflow-hidden border-b border-border/40"
    x-data
    x-intersect.once="$el.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'))"
>
    <x-main-container>
        <div class="reveal mb-12 text-center">
            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-orange-500">{{ __('Impacto real') }}</span>
            <h2 class="mt-3 font-display text-2xl font-bold tracking-tight text-foreground sm:text-3xl">
                {{ __('Resultados que hablan por sí solos') }}
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-border/60 border border-border/60">
            <!-- Stat 1 -->
            <div class="reveal stagger-1 flex flex-col items-center justify-center gap-3 px-8 py-12 text-center">
                <span class="text-5xl font-extrabold tabular-nums text-orange-500 tracking-tight">80<span class="text-3xl">%</span></span>
                <span class="text-[12px] font-medium text-muted-foreground leading-snug max-w-[140px]">{{ __('Menos tiempo en cumplimiento NOM-035') }}</span>
            </div>

            <!-- Stat 2 -->
            <div class="reveal stagger-2 flex flex-col items-center justify-center gap-3 px-8 py-12 text-center">
                <span class="text-5xl font-extrabold tabular-nums text-orange-500 tracking-tight">3<span class="text-3xl">x</span></span>
                <span class="text-[12px] font-medium text-muted-foreground leading-snug max-w-[140px]">{{ __('Más rápido en detección de riesgos psicosociales') }}</span>
            </div>

            <!-- Stat 3 -->
            <div class="reveal stagger-3 flex flex-col items-center justify-center gap-3 px-8 py-12 text-center">
                <span class="text-5xl font-extrabold tabular-nums text-orange-500 tracking-tight"><span class="text-3xl">&lt;</span>24h</span>
                <span class="text-[12px] font-medium text-muted-foreground leading-snug max-w-[140px]">{{ __('Para tener tu empresa operando en la plataforma') }}</span>
            </div>

            <!-- Stat 4 -->
            <div class="reveal stagger-4 flex flex-col items-center justify-center gap-3 px-8 py-12 text-center">
                <span class="text-5xl font-extrabold tabular-nums text-orange-500 tracking-tight">100<span class="text-3xl">%</span></span>
                <span class="text-[12px] font-medium text-muted-foreground leading-snug max-w-[140px]">{{ __('De clientes cumplen NOM-035 con nuestra plataforma') }}</span>
            </div>
        </div>

        <p class="mt-5 text-center text-[11px] text-muted-foreground/35 font-medium tracking-wide">
            {{ __('Basado en datos reales de clientes activos · Actualizado') }} {{ date('Y') }}
        </p>
    </x-main-container>
</section>
