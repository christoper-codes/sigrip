<section id="pricing">
    <x-main-container>
        <div class="mt-52 text-center flex flex-col gap-6 items-center justify-center mb-16">
            <h1 class="text-4xl">
                {{ __('Planes adaptados ') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('para ti') }}</span>
            </h1>
            <p class="opacity-70 max-w-3xl">
                {{ __('Adaptados para mejorar el bienestar laboral, prevenir riesgos psicosociales y evitar demandas costosas.') }}
            </p>
            <div>
                <flux:radio.group variant="segmented">
                    <flux:radio label="Mensual" checked/>
                    <flux:radio label="Anual" />
                </flux:radio.group>
            </div>
        </div>
        <div class="mt-10 flex items-center justify-center">
            <div class="h-[620px] rounded-4xl border border-primary w-96 p-7 flex flex-col gap-7 justify-center">
                <div class="flex flex-col gap-5">
                    <div class="py-2 px-4 rounded-full text-xs border border-neutral-800 inline-block bg-gradient-to-b from-dark to-neutral-800 self-start text-center">
                        {{ __('Premium') }}
                    </div>
                    <p class="text-4xl font-extrabold">
                        $2,000<span class="text-lg font-medium"> /{{ __('mes') }}</span>
                    </p>
                    <p class="opacity-70 leading-relaxed text-sm">
                        {{ __('Lo mejor para empezar. Solución completa y potente que escala contigo.') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Todo lo que incluye el plan pro') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Cuestionarios ilimitados') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Integración Google Drive') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Empleados ilimitados') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Departamentos ilimitados') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Módulo de tickets psicosociales') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Predicción IA de problemas') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('API de integración') }}</span>
                        </li>
                    </ul>
                </div>

                <flux:button variant="primary" class="btn">
                    {{ __('Comenzar prueba gratuita') }}
                </flux:button>
            </div>
            <div class="h-[560px] rounded-l rounded-r-4xl border border-neutral-800 w-96 p-7 flex flex-col justify-center gap-7">
                <div class="flex flex-col gap-5">
                    <div class="py-2 px-4 rounded-full text-xs border border-neutral-800 inline-block bg-gradient-to-b from-dark to-neutral-800 self-start text-center">
                        {{ __('Pro') }}
                    </div>
                    <p class="text-4xl font-extrabold">
                        $1,500<span class="text-lg font-medium"> /{{ __('mes') }}</span>
                    </p>
                    <p class="opacity-70 leading-relaxed text-sm">
                        {{ __('Comienza con potencia. Todo lo esencial para cumplir NOM-035 desde hoy.') }}
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('3 cuestionarios NOM-035 incluidos') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('2 cuestionarios onboarding incluidos') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Análisis inteligente con IA') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Exportación inteligente de resultados') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Notificaciones en tiempo real') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Soporte 24/7') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Cuestionarios personalizados') }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <flux:icon.check class="size-4 text-primary" />
                            <span class="text-sm">{{ __('Hasta 35 empleados y 4 departamentos') }}</span>
                        </li>
                    </ul>
                </div>
                <flux:button variant="primary" class="btn">
                    {{ __('Comenzar prueba gratuita') }}
                </flux:button>
            </div>
        </div>

        <div class="h-screen w-full">

        </div>
    </x-main-container>
</section>
