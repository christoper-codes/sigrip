<x-layouts.app :title="__('Dashboard')">
    <div class="h-full w-full">
        <div x-data="{
                greeting: '',
                currentDateTime: new Date().toLocaleString('es-MX', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' }),
                init() {
                    const hour = new Date().getHours();
                    if (hour >= 5 && hour < 12) {
                        this.greeting = '{{ __('Buenos días,') }}';
                    } else if (hour >= 12 && hour < 18) {
                        this.greeting = '{{ __('Buenas tardes,') }}';
                    } else {
                        this.greeting = '{{ __('Buenas noches,') }}';
                    }
                }
            }">
            <div class="flex items-start justify-between">
                <div class="text-3xl leading-normal">
                    <span x-text="greeting"></span>
                    <br>
                    <span class="uppercase">{{ auth()->user()->name }}</span>
                    <br>
                    <span class="text-sm opacity-70" x-text="currentDateTime"></span>
                </div>
                <div class="hidden lg:block relative">
                    <div class="flex items-center justify-center p-3 rounded-full border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant">
                        <flux:icon.bell class="size-5"/>
                    </div>
                    <div class="absolute -top-1 -right-1 text-light bg-primary text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">
                        <span>{{ auth()->user()->metadata['notifications'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            @can('viewCompanyAdmin', auth()->user())
                <div class="mt-4">
                    <x-buttons.primary title="{{ __('Comenzar') }}"/>
                </div>
            @endcan
        </div>

        <div class="mt-10">
            <div x-data="{ selectedTab: 'steps' }" class="w-full">
                <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                    <button x-on:click="selectedTab = 'performance'" x-bind:aria-selected="selectedTab === 'performance'" x-bind:tabindex="selectedTab === 'performance' ? '0' : '-1'" x-bind:class="selectedTab === 'performance' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelPerformance">
                        <div class="flex items-center gap-2">
                            <flux:icon.chart-bar class="size-5" />
                            <span>{{ __('Performance') }}</span>
                        </div>
                    </button>
                    @can('viewCompanyAdmin', auth()->user())
                        <button x-on:click="selectedTab = 'steps'" x-bind:aria-selected="selectedTab === 'steps'" x-bind:tabindex="selectedTab === 'steps' ? '0' : '-1'" x-bind:class="selectedTab === 'steps' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelSteps">
                            <div class="flex items-center gap-2">
                                <flux:icon.cube class="size-5" />
                                <span>{{ __('Pasos faltantes') }}</span>
                            </div>
                        </button>
                    @endcan
                </div>
                <div class="px-2 mt-10">
                    <div x-cloak x-show="selectedTab === 'performance'" id="tabpanelPerformance" role="tabpanel" aria-label="performance">
                        <div class="w-full">
                            <div class="grid 2xl:min-h-[700px] gap-4 lg:grid-cols-3 lg:grid-rows-2">
                                <div class="relative lg:row-span-2">
                                    <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 lg:rounded-l-4xl"></div>
                                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                                    <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                                        <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">{{ __('Formularios adaptados') }}</p>
                                        <p class="mt-2 lg:max-w-lg text-sm/6 opacity-70 text-center lg:text-start">{{ __('Cada aplicación se adapta a cualquier dispositivo móvil, tableta y computadora de escritorio.') }}</p>
                                    </div>
                                    <div class="@container relative min-h-120 w-full grow max-lg:mx-auto max-lg:max-w-sm">
                                        <div class="absolute inset-x-10 top-10 bottom-0 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-neutral-800">
                                            <img src="/images/mobile-form-1.png" alt="" class="size-full object-cover object-top" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 lg:rounded-l-4xl"></div>
                                </div>
                                <div class="relative max-lg:row-start-1">
                                    <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 max-lg:rounded-t-4xl"></div>
                                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                        <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">{{ __('Velocidad') }}</p>
                                        <p class="mt-2 lg:max-w-lg text-sm/6 opacity-70 text-center lg:text-start">{{ __('Alertas y notificaciones en tiempo real para mantenerte informado sobre el rendimiento de tus aplicaciones.') }}</p>
                                    </div>
                                    <div class="py-8">
                                        <ul class="flex-1 flex gap-3 justify-center">
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                            <li class="rounded-full w-3 h-16 bg-linear-to-b from-cyan-500 to-blue-600"></li>
                                        </ul>
                                    </div>
                                    </div>
                                    <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 max-lg:rounded-t-4xl"></div>
                                </div>
                                <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                                    <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800"></div>
                                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
                                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                        <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">{{ __('Seguridad') }}</p>
                                        <p class="mt-2 lg:max-w-lg text-sm/6 opacity-70 text-center lg:text-start">{{ __('Todos los datos están protegidos con cifrado de extremo a extremo y backups automáticos.') }}</p>
                                    </div>
                                    <div class="flex items-center gap-3 justify-center py-8">
                                       <div class="p-3 rounded-full bg-light dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700">
                                           <flux:icon.cloud class="size-8 text-blue-500" />
                                       </div>
                                       <div class="p-3 rounded-full bg-light dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 shadow-xl shadow-blue-500/20">
                                           <flux:icon.shield-check class="size-12 text-blue-500" />
                                       </div>
                                       <div class="p-3 rounded-full bg-light dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700">
                                           <flux:icon.folder-open class="size-8 text-blue-500" />
                                       </div>
                                    </div>
                                    </div>
                                    <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15"></div>
                                </div>
                                <div class="relative lg:row-span-2">
                                    <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                                    <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
                                    <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                                        <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">{{ __('Potenciado por IA') }}</p>
                                        <p class="mt-2 lg:max-w-lg text-sm/6 opacity-70 text-center lg:text-start">{{ __('Motor de inteligencia artificial que monitorea continuamente las respuestas y comportamientos. Genera alertas y tickets preventivos cuando detecta riesgos psicosociales.') }}</p>
                                    </div>
                                    <div class="flex justify-center items-center pt-8">
                                        <div class="relative w-52 h-52">
                                            <svg class="w-52 h-52 transform -rotate-90" viewBox="0 0 36 36">
                                                <path class="text-gray-200 dark:text-gray-700" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                                                <path class="text-blue-600" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-dasharray="100, 100" stroke-dashoffset="0" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" style="animation: progress 6s ease-in-out;"></path>
                                            </svg>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <span class="font-semibold">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-8 pb-8 pt-8 sm:px-10 sm:pt-10 sm:pb-0">
                                        <p class="lg:max-w-lg text-sm/6 opacity-70 text-center lg:text-start">{{__('Previene demandas laborales, mejora clima organizacional y optimiza decisiones de RH basadas en datos.')}}</p>
                                    </div>
                                    </div>
                                    <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                     @can('viewCompanyAdmin', auth()->user())
                        <div x-cloak x-show="selectedTab === 'steps'" id="tabpanelSteps" role="tabpanel" aria-label="steps">
                            @php
                                $user = auth()->user();
                                $hasCompany = $user->company_id !== null;
                                $hasDepartment = $user->department_id !== null;
                                $currentStep = 1;

                                if ($hasCompany) $currentStep = 2;
                                if ($hasDepartment) $currentStep = 3;
                                // Agregar más condiciones según tus pasos
                            @endphp

                            <!-- Progress Steps -->
                            <div class="flex items-center gap-5 mb-10">
                                @for ($step = 1; $step <= 4; $step++)
                                    <div class="flex items-center">
                                        <div class="text-center flex items-center justify-center rounded-full size-10
                                            @if ($step < $currentStep)
                                                bg-green-500 text-white border-green-500
                                            @elseif ($step === $currentStep)
                                                bg-primary text-white border-primary
                                            @else
                                                bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700
                                            @endif">
                                            @if ($step < $currentStep)
                                                <flux:icon.check class="size-4" />
                                            @else
                                                <span>{{ $step }}</span>
                                            @endif
                                        </div>
                                        @if ($step < 4)
                                            <div class="w-12 h-0.5 mx-2 @if($step < $currentStep) bg-green-500 @else bg-neutral-300 dark:bg-neutral-700 @endif"></div>
                                        @endif
                                    </div>
                                @endfor
                            </div>

                            <!-- Step 1: Create Company -->
                            @if ($currentStep === 1)
                                <div class="max-w-2xl">
                                    <flux:heading size="xl">{{ __('Paso 1: Crea tu compañía') }}</flux:heading>
                                    <flux:text class="mt-2">{{ __('Completa el formulario para configurar tu cuenta y agregar departamentos.') }}</flux:text>
                                    <div class="mt-5">
                                        <livewire:company.store />
                                    </div>
                                </div>
                            @endif

                            <!-- Step 2: Create Department -->
                            @if ($currentStep === 2)
                                <div class="max-w-2xl">
                                    <flux:heading size="xl">{{ __('Paso 2: Crea un departamento') }}</flux:heading>
                                    <flux:text class="mt-2">{{ __('Completa el formulario para crear departamentos y usuarios. (Es necesario tener un departamento de RH)') }}</flux:text>
                                    <div class="mt-5">
                                        <livewire:department.store />
                                    </div>
                                </div>
                            @endif

                            <!-- Step 3: Setup Applications (Ejemplo) -->
                            @if ($currentStep === 3)
                                <div class="max-w-2xl">
                                    <flux:heading size="xl">{{ __('Paso 3: Configura aplicaciones') }}</flux:heading>
                                    <flux:text class="mt-2">{{ __('Configura las aplicaciones y formularios para tu organización.') }}</flux:text>
                                    <div class="mt-5">
                                        {{-- <livewire:application.store /> --}}
                                        <div class="p-6 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl text-center">
                                            <flux:icon.cog-6-tooth class="size-12 mx-auto mb-4 text-neutral-400" />
                                            <p class="text-neutral-600 dark:text-neutral-400">{{ __('Componente de aplicaciones próximamente') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Step 4: Complete Setup (Ejemplo) -->
                            @if ($currentStep === 4)
                                <div class="max-w-2xl">
                                    <div class="text-center p-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                                        <flux:icon.check-circle class="size-16 mx-auto mb-4 text-green-500" />
                                        <flux:heading size="xl" class="text-green-700 dark:text-green-300">{{ __('¡Configuración completada!') }}</flux:heading>
                                        <flux:text class="mt-2 text-green-600 dark:text-green-400">{{ __('Tu cuenta está lista para usar. Puedes comenzar a crear formularios y gestionar usuarios.') }}</flux:text>
                                        <div class="mt-6">
                                            <flux:button variant="primary" href="{{ route('dashboard') }}">{{ __('Ir al Dashboard') }}</flux:button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
