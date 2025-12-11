<div>
     <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre del cuestionario') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $questionnaire_item)
                <tr>
                    <td class="p-4">{{ $questionnaire_item['name'] }}</td>
                    <td class="p-4">{{ $questionnaire_item['category']['name'] }}</td>
                    <td class="p-4">{{ $questionnaire_item['category']['description'] }}</td>
                    <td class="p-4">
                        <flux:button
                            variant="filled"
                            wire:click="showDetails({{ $questionnaire_item['id'] }})">
                            {{ __('Ver detalles') }}
                        </flux:button>
                    </td>
                    <td class="p-4">
                        <flux:button
                            variant="filled"
                            wire:click="showRiskDetails({{ $questionnaire_item['id'] }})">
                            {{ __('Ver detalles') }}
                        </flux:button>
                    </td>
                    <td class="p-4">{{ $questionnaire_item['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge :status="$questionnaire_item['is_active'] ? 'active' : 'inactive'" />
                    </td>
                    <td class="p-4">
                        @if($questionnaire_item['is_base'])
                            <flux:field variant="inline">
                                <flux:switch checked disabled />
                            </flux:field>
                        @else
                            <flux:field variant="inline">
                                <flux:switch wire:click="updateStatus({{ $questionnaire_item['id'] }})" :checked="(bool) $questionnaire_item['is_active']" />
                            </flux:field>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <flux:button variant="filled" icon="pencil" wire:click="editQuestionnaire({{ $questionnaire_item['id'] }})" />
                            <flux:button variant="danger" icon="trash" wire:click="confirmDestroy('{{ $questionnaire_item['name'] }}', {{ $questionnaire_item['id'] }})" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>

     <flux:modal name="questionnaire-details-modal" class="w-[90%] lg:w-full!">
        <div class="space-y-4">
            <div>
                <flux:heading size="xl">{{ $questionnaire_data['title'] ?? '' }}</flux:heading>
                <flux:text class="mt-1">{{ $questionnaire_data['subtitle'] ?? '' }}</flux:text>
            </div>

            <div>
                <flux:heading size="lg">{{ __('Preguntas separadas por temas') }}</flux:heading>
                <flux:text class="mt-1">{{ __('Total: ') . $total_questions }}</flux:text>
                <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
                    @foreach($questionnaire_data['themes'] ?? [] as $theme)
                        <div class="mb-4">
                            <flux:heading size="lg" class="text-primary!">{{ $theme['name'] ?? '' }}</flux:heading>
                            <flux:text class="mb-3!">{{ $theme['description'] ?? '' }}</flux:text>
                            <ul class="list-decimal ml-6">
                                @foreach($theme['questions'] ?? [] as $question)
                                    <li class="mb-2">
                                        <p class="text-sm">{{ $question['text'] ?? '' }}</p>
                                        @if(!empty($question['options']))
                                            <ul class="list-disc ml-6 text-xs">
                                                @foreach($question['options'] as $option)
                                                    <li>
                                                        <flux:text>{{ $option['label'] }} ({{ $option['value'] }})</flux:text>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <ul class="list-disc ml-6 text-xs">
                                                <li>
                                                    <flux:text>{{ __('Pregunta abierta') }}</flux:text>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="questionnaire-risk-modal" class="w-[90%] lg:w-full!">
        <div class="space-y-4">
             <div>
                <flux:heading size="xl">{{ $questionnaire_data['title'] ?? '' }}</flux:heading>
                <flux:text class="mt-1">{{ $questionnaire_data['subtitle'] ?? '' }}</flux:text>
            </div>
            <div>
                <flux:heading size="lg">{{ __('Objetivos') }}</flux:heading>
                <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
                    <ul class="list-disc ml-6 text-xs">
                        @foreach($questionnaire_data['objectives'] ?? [] as $objective)
                            <li>
                                <flux:text>{{ $objective }}</flux:text>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <flux:heading size="lg">{{ __('Instrucciones') }}</flux:heading>
                <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
                    <ul class="list-disc ml-6 text-xs">
                        <li>
                            <flux:text>{{ $questionnaire_data['instructions'] ?? '' }}</flux:text>
                        </li>
                    </ul>
                </div>
            </div>
            <div>
                <flux:heading size="lg">{{ __('Evaluación de riesgo') }}</flux:heading>
                <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
                    @foreach($color_order as $color)
                        @if(isset($questionnaire_data['risk_evaluation'][$color]))
                            @foreach($questionnaire_data['risk_evaluation'][$color] as $risk)
                                <div class="mb-5">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="size-3.5 rounded
                                            @if($color == 'red') bg-red-500
                                            @elseif($color == 'yellow') bg-yellow-500
                                            @elseif($color == 'green') bg-green-500
                                            @endif
                                        "></div>
                                        <p class="font-semibold capitalize text-xs">{{ $color }}:</p>
                                    </div>
                                    <flux:text>{{ $risk['label'] ?? '' }} ({{ $risk['criteria'] ?? '' }})</flux:text>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="destroy-questionnaire-modal" class="w-[90%] md:max-w-md!">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de que deseas eliminar este cuestionario?') }}</flux:heading>
                <flux:text class="mt-3 font-semibold">{{ $questionnaire_name }}</flux:text>
            </div>
            <div class="flex gap-2">
                 <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                <flux:button variant="danger" wire:click="destroy">
                    {{ __('Eliminar') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-questionnaire-modal" class="w-[90%] md:w-2xl!" @close="editModalClosed()">
        <form wire:submit.prevent="confirmUpdateQuestionnaire" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Editar cuestionario') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Actualizar los detalles y guardar los cambios.') }}</flux:text>
            </div>
            @if($questionnaire && $questionnaire->is_base)
                <flux:callout color="yellow" icon="information-circle" heading="{{ __('Los questionarios bases no se pueden editar, solo los personalizados') }}" />
            @endif
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
                @if($form->questionnaire_file_path)
                    <flux:link href="{{ asset('storage/' . $form->questionnaire_file_path) }}" external class="text-sm! text-primary">
                        {{ __('Descargar archivo original') }}
                    </flux:link>
                @endif
                <flux:error name="form.questionnaire_file" class="!mt-0"/>
            </flux:field>
            @if($form->import_errors)
                <div class="flex items-start gap-2">
                    <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                    <flux:text class="!text-red-500">{{ $form->import_errors }}</flux:text>
                </div>
            @endif
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                @if($questionnaire && $questionnaire->is_base)
                    <flux:button disabled variant="primary">{{ __('Actualizar') }}</flux:button>
                @else
                    <flux:button type="submit" variant="primary">{{ __('Actualizar') }}</flux:button>
                @endif
            </div>
        </form>
    </flux:modal>
</div>
