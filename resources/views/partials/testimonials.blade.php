<section id="testimonials" class="relative py-24 lg:py-32">
    <x-main-container>
        <div class="mx-auto mb-16 max-w-2xl text-center">
            <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">{{ __('Testimonios') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl" style="text-wrap:balance">{{ __('Por que nuestros usuarios eligen Neura') }}</h2>
            <p class="mt-4 leading-relaxed" style="text-wrap:pretty">{{ __('Descubre como Neura transforma la gestion del bienestar laboral y previene riesgos psicosociales.') }}</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
        <!-- Testimonial 1 -->
        <div class="group relative rounded-2xl border border-border bg-card p-8 transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/50" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="leading-relaxed italic text-base">{{ __('Neura transformo nuestra gestion del bienestar laboral. La IA detecta riesgos psicosociales antes de que se conviertan en problemas reales. Una solucion invaluable.') }}</p>
            <div class="mt-8 flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">AM</div>
            <div>
                <p class="text-sm font-semibold text-foreground">Ana Martinez</p>
                <p class="text-xs text-muted-foreground">{{ __('Gerente de Recursos Humanos') }}</p>
            </div>
            </div>
        </div>
        <!-- Testimonial 2 -->
        <div class="group relative rounded-2xl border border-border bg-card p-8 transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/50" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="leading-relaxed italic text-base">{{ __('Los cuestionarios personalizados y alertas automaticas mejoraron nuestro ambiente laboral. Cumplimos NOM-035 sin esfuerzo. Neura es indispensable para RH.') }}</p>
            <div class="mt-8 flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">LG</div>
            <div>
                <p class="text-sm font-semibold text-foreground">Luis Gomez</p>
                <p class="text-xs text-muted-foreground">{{ __('Director de Operaciones') }}</p>
            </div>
            </div>
        </div>
        <!-- Testimonial 3 -->
        <div class="group relative rounded-2xl border border-border bg-card p-8 transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/50" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <p class="leading-relaxed italic text-base">{{ __('Los tickets anonimos fomentaron comunicacion honesta con empleados. Humanizamos nuestro espacio laboral y mejoramos la confianza organizacional de todos.') }}</p>
            <div class="mt-8 flex items-center gap-4">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary transition-transform duration-300 group-hover:scale-110">CR</div>
            <div>
                <p class="text-sm font-semibold text-foreground">Carla Ruiz</p>
                <p class="text-xs text-muted-foreground">{{ __('Especialista en Bienestar Laboral') }}</p>
            </div>
            </div>
        </div>
        </div>
    </x-main-container>
</section>
