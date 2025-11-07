<section id="pricing">
    <x-main-container>
        <div x-data="{
                billing: 'Mensual',
                proPrice: 1500,
                premiumPrice: 2000,
                get proDisplayPrice() {
                    return this.billing === 'Mensual' ? this.proPrice : (this.proPrice * 10);
                },
                get premiumDisplayPrice() {
                    return this.billing === 'Mensual' ? this.premiumPrice : (this.premiumPrice * 10);
                },
                get billingLabel() {
                    return this.billing === 'Mensual' ? 'mes' : 'año';
                }
            }">
            <div class="mt-52 text-center flex flex-col gap-7 items-center justify-center mb-16">
                <div class="flex flex-col gap-3">
                    <div class="mx-auto py-2 px-4 rounded-full text-sm border border-neutral-800 inline-block bg-gradient-to-b from-dark to-neutral-800 self-start text-center">
                        {{ __('2 meses') }} <span class="text-primary">{{ __('gratis') }}</span> {{ __('en el plan anual') }}
                    </div>
                    <h1 class="text-4xl md:text-5xl">
                        {{ __('Planes adaptados ') }} <span class="[filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]"> {{ __('para ti') }}</span>
                    </h1>
                </div>
                <p class="opacity-70 max-w-4xl">
                    {{ __('Pensados para mejorar el bienestar laboral, prevenir riesgos psicosociales y evitar demandas costosas.') }}
                </p>
                <div>
                    <flux:radio.group variant="segmented">
                        <flux:radio label="Mensual" checked x-on:click="billing = 'Mensual'" class="!text-base"/>
                        <flux:radio label="Anual" x-on:click="billing = 'Anual'" class="!text-base"/>
                    </flux:radio.group>
                </div>
            </div>
            <div class="mt-10 flex flex-col md:flex-row gap-7 md:gap-0 items-center justify-center">
                <div class="h-full rounded-4xl border-2 border-primary w-full md:w-96 p-7 flex flex-col gap-7 justify-center">
                    <div class="flex flex-col gap-5">
                        <div class="py-2 px-4 rounded-full text-sm border border-neutral-800 inline-block bg-gradient-to-b from-dark to-neutral-800 self-start text-center">
                            {{ __('Premium') }}
                        </div>
                        <p class="text-4xl font-extrabold">
                            $<span x-text="premiumDisplayPrice.toLocaleString()"></span><span class="text-lg font-medium"> /<span x-text="billingLabel"></span></span>
                        </p>
                        <p class="opacity-70 leading-relaxed text-base">
                            {{ __('Lo mejor para empezar. Solución completa y potente que escala contigo.') }}
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Todo lo que incluye el plan pro') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Cuestionarios ilimitados') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Integración Google Drive') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Empleados ilimitados') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Departamentos ilimitados') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Módulo de tickets psicosociales') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Predicción IA de problemas') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('API de integración') }}</span>
                            </li>
                        </ul>
                    </div>

                    <flux:button variant="primary" class="btn !py-7">
                        {{ __('Comenzar prueba gratuita') }}
                    </flux:button>
                </div>
                <div class="h-full md:h-[605px] rounded-l-4xl md:rounded-l  rounded-r-4xl border-l-2 md:border-l-0 border-t-2 border-r-2 border-b-2 border-neutral-800 w-full md:w-96 p-7 flex flex-col justify-center gap-7">
                    <div class="flex flex-col gap-5">
                        <div class="py-2 px-4 rounded-full text-sm border border-neutral-800 inline-block bg-gradient-to-b from-dark to-neutral-800 self-start text-center">
                            {{ __('Pro') }}
                        </div>
                        <p class="text-4xl font-extrabold">
                            $<span x-text="proDisplayPrice.toLocaleString()"></span><span class="text-lg font-medium"> /<span x-text="billingLabel"></span></span>
                        </p>
                        <p class="opacity-70 leading-relaxed text-base">
                            {{ __('Comienza con potencia. Todo lo esencial para cumplir NOM-035 desde hoy.') }}
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('3 cuestionarios NOM-035 incluidos') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('2 cuestionarios onboarding incluidos') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Análisis inteligente con IA') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Exportación inteligente de resultados') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Notificaciones en tiempo real') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Soporte 24/7') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Cuestionarios personalizados') }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-base">
                                <flux:icon.check class="size-4 text-primary" />
                                <span>{{ __('Hasta 35 empleados y 4 departamentos') }}</span>
                            </li>
                        </ul>
                    </div>
                    <flux:button variant="primary" class="btn !py-7">
                        {{ __('Comenzar prueba gratuita') }}
                    </flux:button>
                </div>
            </div>
        </div>
    </x-main-container>
</section>
