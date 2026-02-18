<x-layouts.application :title="__('Política de Privacidad')">
    <section id="application-show" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="absolute left-0 lg:hidden top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-primary/30"></div>
            <div class="absolute hidden lg:block right-0 top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-primary/30"></div>
            <div>
                <div class="flex items-center justify-between relative">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-app-logo-icon />
                    </a>
                    <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer size-7! border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center!">
                        <x-icon.sun variant="mini" class="size-4! text-dark! dark:text-light!"/>
                    </flux:link>
                </div>
                <main class="flex items-start gap-5 mt-16">
                    <section class="text-sm hidden lg:flex flex-col gap-2 lg:w-[20%]">
                        <a href="{{ route('terms.use') }}" wire:navigate
                            @class([
                                'opacity-50 pl-4 py-2' => !request()->routeIs('terms.use'),
                                'opacity-100 pl-4 py-2 border-l-2 border-l-primary' => request()->routeIs('terms.use')
                            ])>
                            {{ __('Terminos de uso') }}
                        </a>
                        <a href="{{ route('privacy.policy') }}" wire:navigate
                            @class([
                                'opacity-50 pl-4 py-2' => !request()->routeIs('privacy.policy'),
                                'opacity-100 pl-4 py-2 border-l-2 border-l-primary' => request()->routeIs('privacy.policy')
                            ])>
                            {{ __('Política de privacidad') }}
                        </a>
                    </section>
                    <section class="w-full lg:w-[80%]">
                        <flux:heading size="xl">{{ __('Política de Privacidad') }}</flux:heading>
                        <flux:text class="mt-2 mb-6 leading-relaxed">
                            <em>{{ __('Última actualización: 30 de enero de 2026') }}</em>
                        </flux:text>
                        <flux:text class="mb-4 leading-relaxed">En Neura, la protección de tus datos personales y la privacidad de tu empresa son nuestra máxima prioridad. Esta política describe cómo recopilamos, usamos, almacenamos y protegemos la información que nos proporcionas al utilizar nuestra plataforma de bienestar laboral, análisis inteligente y gestión de riesgos psicosociales.</flux:text>

                        <flux:heading size="lg" class="mb-2">1. Información que recopilamos</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Datos de registro y contacto (nombre, correo electrónico, empresa, departamento, etc.).</flux:text>
                            <flux:text>Respuestas a cuestionarios, tickets, alertas y cualquier información ingresada en la plataforma.</flux:text>
                            <flux:text>Datos de uso, actividad y navegación dentro de Neura.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">2. Uso de la información</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Brindar acceso seguro y personalizado a la plataforma.</flux:text>
                            <flux:text>Generar análisis, reportes y alertas automáticas para la mejora del bienestar laboral y cumplimiento normativo.</flux:text>
                            <flux:text>Gestionar tickets, notificaciones y comunicación interna.</flux:text>
                            <flux:text>Mejorar la experiencia de usuario y la seguridad de la plataforma.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">3. Protección y almacenamiento de datos</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Utilizamos medidas de seguridad técnicas y organizativas para proteger tus datos contra accesos no autorizados, pérdida o alteración.</flux:text>
                            <flux:text>El acceso a la información está restringido únicamente a personal autorizado y bajo estricta confidencialidad.</flux:text>
                            <flux:text>Los datos se almacenan en servidores seguros y se conservan solo el tiempo necesario para los fines descritos.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">4. Compartición de información</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>No compartimos tus datos personales con terceros, salvo obligación legal o consentimiento explícito.</flux:text>
                            <flux:text>En caso de integraciones con servicios externos (por ejemplo, Google Drive), se solicitará tu autorización previa.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">5. Derechos de los usuarios</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Puedes acceder, rectificar o eliminar tus datos personales en cualquier momento desde tu perfil o contactando a soporte.</flux:text>
                            <flux:text>Respetamos tu derecho a la privacidad y a la portabilidad de tus datos.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">6. Cambios en la política</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Neura puede actualizar esta política de privacidad para reflejar mejoras en la plataforma o cambios legales. Te notificaremos sobre cualquier modificación relevante.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">7. Contacto</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Si tienes dudas o deseas ejercer tus derechos, contáctanos en <a href="mailto:soporte@neura.com" class="text-primary underline">soporte@neura.com</a>.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">8. Uso informativo</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>La información y análisis generados por Neura tienen fines informativos y de apoyo al cumplimiento normativo. No constituyen asesoría profesional ni sustituyen la intervención de especialistas en recursos humanos o salud mental.</flux:text>
                        </ul>
                    </section>
                </main>
            </div>
            <div class="mt-16">
                <x-appearance.rightsreserved />
            </div>
        </flux:main>
    </section>
</x-layouts.application>
