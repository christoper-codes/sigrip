<div>
    <form wire:submit.prevent='searchApplications'>
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                            <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
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
            <x-appearance.livewiretable
                :headers="$headers"
                search_placeholder="{{ __('Nombre de empleado') }}"
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
                            <td class="p-4">{{ dateFormat($response['created_at']) }}</td>
                            <td class="p-4">
                                {{ $response['risk_level'] == 'red' ? __('Rojo') : ($response['risk_level'] == 'yellow' ? __('Amarillo') : __('Verde')) }}
                            </td>
                            <td class="p-4">{{ $response['user']['name'] ?? 'Anónimo' }}</td>
                            <td class="p-4">
                                <flux:button wire:click="showResponses({{ $response['id'] }})" icon="clipboard-document-list" variant="primary">{{ __('Respuestas') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button wire:click="showAlerts({{ $response['id'] }})" icon="exclamation-triangle" variant="primary">{{ __('Alertas') }}</flux:button>
                            </td>
                            <td class="p-4">{{ $response['average_score'] }}</td>
                            <td class="p-4">
                                <flux:button icon="building-office" href="#" class="border! border-primary! bg-primary/10!">{{ __('Análisis') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button icon="user" href="#" class="border! border-primary! bg-primary/10!">{{ __('Análisis') }}</flux:button>
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
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
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
        <div>
            <flux:heading size="xl">{{ __('Preguntas y respuestas') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Listadas por temas') }}</flux:text>
        </div>
        <div class="p-4 rounded-xl bg-variant dark:bg-dark-variant mt-2 border border-neutral-200 dark:border-neutral-800">
            @if($all_responses)
                @foreach($all_responses as $theme)
                    <div class="mb-4">
                        <flux:heading size="lg" class="text-primary!">{{ $theme['theme_name'] }}</flux:heading>
                        <flux:text class="mb-3!">{{ $theme['theme_description'] }}</flux:text>
                        <ul class="list-decimal ml-6">
                            @foreach($theme['questions'] as $q)
                                <li class="mb-3">
                                    <p class="text-sm font-semibold">{{ $q['question'] }}</p>
                                    <ul class="list-disc ml-4 mt-1 text-sm opacity-75">
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
                <ul class="list-decimal ml-6">
                   @foreach($alert_responses as $alert)
                        <li class="mb-3">
                            <p class="text-sm font-semibold">{{ $alert['question'] }}</p>
                            <ul class="list-disc ml-4 mt-1 text-sm opacity-75">
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
</div>
