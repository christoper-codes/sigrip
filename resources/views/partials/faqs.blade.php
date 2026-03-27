<section id="faqs" class="relative py-24 lg:py-32">
    <div class="mx-auto max-w-2xl px-6">
        <div class="mb-14 text-center">
            <span class="mb-3 inline-block text-[10px] font-semibold uppercase tracking-[0.25em] text-primary">{{ __('FAQ') }}</span>
            <h2 class="font-display text-3xl font-bold tracking-tight text-foreground sm:text-4xl" style="text-wrap:balance">
                {{ __('Preguntas frecuentes') }}
            </h2>
            <p class="mt-4 text-[15px] text-muted-foreground" style="text-wrap:pretty">
                {{ __('¿Tienes más dudas?') }}
                <a href="mailto:soporte@sigrip.com" class="text-primary font-medium underline-offset-4 transition-colors duration-200 hover:underline">soporte@sigrip.com</a>
            </p>
        </div>

        <div class="space-y-2" x-data="{ openFaq: 0 }">
            @php
            $faqs = [
                [0, '¿Puedo crear cuestionarios personalizados además de los incluidos?', 'Sí, puedes crear y aplicar cuestionarios personalizados ilimitados para adaptarte a las necesidades específicas de tu empresa, además de los cuestionarios NOM-035 y de gestión preventiva incluidos.'],
                [1, '¿Cuántos empleados y departamentos puedo gestionar?', 'Con el plan Premium puedes gestionar empleados y departamentos ilimitados. No hay restricciones en la cantidad de usuarios que puedes administrar.'],
                [2, '¿Qué tipo de soporte ofrecen?', 'Ofrecemos soporte 24/7 a través de múltiples canales. Nuestro equipo está siempre disponible para ayudarte con cualquier duda o problema que tengas.'],
                [3, '¿Qué incluye mi suscripción?', 'Tu suscripción incluye todos los cuestionarios NOM-035 y 3 cuestionarios de gestión preventiva, análisis con IA, exportación de resultados, notificaciones en tiempo real, módulo de tickets, predicción de problemas y acceso a la API.'],
                [4, '¿Cómo funciona el análisis con IA?', 'Nuestra IA analiza las respuestas de los cuestionarios en tiempo real, detecta patrones de riesgo psicosocial, predice problemas potenciales y genera recomendaciones accionables para tu equipo de RH.'],
                [5, '¿Puedo cancelar mi suscripción en cualquier momento?', 'Sí, puedes cancelar tu suscripción en cualquier momento sin penalizaciones. Tendrás acceso a la plataforma hasta el final de tu periodo de facturación.'],
                [6, '¿Mis datos y los de mi empresa están seguros?', 'Absolutamente. Utilizamos cifrado de extremo a extremo, cumplimos con las normas de protección de datos y tus datos nunca se comparten con terceros.'],
            ];
            @endphp

            @foreach ($faqs as [$idx, $question, $answer])
            <div
                class="border border-border bg-card backdrop-blur-sm transition-all duration-300"
                :class="openFaq === {{ $idx }} ? 'border-primary/25 shadow-sm shadow-primary/5' : 'hover:border-border/80'"
            >
                <button
                    @click="openFaq = openFaq === {{ $idx }} ? null : {{ $idx }}"
                    class="flex w-full items-center justify-between px-6 py-6 text-left text-sm font-medium text-foreground transition-colors duration-200 cursor-pointer"
                >
                    <span :class="openFaq === {{ $idx }} ? 'text-foreground' : 'text-foreground/80'">{{ __($question) }}</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="ml-4 h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-300"
                        :class="openFaq === {{ $idx }} ? 'rotate-180 text-primary' : ''"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    >
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div
                    x-show="openFaq === {{ $idx }}"
                    x-transition:enter="transition-all duration-300 ease-out"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-96"
                    x-transition:leave="transition-all duration-200 ease-in"
                    x-transition:leave-start="opacity-100 max-h-96"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="overflow-hidden px-6 pb-6 text-[14px] leading-relaxed text-muted-foreground border-t border-border/50 pt-4"
                >
                    {{ __($answer) }}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Bottom CTA -->
        <div class="mt-14 border border-border bg-card/60 p-8 text-center">
            <p class="text-sm font-semibold text-foreground mb-1">{{ __('¿Listo para empezar?') }}</p>
            <p class="text-[13px] text-muted-foreground mb-6">{{ __('Prueba SIGRIP gratis por 14 días. Sin tarjeta de crédito.') }}</p>
            <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center gap-2 bg-primary px-8 py-3 text-sm font-semibold text-white transition-all hover:opacity-90 hover:shadow-lg hover:shadow-orange-600/25">
                {{ __('Comenzar gratis') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>
</section>
