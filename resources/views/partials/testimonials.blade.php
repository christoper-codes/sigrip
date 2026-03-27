<section id="testimonials" class="relative py-24 lg:py-32 bg-card/20">
    <x-main-container>
        <div class="mx-auto mb-14 max-w-xl text-center">
            <span class="mb-3 inline-block text-[10px] font-semibold uppercase tracking-[0.25em] text-primary">{{ __('Testimonios') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">
                {{ __('Lo que dicen nuestros usuarios') }}
            </h2>
            <p class="text-[15px] leading-relaxed mt-4 text-muted-foreground" style="text-wrap:pretty">
                {{ __('Descubre cómo SIGRIP transforma la gestión del bienestar laboral en empresas mexicanas.') }}
            </p>
        </div>

        <div
            x-data="carousel()"
            x-init="init()"
            class="relative px-6"
        >
            <div class="overflow-hidden py-4">
                <div
                    class="flex transition-transform duration-500 ease-out"
                    :style="`transform: translateX(-${active * (100 / perView)}%);`"
                >
                    <template x-for="(card, idx) in cards" :key="idx">
                        <div class="w-full px-3 sm:w-1/2 lg:w-1/3 shrink-0">
                            <div class="group relative flex flex-col h-full border border-border bg-card p-7 transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5">
                                <!-- Stars -->
                                <div class="flex items-center gap-1 mb-5">
                                    <template x-for="s in 5">
                                        <svg class="h-3.5 w-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </template>
                                </div>
                                <!-- Quote -->
                                <p class="leading-relaxed text-[14px] text-foreground/80 flex-1" x-text="`"` + card.text + `"`"></p>
                                <!-- Author -->
                                <div class="mt-7 flex items-center gap-3 pt-5 border-t border-border/60">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-primary/10 text-[11px] font-bold text-primary" x-text="card.initials"></div>

                                    <div>
                                        <p class="text-sm font-semibold text-foreground" x-text="card.name"></p>
                                        <p class="text-[12px] text-muted-foreground" x-text="card.role"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Controls -->
            <button @click="prev()" class="flex items-center justify-center size-9 absolute left-0 top-1/2 -translate-y-6 border border-border bg-card shadow-sm hover:border-primary/30 hover:bg-primary/5 transition-all">
                <flux:icon.chevron-left variant="micro" />
            </button>
            <button @click="next()" class="flex items-center justify-center size-9 absolute right-0 top-1/2 -translate-y-6 border border-border bg-card shadow-sm hover:border-primary/30 hover:bg-primary/5 transition-all">
                <flux:icon.chevron-right variant="micro" />
            </button>

            <!-- Dots -->
            <div class="mt-8 flex justify-center gap-1.5">
                <template x-for="i in Math.ceil(cards.length / perView)">
                    <button
                        @click="active = i - 1"
                        class="h-1.5 rounded-full transition-all duration-300"
                        :class="active === i - 1 ? 'bg-primary w-6' : 'bg-border w-1.5 hover:bg-primary/40'"
                    ></button>
                </template>
            </div>
        </div>

        <script>
            function carousel() {
                return {
                    cards: [
                        {
                            text: `{{ __('SIGRIP transformó nuestra gestión del bienestar laboral. La IA detecta riesgos psicosociales antes de que se conviertan en problemas reales. Una solución invaluable para RH.') }}`,
                            initials: 'AM',
                            name: 'Ana Martínez',
                            role: `{{ __('Gerente de Recursos Humanos') }}`
                        },
                        {
                            text: `{{ __('Los cuestionarios personalizados y alertas automáticas mejoraron nuestro ambiente laboral. Cumplimos NOM-035 sin esfuerzo. SIGRIP es indispensable para cualquier empresa.') }}`,
                            initials: 'LG',
                            name: 'Luis Gómez',
                            role: `{{ __('Director de Operaciones') }}`
                        },
                        {
                            text: `{{ __('Los tickets anónimos fomentaron comunicación honesta con empleados. Humanizamos nuestro espacio laboral y mejoramos la confianza organizacional de forma notable.') }}`,
                            initials: 'CR',
                            name: 'Carla Ruiz',
                            role: `{{ __('Especialista en Bienestar Laboral') }}`
                        },
                        {
                            text: `{{ __('La plataforma nos dio visibilidad real sobre el clima laboral. Las alertas tempranas y reportes inteligentes nos ayudaron a tomar decisiones preventivas oportunas.') }}`,
                            initials: 'JM',
                            name: 'Juan Martínez',
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
