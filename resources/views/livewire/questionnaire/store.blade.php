<div>
    <div>
        <flux:heading size="lg">{{ __('Archivo base') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Puntos a considerar antes de subir el archivo de preguntas:') }}</flux:text>
        <ul class="text-sm opacity-70 space-y-2 mt-6">
            <li class="list-disc list-inside">{{ __('Columnas obligatorias (en minusculas sin tilde): ') }}</li>
        </ul>
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
            <flux:input name="title" wire:model="title" icon="cube" placeholder="{{ __('Plan de escaneo periodico') }}"/>
            <flux:error name="title" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Subtitulo') }}</flux:label>
            <flux:input name="subtitle" wire:model="subtitle" icon="cube-transparent" placeholder="{{ __('Evaluación de desempeño') }}"/>
            <flux:error name="subtitle" />
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Instrucciones') }}</flux:label>
            <flux:textarea name="instructions" resize="none" wire:model="instructions" placeholder="{{ __('Responde con sinceridad. No hay respuestas correctas o incorrectas.') }}"/>
            <flux:error name="instructions"/>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Categoría') }}</flux:label>
            <flux:select class="!h-12" name="questionnaire_category" wire:model="questionnaire_category">
                <flux:select.option value="" >{{ __('Selecciona una categoria') }}</flux:select.option>
                 @foreach($questionnaire_categoires as $category)
                    <flux:select.option value="{{ $category['id'] }}">{{ $category['name'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="questionnaire_category" />
        </flux:field>
         <flux:field>
            <flux:label>{{ __('Objetivos') }}</flux:label>
            <div class="lg:col-span-2" x-data="{ objectives: @entangle('objectives') }">
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
                <flux:error name="objectives" />
            </div>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Risk de evaluación') }}</flux:label>
            <div>
                <div class="flex items-center gap-x-2">
                    <div class="size-4 bg-yellow-500 rounded"></div>
                    <flux:text>{{ __('Evaluación de riesgo \'Yellow\'') }}</flux:text>
                </div>
                <div class="lg:col-span-2 mt-2 w-full" x-data="{ yellowRiskEvaluation: @entangle('yellow_risk_evaluation') }">
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
                    <flux:error name="yellow_risk_evaluation" />
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
                <div class="lg:col-span-2 mt-2 w-full" x-data="{ redRiskEvaluation: @entangle('red_risk_evaluation') }">
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
                    <flux:error name="red_risk_evaluation" />
                </div>
            </div>
        </flux:field>
        <flux:field>
            <flux:label>{{ __('Subir archivo de preguntas') }}</flux:label>
            <flux:input type="file" name="questionnaire_file" wire:model="questionnaire_file" accept=".xlsx, .csv" />
            <div wire:loading wire:target="questionnaire_file">
                <div class="flex items-center gap-1">
                    <flux:icon.loading class="size-3"/>
                    <flux:text class="!text-xs">{{ __('Cargando archivo') }}</flux:text>
                </div>
            </div>
            <flux:error name="questionnaire_file" class="!mt-0"/>
        </flux:field>
         @if($import_errors)
            <div class="flex items-start gap-2">
                <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                <flux:text class="!text-red-500">{{ $import_errors }}</flux:text>
            </div>
        @endif

        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </form>
</div>
