<div>
     <x-appearance.livewiretable
        :headers="$headers"
        search_placeholder="{{ __('Nombre del departamento') }}"
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
                    <td class="p-4"><flux:button variant="filled">{{ __('Ver detalles') }}</flux:button></td>
                    <td class="p-4">{{ $questionnaire['created_at'] }}</td>
                    <td class="p-4">
                        <x-appearance.badge :status="$questionnaire['is_active'] ? 'active' : 'inactive'" />
                    </td>
                    <td class="p-4">
                        <flux:field variant="inline">
                           <flux:switch wire:click="updateStatus({{ $questionnaire['id'] }})" :checked="(bool) $questionnaire['is_active']" />
                        </flux:field>
                    </td>
                </tr>
            @endforeach
        </x-slot:table>
     </x-appearance.livewiretable>

     <flux:modal name="questionnaire-details-modal" class="w-[90%] lg:w-full!">
        <div class="space-y-4">
            <div>
                <flux:heading size="xl">{{ $questionnaire_data['title'] ?? '' }}</flux:heading>
                <flux:text class="mt-2">{{ $questionnaire_data['subtitle'] ?? '' }}</flux:text>
                <flux:heading size="lg" class="mt-4">{{ __('Instrucciones') }}</flux:heading>
                <flux:text>{{ $questionnaire_data['instructions'] ?? '' }}</flux:text>
            </div>

            <div>
                <flux:heading size="lg">{{ __('Preguntas separadas por temas') }}</flux:heading>
                <flux:text>{{ __('Total:') }}</flux:text>
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
</div>
