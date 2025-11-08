<section id="howworks">
    <x-main-container>
        <div class="mt-52">
            <div class="text-center flex flex-col gap-7 items-center justify-center mb-16">
                <h1 class="text-4xl md:text-5xl">
                    {{ __('¿Cómo') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('Funciona') }}?</span>
                </h1>
                <p class="opacity-70 max-w-3xl">
                    {{ __('Plataforma impulsada por IA que transforma la gestión del bienestar laboral, previene riesgos psicosociales y humaniza el espacio mediante cuestionarios inteligentes, alertas automatizadas y análisis predictivo.') }}
                </p>
            </div>
            <div class="mt-10 flex flex-col lg:flex-row items-center justify-between gap-12"
                 x-data="{
                     selectedFeature: 0,
                     features: [
                         {
                             title: 'Cuestionarios Inteligentes',
                             description: 'Sistema completo con 3 cuestionarios NOM-035 predefinidos y la capacidad de crear evaluaciones personalizadas. La IA analiza respuestas en tiempo real, detecta patrones de riesgo y genera reportes automáticos para cumplimiento normativo.'
                         },
                         {
                             title: 'Alertas Automáticas',
                             description: 'Motor de inteligencia artificial que monitorea continuamente las respuestas y comportamientos. Genera alertas preventivas cuando detecta riesgos psicosociales, crea tickets automáticos y notifica a RH para acción inmediata.'
                         },
                         {
                             title: 'Tickets Anónimos',
                             description: 'Plataforma segura donde empleados reportan situaciones laborales de forma anónima o identificada. Dashboard en tiempo real para RH con respuestas automáticas contextualizadas y seguimiento de casos.'
                         },
                         {
                             title: 'Análisis Predictivo',
                             description: 'Tecnología avanzada que identifica patrones y predice riesgos antes de que se conviertan en problemas. Previene demandas laborales, mejora clima organizacional y optimiza decisiones de RH basadas en datos.'
                         },
                         {
                             title: 'Reportes Avanzados',
                             description: 'Exportación automática en múltiples formatos (PDF, CSV, Excel). Integración con Google Drive para almacenamiento organizado y generación de documentación oficial para auditorías y cumplimiento.'
                         },
                         {
                             title: 'Notificaciones Inteligentes',
                             description: 'Sistema de comunicación multicanal con emails automáticos, dashboard en tiempo real y alertas push. Configuración personalizada para diferentes niveles de urgencia y seguimiento automatizado de casos.'
                         }
                     ]
                 }">

                <div class="flex-1 flex flex-col gap-5">
                    <h2 class="text-xl font-bold" x-text="features[selectedFeature].title"></h2>
                    <p class="opacity-70 leading-relaxed" x-text="features[selectedFeature].description"></p>
                    <div>
                        <x-links.primary
                            url="{{ route('register') }}"
                            title="{{ __('Saber más') }}"
                            class="!px-7 py-4"
                        />
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-5">
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="rounded-xl border border-primary transition-all duration-500 cursor-pointer flex flex-col gap-3 p-5"
                             :class="selectedFeature === index ? 'opacity-100 bg-white/5' : 'opacity-30 hover:opacity-60'"
                             @click="selectedFeature = index">
                            <h3 class="font-medium" x-text="feature.title"></h3>
                            <div class="flex items-center gap-1 opacity-70">
                                <p class="text-sm">{{ __('Explorar') }}</p>
                                <flux:icon.arrow-right variant="micro"/>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </x-main-container>
</section>
