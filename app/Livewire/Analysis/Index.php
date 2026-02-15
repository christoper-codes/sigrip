<?php

declare(strict_types=1);

namespace App\Livewire\Analysis;

use App\Models\Alert;
use App\Models\Application;
use App\Models\Department;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    public array $departments = [];
    public array $months = [];

    #[Validate(['required', 'int'])]
    public int $department = -1;

    #[Validate(['required', 'int'])]
    public ?int $month = null;

    public function searchAnalysis(): void
    {
        $this->validate();
    }

    public function mount()
    {
        $this->months = [
            ['value' => 1, 'label' => __('Enero')],
            ['value' => 2, 'label' => __('Febrero')],
            ['value' => 3, 'label' => __('Marzo')],
            ['value' => 4, 'label' => __('Abril')],
            ['value' => 5, 'label' => __('Mayo')],
            ['value' => 6, 'label' => __('Junio')],
            ['value' => 7, 'label' => __('Julio')],
            ['value' => 8, 'label' => __('Agosto')],
            ['value' => 9, 'label' => __('Septiembre')],
            ['value' => 10, 'label' => __('Octubre')],
            ['value' => 11, 'label' => __('Noviembre')],
            ['value' => 12, 'label' => __('Diciembre')],
        ];
        $this->month = Carbon::now()->month;

        $departments = Department::where('company_id', Auth::user()->company?->id)
            ->get()
            ->toArray();

        $this->departments = array_merge([['id' => -1, 'name' => __('Todos los departamentos')]], $departments);
    }

    public function render()
    {
        // Determine date range for the selected month
        $year = Carbon::now()->year;
        $month = $this->month ?? Carbon::now()->month;
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        // Total responses per application (bar chart)
        $applicationsQuery = Application::where('company_id', Auth::user()->company?->id)
            ->with('questionnaire')
            ->withCount(['questionnaireResponses' => function ($q) use ($startOfMonth, $endOfMonth) {
                $q->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            }]);
        if ($this->department && $this->department != -1) {
            $applicationsQuery->where('executing_department_id', $this->department);
        }
        $applications = $applicationsQuery->get();
        $columnChartModel = (new ColumnChartModel)
            ->setAnimated(true);
        foreach ($applications as $app) {
            $columnChartModel->addColumn(
                $app->questionnaire->name,
                $app->questionnaire_responses_count,
                '#3b82f6'
            );
        }

        // Application state distribution (pie chart)
        $activeQuery = Application::where('company_id', Auth::user()->company?->id)
            ->where('is_active', true)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        $inactiveQuery = Application::where('company_id', Auth::user()->company?->id)
            ->where('is_active', false)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        if ($this->department && $this->department != -1) {
            $activeQuery->where('executing_department_id', $this->department);
            $inactiveQuery->where('executing_department_id', $this->department);
        }
        $active = $activeQuery->count();
        $inactive = $inactiveQuery->count();
        $pieChartModelStates = (new PieChartModel)
            ->setAnimated(true)
            ->addSlice('Activas', $active, '#3b82f6')
            ->addSlice('Inactivas', $inactive, '#ef4444');

        // Top 5 most responded questionnaires (horizontal bar chart)
        $topApps = $applications->sortByDesc('questionnaire_responses_count')->take(5);
        $columnChartModelTop = (new ColumnChartModel)
            ->setAnimated(true)
            ->setHorizontal();
        foreach ($topApps as $app) {
            $columnChartModelTop->addColumn(
                $app->questionnaire->name,
                $app->questionnaire_responses_count,
                '#3b82f6'
            );
        }

        // Alert distribution by risk level (pie chart)
        $alertsQuery = Alert::where('company_id', Auth::user()->company?->id)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        if ($this->department && $this->department != -1) {
            $alertsQuery->where('department_id', $this->department);
        }
        $alerts = $alertsQuery->get();
        $red = $alerts->where('risk_level', 'red')->count();
        $yellow = $alerts->where('risk_level', 'yellow')->count();
        $green = $alerts->where('risk_level', 'green')->count();
        $pieChartModelAlerts = (new PieChartModel)
            ->setAnimated(true)
            ->addSlice('Rojo', $red, '#ef4444')
            ->addSlice('Amarillo', $yellow, '#facc15')
            ->addSlice('Verde', $green, '#22c55e');

        // Critical alerts (red) evolution over time (line chart)
        $lineChartModel = (new LineChartModel)->setAnimated(true);
        $daysInMonth = $startOfMonth->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $startOfMonth->copy()->addDays($day - 1);
            $countQuery = Alert::where('company_id', Auth::user()->company?->id)
                ->where('risk_level', 'red')
                ->whereDate('created_at', $date->toDateString());
            if ($this->department && $this->department != -1) {
                $countQuery->where('department_id', $this->department);
            }
            $count = $countQuery->count();
            $lineChartModel->addPoint($date->format('d'), $count);
        }

        return view('livewire.analysis.index')->with([
            'columnChartModel' => $columnChartModel,
            'pieChartModelStates' => $pieChartModelStates,
            'columnChartModelTop' => $columnChartModelTop,
            'pieChartModelAlerts' => $pieChartModelAlerts,
            'lineChartModel' => $lineChartModel,
        ]);
    }
}
