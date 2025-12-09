<div>
     <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre del cuestionario') }}"
        refresh_placeholder="{{ __('Refrescar datos') }}"
        :total_results="$total_results"
        :current_page="$current_page"
        :total_pages="$total_pages"
        :paginated_items="$paginated_items"
        :sort_field="$sort_field"
        :sort_direction="$sort_direction"
        >
        <x-slot:table>
            @foreach ($paginated_items as $questionnaire)
                <tr>
                    <td class="p-4">{{ $questionnaire['name'] }}</td>
                    <td class="p-4">{{ $questionnaire['category']['name'] }}</td>
                    <td class="p-4">{{ $questionnaire['category']['description'] }}</td>
                    <td class="p-4">
                        <flux:button
                            variant="filled"
                            wire:click="showDetails({{ $questionnaire['id'] }})">
                            {{ __('Ver detalles') }}
                        </flux:button>
                    </td>
                    <td class="p-4">
                        <flux:button
                            variant="filled"
                            wire:click="showRiskDetails({{ $questionnaire['id'] }})">
                            {{ __('Ver detalles') }}
                        </flux:button>
                    </td>
                    <td class="p-4">{{ $questionnaire['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge :status="$questionnaire['is_active'] ? 'active' : 'inactive'" />
                    </td>
                    <td class="p-4">
                        <flux:field variant="inline">
                           <flux:switch wire:click="updateStatus({{ $questionnaire['id'] }})" :checked="(bool) $questionnaire['is_active']" />
                        </flux:field>
                    </td>
                    <td class="p-4">
                        <flux:button variant="danger" icon="trash" wire:click="confirmDestroy('{{ $questionnaire['name'] }}', {{ $questionnaire['id'] }})" />
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

    <flux:modal name="destroy-questionnaire-modal" class="w-full max-w-md!">
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
</div>
