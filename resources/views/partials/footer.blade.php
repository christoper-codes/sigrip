<footer class="w-full bg-card border-t border-border">
    <div class="min-h-screen w-full"></div>
    <x-main-container>
        <!-- Main footer grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 py-16">
            <!-- Brand col -->
            <div class="lg:col-span-2">
                <a href="/" class="inline-flex items-center gap-2.5 mb-5">
                    <x-app-logo-icon />
                    <span class="text-sm font-bold tracking-widest text-foreground uppercase">SIGRIP</span>
                </a>
                <p class="text-[14px] leading-relaxed text-muted-foreground max-w-xs">
                    {{ __('Plataforma de cumplimiento NOM-035 y STPS impulsada por Inteligencia Artificial. Bienestar laboral, simplificado.') }}
                </p>

                <!-- Social icons -->
                <div class="mt-6 flex items-center gap-3">
                    <a href="#" aria-label="LinkedIn" class="flex h-8 w-8 items-center justify-center border border-border text-muted-foreground transition-all duration-200 hover:border-primary/40 hover:text-primary hover:bg-primary/5">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter / X" class="flex h-8 w-8 items-center justify-center border border-border text-muted-foreground transition-all duration-200 hover:border-primary/40 hover:text-primary hover:bg-primary/5">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.254 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                        </svg>
                    </a>
                    <a href="mailto:soporte@sigrip.com" aria-label="Email" class="flex h-8 w-8 items-center justify-center border border-border text-muted-foreground transition-all duration-200 hover:border-primary/40 hover:text-primary hover:bg-primary/5">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Product links -->
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-foreground/50 mb-5">{{ __('Producto') }}</p>
                <nav class="flex flex-col gap-3">
                    <a href="#howworks" class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Características') }}</a>
                    <a href="#pricing" class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Precios') }}</a>
                    <a href="#testimonials" class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Testimonios') }}</a>
                    <a href="#faqs" class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('FAQ') }}</a>
                    <a href="{{ route('register') }}" wire:navigate class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Prueba gratuita') }}</a>
                </nav>
            </div>

            <!-- Company links -->
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-foreground/50 mb-5">{{ __('Legal') }}</p>
                <nav class="flex flex-col gap-3">
                    <a href="{{ route('terms.use') }}" wire:navigate class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Términos de uso') }}</a>
                    <a href="{{ route('privacy.policy') }}" wire:navigate class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Política de privacidad') }}</a>
                    <a href="mailto:soporte@sigrip.com" class="text-[14px] text-muted-foreground transition-colors hover:text-foreground">{{ __('Contacto') }}</a>
                </nav>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-border py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-[12px] text-muted-foreground/50">
                &copy; {{ date('Y') }} {{ __('SIGRIP. Todos los derechos reservados.') }}
            </p>
            <div class="flex items-center gap-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-[11px] font-medium text-muted-foreground/40 uppercase tracking-widest">{{ __('Todos los sistemas operativos') }}</span>
            </div>
        </div>
    </x-main-container>
</footer>
