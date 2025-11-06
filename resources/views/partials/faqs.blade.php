<section id="faqs">
    <x-main-container>
        <div class="mt-52 text-center flex flex-col gap-7 items-center justify-center mb-16 relative">
            <div class="absolute right-[450px] top-0 h-[380px] w-[200px] lg:h-[380px] lg:w-[200px] z-0 rounded-full blur-[120px] lg:blur-[150px] bg-yellow-50/20"></div>

            <h1 class="text-5xl">
                {{ __('Te estás') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('preguntando') }}</span>
            </h1>
            <p class="max-w-3xl">
                <span class="opacity-70">{{ __('¿Necesitas saber más? contáctanos en: ') }}</span> <a href="mailto:soporte@neura.com" class="text-primary">soporte@neura.com</a>
            </p>
        </div>
        <div x-data="{
            openFaq: 0
        }" class="max-w-4xl mx-auto space-y-4 z-20 relative">
            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 0 ? -1 : 0" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Qué es la NOM-035 y por qué es obligatoria?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 0" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 0" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 0" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        La NOM-035 es una norma oficial mexicana que establece los elementos para identificar, analizar y prevenir los factores de riesgo psicosocial en el trabajo. Es obligatoria para todas las empresas y su cumplimiento ayuda a crear ambientes laborales más saludables, reducir el estrés laboral y evitar demandas por riesgos psicosociales.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 1 ? -1 : 1" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Cuánto tiempo toma implementar la plataforma?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 1" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 1" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 1" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        La implementación es inmediata. Una vez que te suscribes, puedes comenzar a usar la plataforma en menos de 5 minutos. Incluimos configuración asistida, importación de empleados y los cuestionarios NOM-035 listos para aplicar. Nuestro equipo te acompaña durante todo el proceso de onboarding.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 2 ? -1 : 2" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Qué incluye el análisis inteligente con IA?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 2" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 2" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 2" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        Nuestro motor de IA analiza automáticamente las respuestas de los cuestionarios, identifica patrones de riesgo, genera recomendaciones personalizadas y predice posibles problemas antes de que se conviertan en situaciones críticas. También crea reportes inteligentes y planes de acción específicos para tu organización.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 3 ? -1 : 3" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Puedo cancelar mi suscripción en cualquier momento?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 3" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 3" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 3" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        Sí, no hay compromisos a largo plazo. Puedes cancelar tu suscripción en cualquier momento desde tu panel de control. Los datos de tu empresa se mantienen seguros por 90 días después de la cancelación, permitiéndote reactivar tu cuenta si lo deseas. Sin penalizaciones ni cargos adicionales.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 4 ? -1 : 4" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Los datos de mi empresa están seguros?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 4" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 4" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 4" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        Absolutamente. Utilizamos encriptación de grado militar, cumplimos con estándares internacionales de seguridad y todos los datos se almacenan en servidores certificados en México. Además, cumplimos con la Ley Federal de Protección de Datos Personales y nunca compartimos información con terceros.
                    </p>
                </div>
            </div>

            <div class="border border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 5 ? -1 : 5" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <h3 class="text-lg font-medium">{{ __('¿Ofrecen capacitación para mi equipo de RRHH?') }}</h3>
                    <flux:icon.plus x-show="openFaq !== 5" class="size-5 text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 5" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 5" class="px-6 pb-5">
                    <p class="text-neutral-400 leading-relaxed">
                        Sí, incluimos capacitación completa para tu equipo. Ofrecemos sesiones en vivo, documentación detallada, videos tutoriales y acceso a nuestros especialistas en NOM-035. También proporcionamos certificaciones para que tu equipo se convierta en experto en el manejo de riesgos psicosociales.
                    </p>
                </div>
            </div>
        </div>
    </x-main-container>
</section>
