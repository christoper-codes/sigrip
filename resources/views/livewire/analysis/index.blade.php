<div>
    <form wire:submit.prevent='searchAnalysis'>
        <div class="flex items-center gap-3">
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por departamento') }}</flux:label>
                <flux:select class="!h-12" name="department" wire:model="department">
                    @foreach ($departments as $department)
                        <flux:select.option value="{{ $department['id'] }}">{{ $department['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="department" class="!mt-0"/>
            </flux:field>
            <flux:field class="max-w-md w-full">
                <flux:label>{{ __('Filtrar por mes') }}</flux:label>
                <flux:select class="!h-12" name="month" wire:model="month">
                    @foreach ($months as $month)
                        <flux:select.option value="{{ $month['value'] }}">{{ $month['label'] }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="month" class="!mt-0"/>
            </flux:field>
        </div>
        <flux:button type="submit" variant="primary" class="mt-3">{{ __('Buscar análisis') }}</flux:button>
   </form>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-14 mt-10">
        <div class="flex flex-col gap-5 text-center h-72 custom-pie-chart border pt-7 rounded-3xl border-neutral-300 dark:border-neutral-700">
            <flux:heading>{{ __('Distribución de estados de aplicaciones') }}</flux:heading>
            <livewire:livewire-pie-chart
                key="{{ $pieChartModelStates->reactiveKey() }}"
                :pie-chart-model="$pieChartModelStates"
            />
        </div>
        <div class="flex flex-col gap-5 text-center h-72 custom-pie-chart border pt-7 rounded-3xl border-neutral-300 dark:border-neutral-700">
            <flux:heading>{{ __('Alertas por nivel de riesgo') }}</flux:heading>
            <livewire:livewire-pie-chart
                key="{{ $pieChartModelAlerts->reactiveKey() }}"
                :pie-chart-model="$pieChartModelAlerts"
            />
        </div>
        <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-96">
            <flux:heading>{{ __('Total de respuestas por aplicación') }}</flux:heading>
            <livewire:livewire-column-chart
                key="{{ $columnChartModel->reactiveKey() }}"
                :column-chart-model="$columnChartModel"
            />
        </div>
        <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-80">
            <flux:heading>{{ __('Evolución de alertas críticas (rojas) en el mes') }}</flux:heading>
            <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                :line-chart-model="$lineChartModel"
            />
        </div>
        <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-96">
            <flux:heading>{{ __('Top cuestionarios más respondidos') }}</flux:heading>
            <livewire:livewire-column-chart
                key="{{ $columnChartModelTop->reactiveKey() }}"
                :column-chart-model="$columnChartModelTop"
            />
        </div>
    </div>
</div>
