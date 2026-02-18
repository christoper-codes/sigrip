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
        @include('partials.faqs')

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
