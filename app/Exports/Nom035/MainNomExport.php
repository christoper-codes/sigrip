<?php
namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainNomExport implements WithMultipleSheets
{
    protected array $responses;
    protected array $user_data;
    protected array $alert_responses;
    protected array $analysis_ai;
    protected array $domain_data;
    protected array $category_data;
    protected array $final_data;

    public function __construct(
        array $responses,
        array $user_data,
        array $alert_responses,
        array $analysis_ai,
        array $domain_data,
        array $category_data,
        array $final_data
    )
    {
        $this->responses = $responses;
        $this->user_data = $user_data;
        $this->alert_responses = $alert_responses;
        $this->analysis_ai = $analysis_ai;
        $this->domain_data = $domain_data;
        $this->category_data = $category_data;
        $this->final_data = $final_data;
    }

    public function sheets(): array
    {
        return [
            'Empleado'   => new EmployeeDataExport($this->user_data),
            'Respuestas' => new ApplicationShowResponsesNom2Export($this->responses),
            'Alertas' => new AlertResponsesExport($this->alert_responses),
            'Análisis AI' => new AnalysisAiExport($this->analysis_ai),
            'Dominio' => new DomainExport($this->domain_data),
            'Categoría' => new CategoryExport($this->category_data),
            'Final' => new FinalExport($this->final_data),
        ];
    }
}
