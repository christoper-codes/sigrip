<section id="brands" class="relative border-y border-border/60 bg-card/40 py-12">
    <p class="mb-10 text-center text-[10px] font-semibold uppercase tracking-[0.25em] text-muted-foreground/40">
        {{ __('Confiado por empresas líderes en México') }}
    </p>
    <div class="relative overflow-hidden">
        <div class="pointer-events-none absolute left-0 top-0 z-10 h-full w-32 bg-gradient-to-r from-background to-transparent"></div>
        <div class="pointer-events-none absolute right-0 top-0 z-10 h-full w-32 bg-gradient-to-l from-background to-transparent"></div>
        <div class="animate-marquee flex w-max items-center">
            @foreach (['PEMEX', 'CFE', 'GRUPO BIMBO', 'AMERICA MOVIL', 'CEMEX', 'BANORTE', 'WALMART MEXICO', 'OXXO', 'LIVERPOOL', 'TELEVISA', 'PEMEX', 'CFE', 'GRUPO BIMBO', 'AMERICA MOVIL', 'CEMEX', 'BANORTE', 'WALMART MEXICO', 'OXXO', 'LIVERPOOL', 'TELEVISA'] as $brand)
            <div class="flex items-center justify-center px-10">
                <span class="whitespace-nowrap text-[11px] font-bold tracking-[0.2em] text-muted-foreground/30 transition-colors duration-300 hover:text-muted-foreground/70 uppercase">
                    {{ $brand }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>
