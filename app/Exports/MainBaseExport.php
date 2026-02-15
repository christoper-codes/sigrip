<?php

declare(strict_types=1);

namespace App\Exports;

use App\Exports\Nom035\AlertResponsesExport;
use App\Exports\Nom035\AnalysisAiExport;
use App\Exports\Nom035\EmployeeDataExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainBaseExport implements WithMultipleSheets
{
    protected array $responses;
    protected array $user_data;
    protected array $alert_responses;
    protected array $analysis_ai;

    public function __construct(
        array $responses,
        array $user_data,
        array $alert_responses,
        array $analysis_ai,
    ) {
        $this->responses = $responses;
        $this->user_data = $user_data;
        $this->alert_responses = $alert_responses;
        $this->analysis_ai = $analysis_ai;
    }

    public function sheets(): array
    {
        return [
            'Empleado' => new EmployeeDataExport($this->user_data),
            'Respuestas' => new ApplicationShowResponsesExport($this->responses),
            'Alertas' => new AlertResponsesExport($this->alert_responses),
            'Análisis AI' => new AnalysisAiExport($this->analysis_ai),
        ];
    }
}
