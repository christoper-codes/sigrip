<?php
namespace App\Livewire\Analysis;

use App\Models\Application;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class Index extends Component
{

    public function render()
    {
        $applications = Application::with('questionnaire')->withCount('questionnaireResponses')->get();
        $chart = (new ColumnChartModel())
            ->setTitle('Total de respuestas por aplicación')
            ->setAnimated(true);

        foreach ($applications as $app) {
            $chart->addColumn(
                $app->questionnaire->name ?? 'Sin nombre',
                $app->questionnaire_responses_count,
                '#6366f1'
            );
        }

        $columnChartModel = $chart;

        return view('livewire.analysis.index')->with([
            'columnChartModel' => $columnChartModel,
        ]);
    }
}
