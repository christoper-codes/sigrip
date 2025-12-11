<div>
    <div>
        <flux:heading size="lg">{{ __('Archivo base') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Puntos a considerar antes de subir el archivo de preguntas:') }}</flux:text>
        <ul class="text-sm opacity-70 space-y-2 mt-6">
            <li class="list-disc list-inside">{{ __('No se debe modificar el nombre ni el orden de las columnas.') }}</li>
            <li class="list-disc list-inside">{{ __('Las columnas deben estar en minúsculas y sin tildes.') }}</li>
            <li class="list-disc list-inside">{{ __('No dejes filas vacías entre preguntas.') }}</li>
            <li class="list-disc list-inside">{{ __('Puedes descargar la plantilla o un ejemplo para guiarte.') }}</li>
        </ul>
        <div x-data="{ openFaq: 1 }" class="max-w-4xl mx-auto space-y-4 z-20 relative mt-5">
            <div class="border border-neutral-500 dark:border-neutral-800 rounded-2xl overflow-hidden">
                <button @click="openFaq = openFaq === 0 ? -1 : 0" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 hover:bg-neutral-200/20 dark:hover:bg-neutral-900/20 transition-colors duration-500 cursor-pointer">
                    <flux:text>{{ __('Explicación detallada de cada columna del archivo a subir') }}</flux:text>
                    <flux:icon.plus x-show="openFaq !== 0" class="size-5 text-neutral-600 dark:text-neutral-400" />
                    <flux:icon.minus x-show="openFaq === 0" class="size-5 text-primary" />
                </button>
                <div x-show="openFaq === 0" class="px-6 pb-5">
                    <ul class="text-sm opacity-70 space-y-6">
                        <li class="list-disc list-inside">
                            <b>{{ __('tema') }}</b>: {{ __('Nombre del tema o categoría al que pertenece la pregunta. Ejemplo: "Bienestar general".') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('descripcion') }}</b>: {{ __('Breve descripción del tema. Ejemplo: "Evaluación de la satisfacción personal."') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('pregunta') }}</b>: {{ __('Texto de la pregunta que se presentará al usuario. Ejemplo: "¿Qué tan satisfecho/a estás con tu desempeño este mes?"') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('tipo de respuesta') }}</b>: {{ __('Indica el tipo de respuesta esperada. Puede ser "select" para opciones o "text" para respuesta abierta.') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('opciones y valores') }}</b>: {{ __('Lista de opciones y sus valores, separadas por punto y coma. Ejemplo: "1:Muy insatisfecho. 2:Insatisfecho. 3:Neutral. 4:Satisfecho. 5:Muy satisfecho". Dejar vacío si es respuesta abierta.') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('valores criticos') }}</b>: {{ __('Valores que se consideran críticos, separados por coma. Ejemplo: "1,2". Dejar vacío si es respuesta abierta.') }}
                        </li>
                        <li class="list-disc list-inside">
                            <b>{{ __('peso de pregunta') }}</b>: {{ __('Número que indica el peso o importancia de la pregunta en la evaluación. Ejemplo: "1".') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-5 flex items-center gap-3">
            <flux:button icon="arrow-down" wire:click='downloadTemplate' class="!w-full !max-w-xs !py-8 !border !border-primary !bg-primary/10 !rounded-2xl !text-sm !cursor-pointer hover:!bg-primary/5 !transition-colors !shadow-xl/50 !shadow-primary/20">
                {{ __('Descargar plantilla') }}
            </flux:button>
            <flux:button icon="arrow-down" wire:click='downloadExample' class="!w-full !max-w-xs !py-8 !border !border-fuchsia-500 !bg-fuchsia-500/10 !rounded-2xl !text-sm !cursor-pointer hover:!bg-fuchsia-500/5 !transition-colors !shadow-xl/50 !shadow-fuchsia-500/20">
                {{ __('Descargar ejemplo') }}
            </flux:button>
        </div>
    </div>
    <form wire:submit.prevent="submit" class="mt-14 space-y-6 px-5 py-6 lg:px-7 lg:py-7 bg-light-variant dark:bg-dark-variant border border-neutral-300 dark:border-neutral-700 rounded-xl">
        <flux:field>
            <flux:label>{{ __('Titulo') }}</flux:label>
            <flux:input name="title" wire:model="form.title" icon="cube" placeholder="{{ __('Plan de escaneo periodico') }}"/>
            <flux:error name="form.title" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Subtitulo') }}</flux:label>
            <flux:input name="subtitle" wire:model="form.subtitle" icon="cube-transparent" placeholder="{{ __('Evaluación de desempeño') }}"/>
            <flux:error name="form.subtitle" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Instrucciones') }}</flux:label>
            <flux:textarea name="instructions" resize="none" wire:model="form.instructions" placeholder="{{ __('Responde con sinceridad. No hay respuestas correctas o incorrectas.') }}"/>
            <flux:error name="form.instructions"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Categoría') }}</flux:label>
            <flux:select class="!h-12" name="questionnaire_category" wire:model="form.questionnaire_category">
                <flux:select.option value="" >{{ __('Selecciona una categoria') }}</flux:select.option>
                 @foreach($form->questionnaire_categories as $category)
                    <flux:select.option value="{{ $category['id'] }}">{{ $category['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="form.questionnaire_category" />
        </flux:field>
         <flux:field>
            <flux:label>{{ __('Objetivos') }}</flux:label>
            <div class="lg:col-span-2" x-data="{ objectives: @entangle('form.objectives') }">
                <div class="flex flex-col gap-2">
                    <template x-for="(objetive, index) in objectives" :key="index">
                        <div class="flex items-center gap-2 !max-w-2xl">
                            <flux:input x-model="objectives[index]" placeholder="Activar alertas automáticas si aplica" icon="light-bulb"/>
                            <flux:button icon="x-mark" icon:variant="outline" class="py-6! px-6!" x-on:click="objectives.splice(index, 1)" x-bind:disabled="objectives.length == 1" />
                        </div>
                    </template>
                </div>
                <flux:button icon="plus" variant="filled" x-on:click="objectives.push('')" class="px-4 py-4 mt-3">
                    <span>{{ __('Agregar objetivo') }}</span>
                </flux:button>
                <flux:error name="form.objectives" />
            </div>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Risk de evaluación') }}</flux:label>
            <div>
                <div class="flex items-center gap-x-2">
                    <div class="size-4 bg-yellow-500 rounded"></div>
                    <flux:text>{{ __('Evaluación de riesgo \'Yellow\'') }}</flux:text>
                </div>
                <div class="lg:col-span-2 mt-2 w-full" x-data="{ yellowRiskEvaluation: @entangle('form.yellow_risk_evaluation') }">
                    <div class="flex flex-col gap-2 w-full">
                        <template x-for="(risk, index) in yellowRiskEvaluation" :key="index">
                            <div class="flex items-start gap-2 !max-w-2xl w-full">
                                <div class="flex flex-col gap-2 w-full">
                                    <flux:input x-model="yellowRiskEvaluation[index].label" placeholder="Riesgo moderado" icon="light-bulb" />
                                    <flux:input x-model="yellowRiskEvaluation[index].criteria" placeholder="Promedio entre 3.0 y 3.9 o 1 respuesta crítica" icon="exclamation-triangle" />
                                </div>
                                <flux:button icon="x-mark" icon:variant="outline" class="py-6! px-6!" x-on:click="yellowRiskEvaluation.splice(index, 1)" x-bind:disabled="yellowRiskEvaluation.length == 1"/>
                            </div>
                        </template>
                    </div>
                    <flux:button icon="plus" variant="filled" x-on:click="yellowRiskEvaluation.push({ label: '', criteria: '' })" class="px-4 py-4 mt-3">
                        <span>{{ __('Agregar evaluación') }}</span>
                    </flux:button>
                    <flux:error name="form.yellow_risk_evaluation" />
                </div>
            </div>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Risk de evaluación') }}</flux:label>
            <div>
                <div class="flex items-center gap-x-2">
                    <div class="size-4 bg-red-500 rounded"></div>
                    <flux:text>{{ __('Evaluación de riesgo \'Red\'') }}</flux:text>
                </div>
                <div class="lg:col-span-2 mt-2 w-full" x-data="{ redRiskEvaluation: @entangle('form.red_risk_evaluation') }">
                    <div class="flex flex-col gap-2 w-full">
                        <template x-for="(risk, index) in redRiskEvaluation" :key="index">
                            <div class="flex items-start gap-2 !max-w-2xl w-full">
                                <div class="flex flex-col gap-2 w-full">
                                    <flux:input x-model="redRiskEvaluation[index].label" placeholder="Riesgo alto" icon="light-bulb" />
                                    <flux:input x-model="redRiskEvaluation[index].criteria" placeholder="Promedio entre 1.0 y 2.9 o 1 respuesta crítica" icon="exclamation-triangle" />
                                </div>
                                <flux:button icon="x-mark" icon:variant="outline" class="py-6! px-6!" x-on:click="redRiskEvaluation.splice(index, 1)" x-bind:disabled="redRiskEvaluation.length == 1"/>
                            </div>
                        </template>
                    </div>
                    <flux:button icon="plus" variant="filled" x-on:click="redRiskEvaluation.push({ label: '', criteria: '' })" class="px-4 py-4 mt-3">
                        <span>{{ __('Agregar evaluación') }}</span>
                    </flux:button>
                    <flux:error name="form.red_risk_evaluation" />
                </div>
            </div>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Subir archivo de preguntas') }}</flux:label>
            <flux:input type="file" name="form.questionnaire_file" wire:model="form.questionnaire_file" accept=".xlsx, .csv" />
            <div wire:loading wire:target="form.questionnaire_file">
                <div class="flex items-center gap-1">
                    <flux:icon.loading class="size-3"/>
                    <flux:text class="!text-xs">{{ __('Cargando archivo') }}</flux:text>
                </div>
            </div>
            <flux:error name="form.questionnaire_file" class="!mt-0"/>
        </flux:field>
         @if($form->import_errors)
            <div class="flex items-start gap-2">
                <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                <flux:text class="!text-red-500">{{ $form->import_errors }}</flux:text>
            </div>
        @endif

        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>
</div>
