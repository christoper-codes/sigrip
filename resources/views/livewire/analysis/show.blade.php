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
                                <flux:button icon="clipboard-document-list" variant="primary">{{ __('Respuestas') }}</flux:button>
                            </td>
                            <td class="p-4">
                                <flux:button icon="exclamation-triangle" variant="primary">{{ __('Alertas') }}</flux:button>
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
</div>
