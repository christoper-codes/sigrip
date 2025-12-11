<section id="testimonials">
    <x-main-container>
        <div data-aos="fade-zoom-in"
            data-aos-once="true"
            data-aos-duration="2000"
            class="mt-52 text-center flex flex-col gap-7 items-center justify-center mb-16">
            <h1 class="text-4xl md:text-5xl">
                {{ __('¿Por que nuestros usuarios ') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('eligen') }} {{ __('Neura?') }}</span>
            </h1>
            <p class="opacity-70 max-w-3xl">
                {{ __('Descubre como Neura transforma la gestión del bienestar laboral y previene riesgos psicosociales.') }}
            </p>
        </div>
        <div data-aos="fade-zoom-in"
            data-aos-once="true"
            data-aos-duration="2000"
            class="mt-10 z-30 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-base">
            <div class="bg-gradient-to-b from-light dark:from-dark to-neutral-200 dark:to-neutral-950/50 rounded-2xl p-7 flex flex-col gap-3 border-b border-x border-neutral-300 dark:border-neutral-900">
                <p>{{ __('"Neura transformó nuestra gestión del bienestar laboral. La IA detecta riesgos psicosociales antes de que se conviertan en problemas reales. Una solución invaluable."') }}</p>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-full overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=150" alt="testimonial user">
                        </div>
                        <div>
                            <h3 class="font-bold">{{ __('Ana Martínez') }}</h3>
                            <p class="text-sm opacity-70">{{ __('Gerente de Recursos Humanos') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-amber-500 flex items-center gap-1">
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-b from-light dark:from-dark to-neutral-200 dark:to-neutral-950/50 rounded-2xl p-7 flex gap-3 flex-col border-b border-x border-neutral-300 dark:border-neutral-900">
                <p>{{ __('"Los cuestionarios personalizados y alertas automáticas mejoraron nuestro ambiente laboral. Cumplimos NOM-035 sin esfuerzo. Neura es indispensable para RH."') }}</p>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-full overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=150" alt="testimonial user">
                        </div>
                        <div>
                            <h3 class="font-bold">{{ __('Luis Gómez') }}</h3>
                            <p class="text-sm opacity-70">{{ __('Director de Operaciones') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-amber-500 flex items-center gap-1">
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-b from-light dark:from-dark to-neutral-200 dark:to-neutral-950/50 rounded-2xl p-7 flex flex-col gap-3 border-b border-x border-neutral-300 dark:border-neutral-900">
                <p>{{ __('"Los tickets anónimos fomentaron comunicación honesta con empleados. Humanizamos nuestro espacio laboral y mejoramos la confianza organizacional de todos."') }}</p>
                <div>
                    <div class="flex items-center gap-3">
                        <div class="size-10 rounded-full overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=150" alt="testimonial user">
                        </div>
                        <div>
                            <h3 class="font-bold">{{ __('Carla Ruiz') }}</h3>
                            <p class="text-sm opacity-70">{{ __('Especialista en Bienestar Laboral') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-amber-500 flex items-center gap-1">
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                        <flux:icon.star variant="micro" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 relative">
            <div class="absolute -top-52 left-0 w-full overflow-hidden h-52 pointer-events-none">
                <div class="w-3/4 mx-auto h-14 rounded-tl-full rounded-tr-full bg-light/20 blur-[70px] absolute bottom-0 left-1/2 -translate-x-1/2"></div>
            </div>
            <div class="w-full h-[2px] bg-gradient-to-r from-transparent via-neutral-700 dark:via-light to-transparent"></div>
        </div>
    </x-main-container>
</section>
