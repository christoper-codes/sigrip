<x-layouts.application :title="__('Terminos de uso')">
    <section id="application-show" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="absolute left-0 lg:hidden top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
            <div class="absolute hidden lg:block right-0 top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
            <div>
                <div class="flex items-center justify-between relative">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-app-logo-icon class="w-24"/>
                    </a>
                    <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer size-7! border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center!">
                        <x-icon.sun variant="mini" class="size-4! text-dark! dark:text-light!"/>
                    </flux:link>
                </div>
                <main>
                    <section>
                        <a href="{{ route('terms-of-use') }}" wire:navigate>
                            {{ __('Terminos de uso') }}
                        </a>
                        <a href="{{ route('terms-of-use') }}" wire:navigate>
                            {{ __('Terminos de uso') }}
                        </a>
                    </section>
                    <section>
                        <h1 class="text-3xl font-bold mb-6">{{ __('Política de Privacidad') }}</h1>
                        <p class="mb-4">En Neura, la protección de tus datos personales y la privacidad de tu empresa son nuestra máxima prioridad. Esta política describe cómo recopilamos, usamos, almacenamos y protegemos la información que nos proporcionas al utilizar nuestra plataforma de bienestar laboral, análisis inteligente y gestión de riesgos psicosociales.</p>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">1. Información que recopilamos</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Datos de registro y contacto (nombre, correo electrónico, empresa, departamento, etc.).</li>
                            <li>Respuestas a cuestionarios, tickets, alertas y cualquier información ingresada en la plataforma.</li>
                            <li>Datos de uso, actividad y navegación dentro de Neura.</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">2. Uso de la información</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Brindar acceso seguro y personalizado a la plataforma.</li>
                            <li>Generar análisis, reportes y alertas automáticas para la mejora del bienestar laboral y cumplimiento normativo.</li>
                            <li>Gestionar tickets, notificaciones y comunicación interna.</li>
                            <li>Mejorar la experiencia de usuario y la seguridad de la plataforma.</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">3. Protección y almacenamiento de datos</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Utilizamos medidas de seguridad técnicas y organizativas para proteger tus datos contra accesos no autorizados, pérdida o alteración.</li>
                            <li>El acceso a la información está restringido únicamente a personal autorizado y bajo estricta confidencialidad.</li>
                            <li>Los datos se almacenan en servidores seguros y se conservan solo el tiempo necesario para los fines descritos.</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">4. Compartición de información</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>No compartimos tus datos personales con terceros, salvo obligación legal o consentimiento explícito.</li>
                            <li>En caso de integraciones con servicios externos (por ejemplo, Google Drive), se solicitará tu autorización previa.</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">5. Derechos de los usuarios</h2>
                        <ul class="list-disc pl-6 mb-4">
                            <li>Puedes acceder, rectificar o eliminar tus datos personales en cualquier momento desde tu perfil o contactando a soporte.</li>
                            <li>Respetamos tu derecho a la privacidad y a la portabilidad de tus datos.</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">6. Cambios en la política</h2>
                        <p class="mb-4">Neura puede actualizar esta política de privacidad para reflejar mejoras en la plataforma o cambios legales. Te notificaremos sobre cualquier modificación relevante.</p>

                        <h2 class="text-2xl font-semibold mt-8 mb-2">7. Contacto</h2>
                        <p>Si tienes dudas o deseas ejercer tus derechos, contáctanos en <a href="mailto:soporte@neura.com" class="text-primary underline">soporte@neura.com</a>.</p>
                    </section>
                </main>
            </div>
            <div class="mt-40">
                <x-appearance.rightsreserved />
            </div>
        </flux:main>
    </section>
</x-layouts.application>
