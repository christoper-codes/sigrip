<section id="testimonials" class="relative py-24">
    <x-main-container>
        <div class="mx-auto mb-16 max-w-2xl text-center">
            <span class="mb-4 inline-block text-xs font-medium uppercase tracking-[0.2em] text-primary">{{ __('Testimonios') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight sm:text-4xl" style="text-wrap:balance">{{ __('Por que nuestros usuarios eligen Neura') }}</h2>
            <p class="text-base leading-relaxed mt-4" style="text-wrap:pretty">
                <span class="opacity-70">{{ __('Descubre como Neura transforma la gestion del bienestar laboral y previene riesgos psicosociales.') }}</span>
            </p>
        </div>

        <div
            x-data="carousel()"
            x-init="init()"
            class="relative"
            >
            <div class="overflow-hidden py-5">
                <div
                    class="flex transition-transform duration-500 ease-out"
                    :style="`transform: translateX(-${active * (100 / perView)}%);`"
                    >
                    <template x-for="(card, idx) in cards" :key="idx">
                        <div class="w-full px-3 sm:w-1/2 lg:w-1/3 flex-shrink-0">
                            <div class="group relative rounded-2xl border border-border bg-card p-8 transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-6 h-8 w-8 text-primary/50" viewBox="0 0 24 24" fill="currentColor">
                                    <path :d="card.icon" />
                                </svg>
                                <p class="leading-relaxed italic text-base" x-text="card.text"></p>
                                <div class="mt-8 flex items-center gap-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary" x-text="card.initials"></div>
                                    <div>
                                        <p class="text-sm font-semibold text-foreground" x-text="card.name"></p>
                                        <p class="text-xs opacity-70" x-text="card.role"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <!-- Controls -->
            <button @click="prev()" class="flex items-center justify-center size-10 absolute left-0 top-1/2 -translate-y-1/1 rounded-full border border-border bg-card shadow">
                <flux:icon.chevron-left variant="micro" />
            </button>
            <button @click="next()" class="flex items-center justify-center size-10 absolute right-0 top-1/2 -translate-y-1/1 rounded-full border border-border bg-card shadow">
                <flux:icon.chevron-right variant="micro" />
            </button>

            <!-- Dots -->
            <div class="mt-6 flex justify-center gap-2">
                <template x-for="i in Math.ceil(cards.length / perView)">
                    <button
                        @click="active = i - 1"
                        class="h-2 w-2 rounded-full transition-all"
                        :class="active === i - 1 ? 'bg-primary w-6' : 'bg-muted'"
                    ></button>
                </template>
            </div>
        </div>

        <script>
            function carousel() {
                return {
                    cards: [
                        {
                            icon: 'M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z',
                            text: `{{ __('Neura transformo nuestra gestion del bienestar laboral. La IA detecta riesgos psicosociales antes de que se conviertan en problemas reales. Una solucion invaluable.') }}`,
                            initials: 'AM',
                            name: 'Ana Martinez',
                            role: `{{ __('Gerente de Recursos Humanos') }}`
                        },
                        {
                            icon: 'M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z',
                            text: `{{ __('Los cuestionarios personalizados y alertas automaticas mejoraron nuestro ambiente laboral. Cumplimos NOM-035 sin esfuerzo. Neura es indispensable para RH.') }}`,
                            initials: 'LG',
                            name: 'Luis Gomez',
                            role: `{{ __('Director de Operaciones') }}`
                        },
                        {
                            icon: 'M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z',
                            text: `{{ __('Los tickets anonimos fomentaron comunicacion honesta con empleados. Humanizamos nuestro espacio laboral y mejoramos la confianza organizacional.') }}`,
                            initials: 'CR',
                            name: 'Carla Ruiz',
                            role: `{{ __('Especialista en Bienestar Laboral') }}`
                        },
                        {
                            icon: 'M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z',
                            text: `{{ __('La plataforma nos dio visibilidad real sobre el clima laboral. Las alertas tempranas y reportes inteligentes nos ayudaron a tomar decisiones preventivas.') }}`,
                            initials: 'JM',
                            name: 'Juan Martinez',
                            role: `{{ __('Líder de Seguridad y Salud Ocupacional') }}`
                        }
                    ],
                    active: 0,
                    perView: 1,
                    updatePerView() {
                        if (window.innerWidth >= 1024) this.perView = 3;
                        else if (window.innerWidth >= 640) this.perView = 2;
                        else this.perView = 1;
                    },
                    next() {
                        const max = Math.max(0, this.cards.length - this.perView);
                        this.active = this.active >= max ? 0 : this.active + 1;
                    },
                    prev() {
                        const max = Math.max(0, this.cards.length - this.perView);
                        this.active = this.active <= 0 ? max : this.active - 1;
                    },
                    init() {
                        this.updatePerView();
                        window.addEventListener('resize', () => {
                            this.updatePerView();
                            this.active = 0;
                        });
                    }
                }
            }
        </script>
    </x-main-container>
</section>
