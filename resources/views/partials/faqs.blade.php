<section id="faqs">
    <x-main-container>
        <div data-aos="fade-zoom-in"
            data-aos-once="true"
            data-aos-duration="2000"
            class="mt-52 text-center flex flex-col gap-7 items-center justify-center mb-16 relative">
            <div class="absolute right-0 lg:right-[450px] top-0 h-[380px] w-[200px] lg:h-[380px] lg:w-[200px] z-0 rounded-full blur-[120px] lg:blur-[150px] bg-yellow-50/20"></div>

            <h1 class="text-4xl md:text-5xl">
                {{ __('Te estás') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('preguntando') }}</span>
            </h1>
            <p class="max-w-3xl">
                <span class="opacity-70">{{ __('¿Necesitas saber más? contáctanos en: ') }}</span> <a href="mailto:soporte@neura.com" class="text-primary">soporte@neura.com</a>
            </p>
        </div>
        <div x-data="{
                openFaq: 5
            }"
            data-aos="fade-zoom-in"
            data-aos-once="true"
            data-aos-duration="2000"
            class="max-w-4xl mx-auto space-y-4 z-20 relative">
                <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 5 ? -1 : 5" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                        <h3 class="text-lg font-medium">{{ __('¿Puedo crear cuestionarios personalizados además de los incluidos?') }}</h3>
                        <flux:icon.plus x-show="openFaq !== 5" class="size-5 text-neutral-600 dark:text-neutral-400" />
                        <flux:icon.minus x-show="openFaq === 5" class="size-5 text-primary" />
                    </button>
                    <div x-show="openFaq === 5" class="px-6 pb-5">
                        <p class="opacity-70 leading-relaxed">
                            Sí, puedes crear y aplicar cuestionarios personalizados ilimitados para adaptarte a las necesidades específicas de tu empresa, además de los cuestionarios NOM-035 y de onboarding incluidos.
                        </p>
                    </div>
                </div>

                <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 6 ? -1 : 6" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                        <h3 class="text-lg font-medium">{{ __('¿Cuántos empleados y departamentos puedo gestionar en la plataforma?') }}</h3>
                        <flux:icon.plus x-show="openFaq !== 6" class="size-5 text-neutral-600 dark:text-neutral-400" />
                        <flux:icon.minus x-show="openFaq === 6" class="size-5 text-primary" />
                    </button>
                    <div x-show="openFaq === 6" class="px-6 pb-5">
                        <p class="opacity-70 leading-relaxed">
                            No hay límite. Puedes agregar empleados y departamentos ilimitados sin costo adicional, lo que permite escalar la plataforma conforme crece tu organización.
                        </p>
                    </div>
                </div>

                <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 7 ? -1 : 7" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                        <h3 class="text-lg font-medium">{{ __('¿Qué tipo de soporte ofrecen?') }}</h3>
                        <flux:icon.plus x-show="openFaq !== 7" class="size-5 text-neutral-600 dark:text-neutral-400" />
                        <flux:icon.minus x-show="openFaq === 7" class="size-5 text-primary" />
                    </button>
                    <div x-show="openFaq === 7" class="px-6 pb-5">
                        <p class="opacity-70 leading-relaxed">
                            Ofrecemos soporte 24/7 a través de correo electrónico y chat. Nuestro equipo está disponible para ayudarte con cualquier duda técnica, configuración o uso de la plataforma en cualquier momento.
                        </p>
                    </div>
                </div>
            <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 1 ? -1 : 1" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Qué incluye mi suscripción?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 1" class="size-5 text-neutral-600 dark:text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 1" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 1" class="px-6 pb-5">
                    <p class="opacity-70 leading-relaxed">
                        Incluye 3 cuestionarios NOM-035, 3 de onboarding, cuestionarios personalizados e ilimitados, análisis inteligente con IA, exportación de resultados, notificaciones en tiempo real, módulo de tickets psicosociales, empleados y departamentos ilimitados, predicción de problemas con IA, API de integración y soporte 24/7. Próximamente: integración con Google Drive.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 2 ? -1 : 2" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Cómo funciona el análisis con IA?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 2" class="size-5 text-neutral-600 dark:text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 2" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 2" class="px-6 pb-5">
                    <p class="opacity-70 leading-relaxed">
                        La IA analiza automáticamente las respuestas, identifica riesgos psicosociales, predice problemas, genera reportes inteligentes y recomendaciones para RH. Todo el análisis es inmediato y sin intervención manual.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 3 ? -1 : 3" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Puedo cancelar mi suscripción en cualquier momento?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 3" class="size-5 text-neutral-600 dark:text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 3" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 3" class="px-6 pb-5">
                    <p class="opacity-70 leading-relaxed">
                        Sí, puedes cancelar en cualquier momento desde tu panel. Tus datos se mantienen seguros por 90 días tras la cancelación, por si decides regresar. Sin penalizaciones ni cargos extra.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 4 ? -1 : 4" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Mis datos y los de mi empresa están seguros?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 4" class="size-5 text-neutral-600 dark:text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 4" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 4" class="px-6 pb-5">
                    <p class="opacity-70 leading-relaxed">
                        Sí. Usamos encriptación avanzada, servidores certificados en México y cumplimos con la Ley Federal de Protección de Datos Personales. Nunca compartimos tu información con terceros.
                    </p>
                </div>
            </div>
    </x-main-container>
</section>
