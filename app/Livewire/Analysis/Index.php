<?php
namespace App\Livewire\Analysis;

use App\Models\Application;
use App\Models\Alert;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Total responses per application (bar chart)
        $applications = Application::with('questionnaire')
            ->withCount(['questionnaireResponses' => function($q) use ($startOfMonth, $endOfMonth) {
                $q->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            }])
            ->get();
        $columnChartModel = (new ColumnChartModel())
            ->setAnimated(true);
        foreach ($applications as $app) {
            $columnChartModel->addColumn(
                $app->questionnaire->name ?? 'Sin nombre',
                $app->questionnaire_responses_count,
                '#6366f1'
            );
        }

        // Application state distribution (pie chart)
        $active = Application::where('is_active', true)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $inactive = Application::where('is_active', false)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $pieChartModelStates = (new PieChartModel())
            ->setAnimated(true)
            ->addSlice('Activas', $active, '#22c55e')
            ->addSlice('Inactivas', $inactive, '#ef4444');

        // Top 5 most responded questionnaires (horizontal bar chart)
        $topApps = $applications->sortByDesc('questionnaire_responses_count')->take(5);
        $columnChartModelTop = (new ColumnChartModel())
            ->setAnimated(true)
            ->setHorizontal();
        foreach ($topApps as $app) {
            $columnChartModelTop->addColumn(
                $app->questionnaire->name ?? 'Sin nombre',
                $app->questionnaire_responses_count,
                '#818cf8'
            );
        }

        // Alert distribution by risk level (pie chart)
        $alerts = Alert::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        $red = $alerts->where('risk_level', 'red')->count();
        $yellow = $alerts->where('risk_level', 'yellow')->count();
        $green = $alerts->where('risk_level', 'green')->count();
        $pieChartModelAlerts = (new PieChartModel())
            ->setAnimated(true)
            ->addSlice('Rojo', $red, '#ef4444')
            ->addSlice('Amarillo', $yellow, '#facc15')
            ->addSlice('Verde', $green, '#22c55e');

        // Critical alerts (red) evolution over time (line chart)
        $lineChartModel = (new LineChartModel())->setAnimated(true);
        $daysInMonth = $now->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = $startOfMonth->copy()->addDays($day - 1);
            $count = Alert::where('risk_level', 'red')
                ->whereDate('created_at', $date->toDateString())
                ->count();
            $lineChartModel->addPoint($date->format('d M'), $count);
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
