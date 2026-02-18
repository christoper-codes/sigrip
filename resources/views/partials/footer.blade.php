<footer class="border-t border-border relative py-12 overflow-hidden">
    <div class="pointer-events-none absolute inset-0">
        <div class="animate-pulse-glow absolute -bottom-[500px] left-1/2 h-[600px] w-[600px] -translate-x-1/2 rounded-full bg-primary/15 blur-[120px]"></div>
    </div>
    <div class="pointer-events-none absolute inset-0 dark:opacity-[0.04] opacity-[0.09]" style="background-image:linear-gradient(hsl(var(--foreground)) 1px,transparent 1px),linear-gradient(90deg,hsl(var(--foreground)) 1px,transparent 1px);background-size:60px 60px"></div>
    <x-main-container>
        <div class="flex flex-col items-center justify-between gap-6 md:flex-row">
           <x-app-logo />
            <nav class="flex items-center gap-6">
                <a href="{{ route('terms.use') }}" wire:navigate class="text-xs underline text-muted-foreground transition-colors duration-300 hover:text-foreground">Terminos de uso</a>
                <a href="{{ route('privacy.policy') }}" wire:navigate class="text-xs underline text-muted-foreground transition-colors duration-300 hover:text-foreground">Politica de privacidad</a>
            </nav>
            <p class="text-xs text-muted-foreground/60">&copy; {{ date('Y') }} AiNEURA. {{ __('Todos los derechos reservados.') }}</p>
        </div>
    </x-main-container>
</footer>
