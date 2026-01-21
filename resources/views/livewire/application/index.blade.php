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
                                <flux:button icon="chart-bar" href="{{ route('analysis.index') }}" class="border! border-primary! bg-primary/10!">{{ __('Resultados') }}</flux:button>
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
            <flux:callout color="fuchsia" icon="information-circle" heading="{{ __('No se ha seleccionado un departamento') }}" />
        </div>
    @endif

    <flux:modal name="edit-application-modal" class="w-[90%] md:w-2xl!" @close="editModalClosed()">
        <form wire:submit.prevent="confirmUpdateApplication" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Editar aplicación') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Actualizar los detalles y guardar los cambios.') }}</flux:text>
            </div>
            <flux:field>
                <flux:label>{{ __('Departamento emisor') }}</flux:label>
                <flux:select class="!h-12" name="issuing_department" wire:model="form.issuing_department">
                    @if ($form->department)
                        <flux:select.option value="{{ $form->department['id'] }}">{{ $form->department['name'] }}</flux:select.option>
                    @endif
                </flux:select>
                <flux:error name="form.issuing_department" class="!mt-0"/>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Departamento receptor') }}</flux:label>
                <flux:select class="!h-12" name="executing_department" wire:model="form.executing_department">
                    <flux:select.option value="" >{{ __('Seleccione un departamento') }}</flux:select.option>
                    @foreach ($form->departments as $department)
                        <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="form.executing_department" class="!mt-0"/>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Cuestionario') }}</flux:label>
                <flux:select class="!h-12" name="questionnaire" wire:model="form.questionnaire">
                    <flux:select.option value="" >{{ __('Seleccione un cuestionario') }}</flux:select.option>
                    @foreach ($form->questionnaires as $questionnaire)
                        <flux:select.option value="{{ $questionnaire['id'] }}">{{ $questionnaire['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="form.questionnaire" class="!mt-0"/>
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Fecha de inicio') }}</flux:label>
                <div x-data>
                    <div @click="$refs.dateInput.showPicker()" class="relative cursor-pointer">
                        <flux:input type="date" name="start_date" wire:model="form.start_date" icon="calendar" placeholder="{{ __('Fecha de inicio') }}" x-ref="dateInput" />
                    </div>
                </div>
                <flux:error name="form.start_date" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Fecha de expiración') }}</flux:label>
                <div x-data>
                    <div @click="$refs.dateInput.showPicker()" class="relative cursor-pointer">
                        <flux:input type="date" name="expiration_date" wire:model="form.expiration_date" icon="calendar" placeholder="{{ __('Fecha de expiración') }}" x-ref="dateInput" />
                    </div>
                </div>
                <flux:error name="form.expiration_date" />
            </flux:field>
            <flux:field>
                <flux:label>{{ __('Requiere autenticación') }}</flux:label>
                <flux:switch wire:model="form.auth_required" align="left" name="auth_required"/>
                <flux:error name="form.auth_required" />
            </flux:field>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">{{ __('Actualizar') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="destroy-application-modal" class="w-[90%] md:max-w-md!">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de que deseas eliminar esta aplicación?') }}</flux:heading>
                <flux:text class="mt-3 font-semibold">{{ $application_name }}</flux:text>
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

    <flux:modal name="index-qr-application-modal" class="w-[90%] md:w-full!">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Compartir aplicación') }}</flux:heading>
                <flux:text class="mt-3">{{ __('Puedes descargar el código QR de la aplicación o copiar el link y compartirlo con los empleados.') }}</flux:text>
            </div>
            <div class="flex flex-col items-center gap-4">
                @if($form->url_qr && $form->slug)
                    <img src="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" alt="QR" class="border w-48 h-48 mx-auto" />
                    <a href="{{ Storage::url('qrs/' . $form->slug . '.svg') }}" download class="mt-2">
                        <flux:button class="cursor-pointer" icon="arrow-down-on-square" variant="outline">{{ __('Descargar') }}</flux:button>
                    </a>
                    <div class="mt-2 break-all text-center">
                        <div x-data="{ copied: false }" class="flex items-center gap-2">
                            <flux:heading size="lg" class="truncate! w-52! md:w-80! block">{{ $form->url_qr }}</flux:heading>
                            <flux:icon.clipboard-document class="cursor-pointer" variant="solid" x-show="!copied" @click="navigator.clipboard.writeText('{{ $form->url_qr }}'); copied = true; setTimeout(() => copied = false, 1500)" />
                            <flux:icon.check variant="solid" x-show="copied" disabled />
                        </div>
                    </div>
                @endif
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

