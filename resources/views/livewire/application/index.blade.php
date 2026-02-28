<div>
   <form wire:submit.prevent='searchApplications'>
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model.live="department">
                    <flux:select.option value="" >{{ __('Selecciona un departamento') }}</flux:select.option>
                    @foreach ($departments as $department)
                        <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>)
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
            </flux:field>
            <flux:field class="max-w-32 w-full">
                <flux:label>{{ __('Total de registros') }}</flux:label>
                <flux:select class="!h-12" name="items_per_page" wire:model.live="items_per_page">
                    @foreach ($search_options as $option)
                        <flux:select.option value="{{ $option['value'] }}">{{ $option['label'] }}</flux:select.option>)
                    @endforeach
                </flux:select>
                <flux:error name="items_per_page" class="!mt-0"/>
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
                search_placeholder="{{ __('Buscar por nombre') }}"
                :total_results="$total_results"
                :current_page="$current_page"
                :total_pages="$total_pages"
                :paginated_items="$paginated_items"
                :sort_field="$sort_field"
                :sort_direction="$sort_direction"
                >
                <x-slot:table>
                    @foreach ($paginated_items as $application)
                        <tr>
                            <td class="p-4">{{ $application['questionnaire']['name'] }}</td>
                            <td class="p-4">{{ $application['created_at'] }}</td>
                            <td class="p-4">
                                <flux:button icon="share" wire:click="shareApplication({{ $application['id'] }})" variant="filled">{{ __('Compartir') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button icon="chart-bar" href="{{ route('analysis.index') }}" wire:navigate class="border! border-primary! bg-primary/10!">{{ __('Resultados') }}</flux:button>
                            </td>
                            <td class="p-4">
                                {{ $application['questionnaire_responses_count'] ?? 0 }}
                            </td>
                            <td class="p-4">{{ $application['issuing_department']['name'] }}</td>
                            <td class="p-4">{{ $application['start_date'] ?? 'Sin fecha de inicio' }}</td>
                            <td class="p-4">{{ $application['expiration_date'] ?? 'Sin fecha de caducidad' }}</td>
                            <td class="p-4">
                                <x-appearance.badge :status="$application['is_active'] ? 'active' : 'inactive'" />
                            </td>
                            <td class="p-4" >
                                <flux:field variant="inline">
                                    <flux:switch wire:click="updateStatus({{ $application['id'] }})" :checked="(bool) $application['is_active']" />
                                </flux:field>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <flux:button variant="filled" icon="pencil" wire:click="editApplication({{ $application['id'] }})" />
                                    <flux:button variant="danger" icon="trash" wire:click="confirmDestroy('{{ $application['questionnaire']['name'] . ' - ' . $application['created_at'] }}', {{ $application['id'] }})" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:table>
            </x-appearance.livewiretable>
        </div>
    @elseif($department && ! $table_items && $search_applications)
        <div class="mt-10 max-w-md w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('No hay aplicaciones para este departamento') }}" />
        </div>
    @else
        <div class="mt-10 max-w-md w-full">
            <flux:callout color="yellow" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
        </div>
    @endif

</div>

