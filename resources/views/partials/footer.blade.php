<footer class="w-full bg-card border-t border-border pt-20 pb-8 px-4">
    <x-main-container>
        <div class="w-full mx-auto text-foreground flex flex-col">
            <div class="w-full text-4xl md:text-5xl font-bold">
                <h1 class="w-full md:w-2/3">{{ __('¿Cómo podemos ayudarte?') }} <br class="hidden md:block"/> <span class="lg:mt-2 block">{{ __('Ponte en contacto') }}</span> </h1>
            </div>
            <div class="flex my-8 flex-col md:flex-row justify-between lg:items-end">
                <div>
                    <p class="max-w-2xl text-base leading-relaxed">
                        <span class="opacity-70">{{ __('Para soporte, dudas o sugerencias, escríbenos a nuestro correo o síguenos en redes sociales') }}</span>
                    </p>
                    <div class="hidden lg:flex flex-row flex-wrap items-center gap-7 text-base mt-5 opacity-70">
                        <a href="{{ route('terms.use') }}" wire:navigate class="cursor-pointer underline underline-offset-4">{{ __('Términos de uso') }}</a>
                        <a href="{{ route('privacy.policy') }}" wire:navigate class="cursor-pointer underline underline-offset-4">{{ __('Política de privacidad') }}</a>
                    </div>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="mailto:soporte@sigrip.com" wire:navigate class="group relative w-full md:w-auto flex items-center justify-center overflow-hidden rounded-full bg-primary px-8 py-4 text-base font-semibold transition-all duration-300 hover:opacity-90 hover:shadow-xl hover:shadow-primary/25">
                        <span class="relative z-10 flex items-center text-light dark:text-dark">
                            {{ __('Contactar') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="flex flex-col">
                <hr class="border-border my-8"/>
                <p class="w-full text-center my-6 text-muted-foreground text-sm opacity-65">&copy; {{ date('Y') }} {{  __('SIGRIP. Todos los derechos reservados') }}</p>
                <div class="lg:hidden flex flex-wrap items-center justify-center gap-7 opacity-70 text-sm">
                    <a href="{{ route('terms.use') }}" wire:navigate class="cursor-pointer underline underline-offset-4">{{ __('Términos de uso') }}</a>
                    <a href="{{ route('privacy.policy') }}" wire:navigate class="cursor-pointer underline underline-offset-4">{{ __('Política de privacidad') }}</a>
                </div>
            </div>
        </div>
    </x-main-container>
</footer>
