<x-layouts.application :title="__('Terminos de uso')">
    <section id="application-show" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="absolute left-0 lg:hidden top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
            <div class="absolute hidden lg:block right-0 top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
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
                                'opacity-50 pl-4 py-2 border-l-2 border-l-transparent' => !request()->routeIs('terms.use'),
                                'opacity-100 pl-4 py-2 border-l-2 border-l-yellow-500' => request()->routeIs('terms.use')
                            ])>
                            {{ __('Terminos de uso') }}
                        </a>
                        <a href="{{ route('privacy.policy') }}" wire:navigate
                            @class([
                                'opacity-50 pl-4 py-2 border-l-2 border-l-transparent' => !request()->routeIs('privacy.policy'),
                                'opacity-100 pl-4 py-2 border-l-2 border-l-yellow-500' => request()->routeIs('privacy.policy')
                            ])>
                            {{ __('Política de privacidad') }}
                        </a>
                    </section>
                    <section class="w-full lg:w-[80%]">
                        <flux:heading size="xl">{{ __('Términos de Uso') }}</flux:heading>
                        <flux:text class="mt-2 mb-6 leading-relaxed">
                            <em>{{ __('Última actualización: 30 de enero de 2026') }}</em>
                        </flux:text>
                        <flux:text class="mb-4 leading-relaxed">
                            Bienvenido a Neura. Al acceder y utilizar nuestra plataforma, aceptas cumplir con los siguientes términos y condiciones. Por favor, léelos cuidadosamente antes de utilizar nuestros servicios.
                        </flux:text>

                        <flux:heading size="lg" class="mb-2">1. Uso de la plataforma</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>La plataforma Neura está destinada exclusivamente para la gestión del bienestar laboral, análisis inteligente y cumplimiento normativo en empresas.</flux:text>
                            <flux:text>El usuario se compromete a utilizar la plataforma de manera ética, legal y conforme a los fines para los que fue diseñada.</flux:text>
                            <flux:text>Está prohibido el uso de Neura para actividades ilícitas, fraudulentas o que atenten contra la privacidad y derechos de terceros.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">2. Registro y cuentas de usuario</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Para acceder a ciertas funciones, es necesario crear una cuenta proporcionando información verídica y actualizada.</flux:text>
                            <flux:text>El usuario es responsable de mantener la confidencialidad de sus credenciales y de todas las actividades realizadas desde su cuenta.</flux:text>
                            <flux:text>Neura se reserva el derecho de suspender o eliminar cuentas que incumplan estos términos.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">3. Propiedad intelectual</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Todos los contenidos, marcas, logotipos, software y materiales de la plataforma son propiedad exclusiva de Neura o de sus licenciantes.</flux:text>
                            <flux:text>Está prohibida la reproducción, distribución o modificación de cualquier contenido sin autorización expresa.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">4. Responsabilidad y limitaciones</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Neura no se hace responsable por daños directos o indirectos derivados del uso o imposibilidad de uso de la plataforma.</flux:text>
                            <flux:text>El usuario es responsable de la veracidad de la información proporcionada y del uso adecuado de los datos y reportes generados.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">5. Modificaciones y vigencia</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Neura puede actualizar estos términos en cualquier momento. Se notificará a los usuarios sobre cambios relevantes.</flux:text>
                            <flux:text>El uso continuado de la plataforma implica la aceptación de los términos actualizados.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">6. Contacto</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Para consultas sobre estos términos, contáctanos en <a href="mailto:soporte@neura.com" class="text-primary underline">soporte@neura.com</a>.</flux:text>
                        </ul>

                        <flux:heading size="lg" class="mb-2">7. Uso informativo y limitación de responsabilidad</flux:heading>
                        <ul class="list-disc pl-6 mb-4 flex flex-col gap-2">
                            <flux:text>Neura es una herramienta tecnológica de apoyo para el cumplimiento de la NOM-035 y la gestión del bienestar laboral. No constituye asesoría psicológica, médica ni legal, ni sustituye la intervención de profesionales en recursos humanos o salud mental.</flux:text>
                            <flux:text>Las recomendaciones, análisis y reportes generados por la plataforma son de carácter informativo y no deben ser considerados como diagnósticos ni decisiones definitivas para la gestión de personal.</flux:text>
                            <flux:text>El usuario y la empresa son responsables de validar y complementar la información proporcionada por Neura antes de tomar decisiones que afecten a empleados o procesos internos.</flux:text>
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
