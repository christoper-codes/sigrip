<div class="relative">
    <section class="mt-10">
        <div
            x-data="{
                greeting: '',
                init() {
                    const hour = new Date().getHours();
                    if (hour >= 5 && hour < 12) {
                        this.greeting = '{{ __('Buenos días') }}';
                    } else if (hour >= 12 && hour < 18) {
                        this.greeting = '{{ __('Buena tarde') }}';
                    } else {
                        this.greeting = '{{ __('Buena noche') }}';
                    }
                }
            }">
            <flux:text>
                <span class="text-primary" x-text="greeting"></span>
                @auth
                    <span> {{ auth()->user()->name }} </span>
                @else
                    <span>{{ __('usuario sigrip') }}</span>
                @endauth
            </flux:text>
        </div>
        <div class="space-y-4">
            <div class="py-2 px-4 mt-16 rounded-full text-center text-sm border bg-light-variant dark:bg-dark-variant/50 border-neutral-300 dark:border-neutral-700 inline-block mx-auto">
                {{ $company_name }}
            </div>
            <h1 class="text-4xl max-w-4xl uppercase">
                {{ $questionnaire['name'] }}</span>
            </h1>
            <flux:text class="mt-2">
                {{ __('Solo tomara unos minutos. Tu opinión impulsa nuestra mejora continua.') }}
            </flux:text>
        </div>
        <div class="space-y-4 mt-14">
            <div class="flex items-center gap-1">
                <flux:icon.briefcase variant="mini"/>
                <flux:text>
                    {{ __('Departamento: ') . $department_name }}
                </flux:text>
            </div>
            <div class="flex items-center gap-1">
                <flux:icon.clock variant="mini"/>
                <flux:text>
                    {{ __('Expiración: ') . (dateFormat($application['expiration_date']) ??  __('Sin limite.')) }}
                </flux:text>
            </div>
        </div>
        <div class="mt-14 flex flex-col lg:flex-row lg:flex-wrap lg:items-center justify-start gap-3 max-w-4xl">
            @foreach ($questionnaire['metadata']['instructions'] as $instruction)
                <div class="py-2 px-4 rounded-full text-center text-xs lg:text-sm border bg-light-variant dark:bg-dark-variant border-neutral-300 dark:border-neutral-700 lg:w-max">
                    <span class="inline">
                        {{ __($instruction) }}
                    </span>
                </div>
            @endforeach
        </div>
    </section>
    @if($is_visitor)
        <section class="mt-14 max-w-lg">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('Estás accediendo a esta aplicación como visitante') }}" />
        </section>
    @endif

    @if($application->employee_data_required && ! $employee_data_submitted)
        <section class="mt-20">
            <div class="p-5 my-7 rounded-2xl border border-light-variant dark:border-dark-variant bg-light-variant dark:bg-dark-variant">
                <flux:heading size="lg" class="text-primary">{{ __('Datos laborales requeridos') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Por favor, completa tus datos laborales antes de continuar.') }}</flux:text>
                <flux:modal.trigger name="employee-data-modal">
                    <flux:button variant="primary" class="mt-6">{{ __('Comenzar') }}</flux:button>
                </flux:modal.trigger>
            </div>

            <flux:modal name="employee-data-modal" flyout variant="floating" class="md:w-lg">
                <flux:heading size="lg">{{ __('Datos laborales') }}</flux:heading>
                <flux:subheading>{{ __('Por favor, completa tus datos laborales antes de continuar.') }}</flux:subheading>

                <form wire:submit.prevent="submitEmployeeData" class="space-y-6 mt-8">
                    <flux:field>
                        <flux:label>{{ __('Nombre completo') }}</flux:label>
                        <flux:input name="name" wire:model="form.name" icon="user" placeholder="{{ __('John Doe') }}"/>
                        <flux:error name="form.name" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Sexo') }}</flux:label>
                        <flux:select class="!h-12" name="sex" wire:model="form.sex">
                            <flux:select.option value="">{{ __('Seleccione un sexo') }}</flux:select.option>
                            <flux:select.option value="masculino">{{ __('Masculino') }}</flux:select.option>
                            <flux:select.option value="femenino">{{ __('Femenino') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.sex" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Edad en años') }}</flux:label>
                        <flux:select class="!h-12" name="age" wire:model="form.age">
                            <flux:select.option value="">{{ __('Seleccione un rango de edad') }}</flux:select.option>
                            <flux:select.option value="15-19">{{ __('15 - 19') }}</flux:select.option>
                            <flux:select.option value="20-24">{{ __('20 - 24') }}</flux:select.option>
                            <flux:select.option value="25-29">{{ __('25 - 29') }}</flux:select.option>
                            <flux:select.option value="30-34">{{ __('30 - 34') }}</flux:select.option>
                            <flux:select.option value="35-39">{{ __('35 - 39') }}</flux:select.option>
                            <flux:select.option value="40-44">{{ __('40 - 44') }}</flux:select.option>
                            <flux:select.option value="45-49">{{ __('45 - 49') }}</flux:select.option>
                            <flux:select.option value="50-54">{{ __('50 - 54') }}</flux:select.option>
                            <flux:select.option value="55-59">{{ __('55 - 59') }}</flux:select.option>
                            <flux:select.option value="60-64">{{ __('60 - 64') }}</flux:select.option>
                            <flux:select.option value="65-69">{{ __('65 - 69') }}</flux:select.option>
                            <flux:select.option value="70+">{{ __('70 o más') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.age" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Estado civil') }}</flux:label>
                        <flux:select class="!h-12" name="marital_status" wire:model="form.marital_status">
                            <flux:select.option value="">{{ __('Seleccione un estado civil') }}</flux:select.option>
                            <flux:select.option value="casado">{{ __('Casado') }}</flux:select.option>
                            <flux:select.option value="soltero">{{ __('Soltero') }}</flux:select.option>
                            <flux:select.option value="union libre">{{ __('Unión libre') }}</flux:select.option>
                            <flux:select.option value="divorciado">{{ __('Divorciado') }}</flux:select.option>
                            <flux:select.option value="viudo">{{ __('Viudo') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.marital_status" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Nivel de estudios') }}</flux:label>
                        <flux:select class="!h-12" name="education_level" wire:model="form.education_level">
                            <flux:select.option value="">{{ __('Seleccione un nivel de estudios') }}</flux:select.option>
                            <flux:select.option value="sin formacion">{{ __('Sin formación') }}</flux:select.option>
                            <flux:select.option value="primaria">{{ __('Primaria') }}</flux:select.option>
                            <flux:select.option value="secundaria">{{ __('Secundaria') }}</flux:select.option>
                            <flux:select.option value="preparatoria o bachillerato">{{ __('Preparatoria o Bachillerato') }}</flux:select.option>
                            <flux:select.option value="tecnico superior">{{ __('Técnico Superior') }}</flux:select.option>
                            <flux:select.option value="licenciatura">{{ __('Licenciatura') }}</flux:select.option>
                            <flux:select.option value="maestria">{{ __('Maestría') }}</flux:select.option>
                            <flux:select.option value="doctorado">{{ __('Doctorado') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.education_level" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Estado del nivel de estudios') }}</flux:label>
                        <flux:select class="!h-12" name="status_education_level" wire:model="form.status_education_level">
                            <flux:select.option value="">{{ __('Seleccione un estado del nivel de estudios') }}</flux:select.option>
                            <flux:select.option value="terminada">{{ __('Terminada') }}</flux:select.option>
                            <flux:select.option value="en curso">{{ __('En curso') }}</flux:select.option>
                            <flux:select.option value="incompleta">{{ __('Incompleta') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.status_education_level" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Puesto de trabajo') }}</flux:label>
                        <flux:input name="job_title" wire:model="form.job_title" icon="briefcase" placeholder="{{ __('Analista de datos') }}"/>
                        <flux:error name="form.job_title" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Departamento, Sección o Área') }}</flux:label>
                        <flux:input name="department" wire:model="form.department" icon="building-office" placeholder="{{ __('Recursos Humanos') }}"/>
                        <flux:error name="form.department" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de puesto') }}</flux:label>
                        <flux:select class="!h-12" name="job_type" wire:model="form.job_type">
                            <flux:select.option value="">{{ __('Seleccione un tipo de puesto') }}</flux:select.option>
                            <flux:select.option value="operativo">{{ __('Operativo') }}</flux:select.option>
                            <flux:select.option value="profesional o tecnico">{{ __('Profesional o técnico') }}</flux:select.option>
                            <flux:select.option value="supervisor">{{ __('Supervisor') }}</flux:select.option>
                            <flux:select.option value="gerente">{{ __('Gerente') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.job_type" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de contratación') }}</flux:label>
                        <flux:select class="!h-12" name="contract_type" wire:model="form.contract_type">
                            <flux:select.option value="">{{ __('Seleccione un tipo de contratación') }}</flux:select.option>
                            <flux:select.option value="por obra o proyecto">{{ __('Por obra o proyecto') }}</flux:select.option>
                            <flux:select.option value="por tiempo determinado (temporal)">{{ __('Por tiempo determinado (temporal)') }}</flux:select.option>
                            <flux:select.option value="tiempo indeterminado">{{ __('Tiempo indeterminado') }}</flux:select.option>
                            <flux:select.option value="honorarios">{{ __('Honorarios') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.contract_type" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de personal') }}</flux:label>
                        <flux:select class="!h-12" name="personnel_type" wire:model="form.personnel_type">
                            <flux:select.option value="">{{ __('Seleccione un tipo de personal') }}</flux:select.option>
                            <flux:select.option value="sindicalizado">{{ __('Sindicalizado') }}</flux:select.option>
                            <flux:select.option value="ninguno">{{ __('Ninguno') }}</flux:select.option>
                            <flux:select.option value="confianza">{{ __('Confianza') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.personnel_type" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de jornada de trabajo') }}</flux:label>
                        <flux:select class="!h-12" name="work_schedule_type" wire:model="form.work_schedule_type">
                            <flux:select.option value="">{{ __('Seleccione un tipo de jornada de trabajo') }}</flux:select.option>
                            <flux:select.option value="fijo nocturno (entre las 20:00 y 6:00 hrs)">{{ __('Fijo nocturno (entre las 20:00 y 6:00 hrs)') }}</flux:select.option>
                            <flux:select.option value="fijo diurno (entre las 6:00 y 20:00 hrs)">{{ __('Fijo diurno (entre las 6:00 y 20:00 hrs)') }}</flux:select.option>
                            <flux:select.option value="fijo mixto (combinación de nocturno y diurno)">{{ __('Fijo mixto (combinación de nocturno y diurno)') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.work_schedule_type" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Realiza rotación de turnos') }}</flux:label>
                        <flux:select class="!h-12" name="shift_rotation" wire:model="form.shift_rotation">
                            <flux:select.option value="">{{ __('Seleccione una opción') }}</flux:select.option>
                            <flux:select.option value="si">{{ __('Sí') }}</flux:select.option>
                            <flux:select.option value="no">{{ __('No') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.shift_rotation" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Experiencia (años). Tiempo en el puesto actual') }}</flux:label>
                        <flux:select class="!h-12" name="experience_current_job" wire:model="form.experience_current_job">
                            <flux:select.option value="">{{ __('Seleccione una opción') }}</flux:select.option>
                            <flux:select.option value="menos de 6 meses">{{ __('Menos de 6 meses') }}</flux:select.option>
                            <flux:select.option value="entre 6 meses y  1 año">{{ __('Entre 6 meses y  1 año') }}</flux:select.option>
                            <flux:select.option value="entre 1 a 4 años">{{ __('Entre 1 a 4 años') }}</flux:select.option>
                            <flux:select.option value="entre 5 a 9 años">{{ __('Entre 5 a 9 años') }}</flux:select.option>
                            <flux:select.option value="entre 10 a 14 años">{{ __('Entre 10 a 14 años') }}</flux:select.option>
                            <flux:select.option value="entre 15 a 19 años">{{ __('Entre 15 a 19 años') }}</flux:select.option>
                            <flux:select.option value="entre 20 a 24 años">{{ __('Entre 20 a 24 años') }}</flux:select.option>
                            <flux:select.option value="25 años o más">{{ __('25 años o más') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.experience_current_job" />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Experiencia (años). Tiempo experiencia laboral') }}</flux:label>
                        <flux:select class="!h-12" name="total_experience" wire:model="form.total_experience">
                            <flux:select.option value="">{{ __('Seleccione una opción') }}</flux:select.option>
                            <flux:select.option value="menos de 6 meses">{{ __('Menos de 6 meses') }}</flux:select.option>
                            <flux:select.option value="entre 6 meses y  1 año">{{ __('Entre 6 meses y  1 año') }}</flux:select.option>
                            <flux:select.option value="entre 1 a 4 años">{{ __('Entre 1 a 4 años') }}</flux:select.option>
                            <flux:select.option value="entre 5 a 9 años">{{ __('Entre 5 a 9 años') }}</flux:select.option>
                            <flux:select.option value="entre 10 a 14 años">{{ __('Entre 10 a 14 años') }}</flux:select.option>
                            <flux:select.option value="entre 15 a 19 años">{{ __('Entre 15 a 19 años') }}</flux:select.option>
                            <flux:select.option value="entre 20 a 24 años">{{ __('Entre 20 a 24 años') }}</flux:select.option>
                            <flux:select.option value="25 años o más">{{ __('25 años o más') }}</flux:select.option>
                        </flux:select>
                        <flux:error name="form.total_experience" />
                    </flux:field>

                    <flux:button type="submit" variant="primary">{{ __('Continuar') }}</flux:button>
                </form>
            </flux:modal>
        </section>
    @endif

    @if($employee_data_submitted)
        <div x-data="{ animation: false }"
            x-init="$nextTick(() => animation = true)"
            x-show="animation"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="mt-20">
            <section
                id="questionnaire-themes"
                style="scroll-margin-top: 70px;"
                x-data="{ first: true }"
                x-effect="
                    @this.theme_change;
                    if (!first) {
                        setTimeout(() => {
                            document.getElementById('questionnaire-themes').scrollIntoView({ behavior: 'auto', block: 'start' });
                        }, 100);
                    }
                    first = false;
                "
                >
                @if ($current_theme)
                    <div class="p-5 my-7 rounded-2xl border border-light-variant dark:border-dark-variant bg-light-variant dark:bg-dark-variant">
                        <flux:heading size="lg" class="text-primary">{{ __($current_theme['name']) }}</flux:heading>
                        @if (!empty($current_theme['description']))
                            <flux:text class="mt-2">{{ __($current_theme['description']) }}</flux:text>
                        @endif
                    </div>
                    <div class="flex flex-col gap-10">
                        @foreach ($current_theme['questions'] as $question)
                            <flux:field class="w-full">
                                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:gap-4">
                                    <flux:label>{{ __($question['text']) }}</flux:label>
                                    @if(in_array($question['id'], ['gr2_q42', 'gr2_q43', 'gr2_q44', 'gr3_q66', 'gr3_q67', 'gr3_q68', 'gr3_q69']))
                                        <div class="py-2 px-2 text-xs border-l-4 border-r-4 border-primary rounded-md">
                                            {{ __('Responder solo \'Sí\' debe brindar servicio a clientes o usuarios') }}
                                        </div>
                                    @endif
                                    @if(in_array($question['id'], ['gr2_q46', 'gr2_q47', 'gr2_q48', 'gr3_q71', 'gr3_q72', 'gr3_q73', 'gr3_q74']))
                                        <div class="py-2 px-2 text-xs border-l-4 border-r-4 border-primary rounded-md">
                                            {{ __('Responder solo \'Sí\' eres jefe de otros trabajadores') }}
                                        </div>
                                    @endif
                                </div>

                                @if (in_array($question['type'], ['select', 'radio_button']) && !empty($question['options']))
                                    <flux:radio.group
                                        name="answers.{{ $question['id'] }}"
                                        wire:model="answers.{{ $question['id'] }}"
                                        class="mt-2 ml-1"
                                    >
                                        @foreach ($question['options'] as $option)
                                            <flux:radio value="{{ $option['value'] }}" label="{{ $option['label'] }}" />
                                        @endforeach
                                    </flux:radio.group>
                                @elseif ($question['type'] === 'text')
                                    <flux:textarea
                                        name="answers.{{ $question['id'] }}"
                                        wire:model="answers.{{ $question['id'] }}"
                                        resize="none"
                                        class="mt-2 ml-1"
                                    />
                                @endif
                                <flux:error name="answers.{{ $question['id'] }}" class="!mt-0"/>
                            </flux:field>
                        @endforeach
                    </div>
                    <div class="mt-16 flex items-center gap-3">
                        <flux:button
                            icon="arrow-left"
                            variant="primary"
                            wire:click="prevTheme"
                            :disabled="$theme_index === 0"
                            >
                            {{ __('Anterior') }}
                        </flux:button>
                        @if ($theme_index === $theme_count - 1)
                            <flux:button
                                class="border! border-primary! bg-primary/10!"
                                wire:click="submit"
                            >
                                <span wire:loading.remove wire:target="submit" class="flex items-center gap-1.5">
                                    {{ __('Finalizar aplicación') }}
                                </span>
                                <span wire:loading wire:target="submit">
                                    <x-flux::icon.loading class="size-4! mx-[53.8px]!" />
                                </span>
                            </flux:button>
                        @else
                            <flux:button
                                icon:trailing="arrow-right"
                                variant="primary"
                                wire:click="nextTheme"
                                :disabled="$theme_index === $theme_count-1"
                            >
                                {{ __('Siguiente') }}
                            </flux:button>
                        @endif
                    </div>
                    @if($error_message)
                        <div class="flex items-start gap-2 mt-5">
                            <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                            <flux:text class="!text-red-500">{{ $error_message }}</flux:text>
                        </div>
                    @endif
                    <div class="flex mt-5">
                        <flux:text>{{ __('Preguntas ') }} {{ $current_questions }} {{ __(' de ') }} {{ $total_questions }}</flux:text>
                    </div>
                @endif
            </section>
        </div>
    @endif
</div>
