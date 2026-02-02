<?php
namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainNom2Export implements WithMultipleSheets
{
    protected array $responses;
    protected array $user_data;
    protected array $alert_responses;
    protected array $analysis_ai;

    public function __construct(
        array $responses,
        array $user_data,
        array $alert_responses,
        array $analysis_ai)
    {
        $this->responses = $responses;
        $this->user_data = $user_data;
        $this->alert_responses = $alert_responses;
        $this->analysis_ai = $analysis_ai;
    }

    public function sheets(): array
    {
        return [
            'Empleado'   => new EmployeeDataExport($this->user_data),
            'Respuestas' => new ApplicationShowResponsesNom2Export($this->responses),
            'Alertas' => new AlertResponsesExport($this->alert_responses),
            'Análisis AI' => new AnalysisAiExport($this->analysis_ai),
        ];
    }
}
