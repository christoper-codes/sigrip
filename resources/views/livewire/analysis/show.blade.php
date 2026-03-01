<div>
    <form wire:submit.prevent='searchApplications'>
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="h-12!" name="department" wire:model="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                            <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department" class="mt-0!"/>
            </flux:field>
            <flux:field class="max-w-32 w-full">
                <flux:label>{{ __('Total de registros') }}</flux:label>
                <flux:select class="h-12!" name="items_per_page" wire:model.live="items_per_page">
                    @foreach ($search_options as $option)
                        <flux:select.option value="{{ $option['value'] }}">{{ $option['label'] }}</flux:select.option>)
                    @endforeach
                </flux:select>
                <flux:error name="items_per_page" class="mt-0!"/>
            </flux:field>
        </div>
        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar aplicaciones') }}</flux:button>
   </form>

   @if($department && $table_items)
        <div x-data="{ animation: false }"
            x-init="$nextTick(() => animation = true)"
            x-show="animation"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            class="mt-10">
            <div class="mb-10">
                <flux:heading size="xl">{{ ucfirst(str_replace('-', ' ', explode('-', $application_data['slug'], -1) ? implode('-', explode('-', $application_data['slug'], -1)) : $application_data['slug'])) }}</flux:heading>
                <flux:text class="mt-2">{{ 'Inicio: ' . $application_data['start_date'] . ' - Término: ' . $application_data['expiration_date'] }}</flux:text>
                <ul class="list-disc ml-5">
                    <li class="mt-2">
                        <flux:link
                            class="text-xs! text-dark! dark:text-light!"
                            href="https://www.gob.mx/cms/uploads/attachment/file/540215/NORMA_Oficial_Mexicana_NOM-035-STPS-2018.pdf"
                            target="_blank"
                            >
                            {{ __('NORMA Oficial Mexicana NOM-035-STPS-2018') }}
                        </flux:link>
                    </li>
                </ul>
                <div class="mt-5 flex flex-col lg:flex-row items-center gap-3 max-w-md">
                    <flux:button icon="bolt" wire:click='showGeneralAnalysis' class="!w-full !py-6 !border  !border-primary !bg-primary/10 !rounded-xl !text-sm !cursor-pointer hover:!bg-primary/5 !transition-colors !shadow-xl/50 !shadow-primary/20">
                        {{ __('Análisis general') }}
                    </flux:button>
                    <flux:button icon="arrow-down" wire:click='downloadAllResults' class="!w-full !py-6 !border border-special! bg-special/10! !rounded-xl !text-sm !cursor-pointer hover:!bg-special/5 !transition-colors !shadow-xl/50 !shadow-special/20">
                        {{ __('Descargar resultados') }}
                    </flux:button>
                </div>
            </div>
            <x-appearance.livewiretable
                :headers="$headers"
                search_placeholder="{{ __('Nombre de empleado o ID de respuesta') }}"
                :total_results="$total_results"
                :current_page="$current_page"
                :total_pages="$total_pages"
                :paginated_items="$paginated_items"
                :sort_field="$sort_field"
                :sort_direction="$sort_direction"
                >
                <x-slot:table>
                    @foreach ($paginated_items as $response)
                        <tr>
                            <td class="p-4">{{ $response['uuid'] }}</td>
                            @if($questionnaire['name'] == \App\Enums\NomEnum::NOM_1->value || $questionnaire['name'] == \App\Enums\NomEnum::NOM_2->value || $questionnaire['name'] == \App\Enums\NomEnum::NOM_3->value)
                                <td class="p-4">{{ $response['classification']  }}</td>
                            @endif
                            <td class="p-4">{{ $response['employee_data']['name'] ?? 'Anónimo' }}</td>
                            <td class="p-4">
                                <flux:button wire:click="showResponses({{ $response['id'] }})" icon="clipboard-document-list" variant="primary">{{ __('Respuestas') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button wire:click="showAlerts({{ $response['id'] }})" icon="exclamation-triangle" variant="primary">{{ __('Alertas') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button wire:click="showAnalysisDepartment({{ $response['id'] }})" icon="building-office" class="border! border-primary! bg-primary/10!">{{ __('Análisis') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button wire:click="showAnalysisUser({{ $response['id'] }})" icon="user" class="border! border-primary! bg-primary/10!">{{ __('Análisis') }}</flux:button>
                            </td>
                            @if($questionnaire['name'] == \App\Enums\NomEnum::NOM_2->value || $questionnaire['name'] == \App\Enums\NomEnum::NOM_3->value)
                                <td class="p-4">
                                    <flux:button variant="filled" wire:click="showDomainRating({{ $response['id'] }})" icon="chart-bar">{{ __('Dominio') }}</flux:button>
                                </td>
                                <td class="p-4">
                                    <flux:button variant="filled" wire:click="showCategoryRating({{ $response['id'] }})" icon="chart-pie">{{ __('Categoría') }}</flux:button>
                                </td>
                            @endif
                            @if($questionnaire['name'] == \App\Enums\NomEnum::NOM_1->value || $questionnaire['name'] == \App\Enums\NomEnum::NOM_2->value || $questionnaire['name'] == \App\Enums\NomEnum::NOM_3->value)
                                <td class="p-4">
                                    <flux:button variant="filled" wire:click="showFinalScore({{ $response['id'] }})" icon="star">{{ __('Final') }}</flux:button>
                                </td>
                            @endif
                            <td class="p-4">{{ dateFormat($response['created_at']) }}</td>
                            <td class="p-4">
                                <flux:button variant="filled" wire:click="showEmployeeData({{ $response['id'] }})" icon="user">{{ __('Empleado') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button wire:click="downloadResults({{ $response['id'] }})" icon="arrow-down" variant="primary" class="text-dark! dark:text-light! border! border-special! bg-special/10!">{{ __('Descargar') }}</flux:button>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:table>
            </x-appearance.livewiretable>
        </div>
    @elseif($department && ! $table_items && $search_responses)
        <div class="mt-10 max-w-md w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('No hay respuestas para esta aplicación') }}" />
        </div>
    @else
        <div class="mt-10 max-w-md w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
        </div>
    @endif

    <flux:modal name="select-application" class="w-[90%] md:w-md space-y-7">
        <div>
            <flux:heading size="lg">{{ __('Seleccione una aplicación') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Ver resultados detallados') }}</flux:text>
        </div>
        <div>
            @if($applications)
                <flux:radio.group wire:model="application">
                    @foreach ($applications as $application)
                        <flux:radio
                            name="application"
                            value="{{ $application['id'] }}"
                            label="{{ ucfirst(str_replace('-', ' ', explode('-', $application['slug'], -1) ? implode('-', explode('-', $application['slug'], -1)) : $application['slug'])) }}"
                            description="{{'Inicio: ' . $application['start_date'] . ' - Término: ' . $application['expiration_date'] }}"
                        />
                    @endforeach
                </flux:radio.group>
                @if($application_error)
                    <div class="flex items-start gap-2 mt-2">
                        <flux:icon.exclamation-triangle class="text-red-500 size-5" />
                        <flux:text class="!text-red-500">{{ $application_error }}</flux:text>
                    </div>
                @endif
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cancelar') }}</flux:button>
            </flux:modal.close>
            <flux:button variant="primary" wire:click="resultApplication">{{ __('Buscar resultados') }}</flux:button>
        </div>
    </flux:modal>

    <flux:modal name="show-responses-modal" class="w-[90%] md:w-full space-y-7">
        <div class="space-y-3">
            <flux:heading size="xl">{{ __('Preguntas y respuestas') }}</flux:heading>
            <flux:text>{{ __('Listadas por temas') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($all_responses)
                @foreach($all_responses as $theme)
                    <div class="mb-4">
                        <flux:heading size="lg" class="text-primary!">{{ $theme['theme_name'] }}</flux:heading>
                        <flux:text class="mb-3!">{{ $theme['theme_description'] }}</flux:text>
                        <ul class="ml-2">
                            @foreach($theme['questions'] as $q)
                                <li class="mb-4">
                                    <div class="text-sm font-semibold flex items-start gap-2">
                                        <p>{{ $q['id'] }}</p>
                                        <span>-</span>
                                        <p>{{ $q['question'] }}</p>
                                    </div>

                                    <ul class="list-disc ml-6 mt-1 text-sm opacity-75">
                                        <li>
                                            @if($q['answer'])
                                                <span>{{ $q['answer'] }}</span>
                                            @else
                                                <span>{{ __('Sin respuesta') }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-alerts-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Respuestas críticas') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Se recomiendan tomar acciones basadas en estas respuestas críticas') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($alert_responses)
                @foreach($alert_responses as $theme)
                    <flux:heading size="lg" class="text-primary!">
                        {{ $theme['theme_name'] }}
                    </flux:heading>

                    <ul class="ml-2 mt-2">
                        @foreach($theme['questions'] as $alert)
                            <li class="mb-4">
                                <div class="text-sm font-semibold flex items-start gap-2">
                                    <p>{{ $alert['id'] }}</p>
                                    <span>-</span>
                                    <p>{{ $alert['question'] }}</p>
                                </div>

                                <ul class="list-disc ml-6 mt-1 text-sm opacity-75">
                                    <li>
                                        @if($alert['label'])
                                            <span>{{ $alert['label'] }}</span>
                                        @else
                                            <span>{{ __('Sin respuesta') }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @else
                <flux:text>{{ __('No se encontraron respuestas críticas para esta respuesta.') }}</flux:text>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-department-analysis-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Análisis del departamento') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Recomendaciones y análisis basados en las respuestas del departamento') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($department_analysis)
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles variant="mini" class="text-primary!"/>
                        <flux:heading>{{ __('Análisis AI para el departamento') }}</flux:heading>
                    </div>
                    <div
                        wire:key="ai-{{ now()->timestamp }}"
                        x-data="typeWords(@js($department_analysis))"
                        x-init="
                            start();
                            window.addEventListener('read-department-analysis', () => {
                                start();
                            });
                        "
                    >
                        <flux:text class="mt-2 leading-relaxed">
                            <template x-for="(word, i) in visibleWords" :key="i">
                                <span x-text="word" class="inline-block mr-1 animate-word"></span>
                            </template>
                            <span x-show="typing" class="inline-block animate-pulse">▍</span>
                        </flux:text>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-user-analysis-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Análisis del empleado') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Recomendaciones y análisis basados en las respuestas del empleado') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($user_analysis)
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles variant="mini" class="text-primary!"/>
                        <flux:heading>{{ __('Análisis AI para el empleado') }}</flux:heading>
                    </div>
                    <div
                        wire:key="ai-{{ now()->timestamp }}"
                        x-data="typeWords(@js($user_analysis))"
                        x-init="
                            start();
                            window.addEventListener('read-employee-analysis', () => {
                                start();
                            });
                        "
                    >
                        <flux:text class="mt-2 leading-relaxed">
                            <template x-for="(word, i) in visibleWords" :key="i">
                                <span x-text="word" class="inline-block mr-1 animate-word"></span>
                            </template>
                            <span x-show="typing" class="inline-block animate-pulse">▍</span>
                        </flux:text>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="general-analysis-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Análisis general') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Promedio en respuestas para esta aplicación') }}</flux:text>
        </div>
        <div class="p-5 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($general_analysis)
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles variant="mini" class="text-primary!"/>
                        <flux:heading class="text-primary!">{{ __('Resultados') }}</flux:heading>
                    </div>
                    <div class="mt-4">
                        <ul class="list-disc text-sm">
                            <li class="flex items-center gap-1 mb-2">
                                {{ __('Total de respuestas:') }}
                                <flux:text>{{ $general_analysis['total_responses'] ?? 0 }}</flux:text>
                            </li>
                            <li class="flex items-center gap-1 mb-2">
                                {{ __('Fecha de inicio:') }}
                                <flux:text>{{ $general_analysis['start_date'] ?? '-' }}</flux:text>
                            </li>
                            <li class="flex items-center gap-1 mb-2">
                                {{ __('Fecha de expiración:') }}
                                <flux:text>{{ $general_analysis['expiration_date'] ?? '-' }}</flux:text>
                            </li>
                        </ul>
                    </div>
                    @if(isset($general_analysis['employee_data_stats']))
                        <div class="mt-7">
                            <div class="flex items-center gap-2">
                                <flux:icon.sparkles variant="mini" class="text-primary!"/>
                                <flux:heading class="text-primary!">{{ __('Estadísticas de datos de empleado') }}</flux:heading>
                            </div>
                            <div class="mt-4 text-sm">
                                <div x-data="{ openFaq: null }" class="space-y-4">
                                    @foreach($general_analysis['employee_data_stats'] as $key => $stats)
                                        <div class="border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant rounded-2xl overflow-hidden">
                                            <button @click="openFaq = openFaq === '{{ $key }}' ? null : '{{ $key }}'" type="button" class="w-full px-6 py-4 text-left flex items-center justify-between gap-5 bg-light-variant dark:bg-dark-variant cursor-pointer">
                                                <span class="font-semibold">{{ __(ucfirst(str_replace('_', ' ', $key))) }}</span>
                                                <span>
                                                    <flux:icon.plus x-show="openFaq !== '{{ $key }}'" class="size-5 text-neutral-600 dark:text-neutral-400" />
                                                    <flux:icon.minus x-show="openFaq === '{{ $key }}'" class="size-5 text-primary" />
                                                </span>
                                            </button>
                                            <div x-show="openFaq === '{{ $key }}'" class="px-6 pb-5">
                                                <table class="min-w-full border-collapse text-sm mt-2">
                                                    <thead>
                                                        <tr>
                                                            <th class="px-2 py-2 text-left font-semibold">{{ __('Respuesta') }}</th>
                                                            <th class="px-2 py-2 text-left font-semibold">{{ __('Empleados') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($stats as $value => $count)
                                                            <tr>
                                                                <td class="px-2 py-1">{{ $value }}</td>
                                                                <td class="px-2 py-1 font-bold">{{ $count }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <flux:text>{{ __('No se pudo generar el análisis general para esta aplicación.') }}</flux:text>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-category-rating-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Calificación de las categorías (Ccat)') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Obtenido sumando el puntaje de cada uno de los ítems que integran la categoría') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($category_rating)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Categoría') }}
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Calificación') }}
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Clasificación') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @foreach($category_rating as $category => $score)
                                <tr>
                                    <td class="px-4 py-3 opacity-70">
                                        {{ $category }}
                                    </td>
                                    <td class="px-4 py-3 font-medium">
                                        {{ $score['score'] }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="opacity-70">{{ __('Riesgo psicosocial: ') }}</span> <span class="font-medium">{{ $score['classification'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-final-score-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Calificación Final') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Calificación final obtenida sumando el puntaje de todos y cada uno de los ítems') }}</flux:text>
        </div>
        <div class="text-center py-2">
            @if($final_score)
               <flux:heading class="text-6xl! font-bold!">{{ $final_score['final_score'] }}</flux:heading>
                <div x-data="{ openFaq: 1 }" class="max-w-4xl mx-auto space-y-4 z-20 relative mt-5">
                    <div class="bg-card border-2 border-border rounded-2xl overflow-hidden">
                        <button @click="openFaq = openFaq === 0 ? -1 : 0" class="w-full px-6 py-5 text-left flex items-center justify-between gap-5 bg-light-variant dark:bg-dark-variant cursor-pointer">
                            <flux:text>
                                {{ $questionnaire['name'] == \App\Enums\NomEnum::NOM_1->value ?  __('Nivel de riesgo clínico: ') : __('Nivel de riesgo psicosocial: ') }}
                                <span class="font-bold">{{ $final_score['classification']['label'] }}</span>
                            </flux:text>
                            <flux:icon.plus x-show="openFaq !== 0" class="size-5 text-neutral-600 dark:text-neutral-400" />
                            <flux:icon.minus x-show="openFaq === 0" class="size-5 text-primary" />
                        </button>
                        <div x-show="openFaq === 0" x-transition class="px-6 pb-5">
                            <ul class="space-y-6 text-left">
                                <li>
                                    <flux:text class="text-left leading-relaxed!">{{ $final_score['classification']['description'] }}</flux:text>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-employee-data-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Datos del Empleado') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Información detallada del empleado') }}</flux:text>
        </div>
        <div class="text-center py-2">
            @if($employee_data && (bool) $application_data['employee_data_required'])
                <form class="space-y-6">
                    <flux:field>
                        <flux:label>{{ __('Nombre completo') }}</flux:label>
                        <flux:input icon="user" value="{{ $employee_data['name'] }}" readonly />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Sexo') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['sex'] }}">{{ $employee_data['sex'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Edad en años') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['age'] }}">{{ $employee_data['age'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Estado civil') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['marital_status'] }}">{{ $employee_data['marital_status'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Nivel de estudios') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['education_level'] }}">{{ $employee_data['education_level'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Estado del nivel de estudios') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['status_education_level'] }}">{{ $employee_data['status_education_level'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Puesto de trabajo') }}</flux:label>
                        <flux:input icon="briefcase" value="{{ $employee_data['job_title'] }}" readonly />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Departamento, Sección o Área') }}</flux:label>
                        <flux:input icon="building-office" value="{{ $employee_data['department'] }}" readonly />
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de puesto') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['job_type'] }}">{{ $employee_data['job_type'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de contratación') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['contract_type'] }}">{{ $employee_data['contract_type'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de personal') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['personnel_type'] }}">{{ $employee_data['personnel_type'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Tipo de jornada de trabajo') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['work_schedule_type'] }}">{{ $employee_data['work_schedule_type'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Realiza rotación de turnos') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['shift_rotation'] }}">{{ $employee_data['shift_rotation'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Experiencia (años). Tiempo en el puesto actual') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['experience_current_job'] }}">{{ $employee_data['experience_current_job'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                    <flux:field>
                        <flux:label>{{ __('Experiencia (años). Tiempo experiencia laboral') }}</flux:label>
                        <flux:select class="!h-12">
                            <flux:select.option value="{{ $employee_data['total_experience'] }}">{{ $employee_data['total_experience'] }}</flux:select.option>
                        </flux:select>
                    </flux:field>
                </form>
            @else
                <flux:callout color="yellow" icon="information-circle" heading="{{ __('No se requirió información del empleado') }}" />
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>

    <flux:modal name="show-domain-rating-modal" class="w-[90%] md:w-full space-y-7">
        <div>
            <flux:heading size="xl">{{ __('Calificación del dominio (Cdom)') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Obtenido sumando el puntaje de cada uno de los ítems que integran el dominio') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($domain_rating)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse text-sm">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Dominio') }}
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Calificación') }}
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Clasificación') }}
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    {{ __('Categoría') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @foreach($domain_rating as $domain => $score)
                                <tr>
                                    <td class="px-4 py-3 opacity-70">
                                        {{ $domain }}
                                    </td>
                                    <td class="px-4 py-3 text-left font-medium">
                                        {{ $score['score'] }}
                                    </td>
                                    <td class="px-4 py-3 text-left font-medium">
                                        {{ $score['classification'] }}
                                    </td>
                                    <td class="px-4 py-3 text-left font-medium opacity-70">
                                        {{ $score['category'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="flex justify-end items-center gap-2">
            <flux:modal.close>
                <flux:button>{{ __('Cerrar') }}</flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>
</div>
