<div class="grid grid-cols-1 md:grid-cols-2 gap-14">
    <!-- 2. Distribución de estados de aplicaciones (pastel) -->
    <div class="flex flex-col gap-5 text-center h-72">
        <flux:heading>{{ __('Distribución de estados de aplicaciones') }}</flux:heading>
        <livewire:livewire-pie-chart
            key="{{ $pieChartModelStates->reactiveKey() }}"
            :pie-chart-model="$pieChartModelStates"
        />
    </div>

    <!-- 4. Alertas generadas por nivel de riesgo (pastel) -->
    <div class="flex flex-col gap-5 text-center h-72">
        <flux:heading>{{ __('Alertas por nivel de riesgo') }}</flux:heading>
        <livewire:livewire-pie-chart
            key="{{ $pieChartModelAlerts->reactiveKey() }}"
            :pie-chart-model="$pieChartModelAlerts"
        />
    </div>

    <!-- 1. Total de respuestas por aplicación (barras) -->
    <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-96">
        <flux:heading>{{ __('Total de respuestas por aplicación') }}</flux:heading>
        <livewire:livewire-column-chart
            key="{{ $columnChartModel->reactiveKey() }}"
            :column-chart-model="$columnChartModel"
        />
    </div>

    <!-- 3. Top cuestionarios más respondidos (barras horizontales) -->
    <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-96">
        <flux:heading>{{ __('Top cuestionarios más respondidos') }}</flux:heading>
        <livewire:livewire-column-chart
            key="{{ $columnChartModelTop->reactiveKey() }}"
            :column-chart-model="$columnChartModelTop"
        />
    </div>

    <!-- 5. Evolución de alertas críticas (rojas) en el tiempo (líneas) -->
    <div class="col-span-1 md:col-span-2 flex flex-col gap-5 text-center h-80">
        <flux:heading>{{ __('Evolución de alertas críticas (rojas) en el mes') }}</flux:heading>
        <livewire:livewire-line-chart
            key="{{ $lineChartModel->reactiveKey() }}"
            :line-chart-model="$lineChartModel"
        />
    </div>
</div>
