<?php
namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainNom2Export implements WithMultipleSheets
{
    protected array $responses;
    protected array $user_data;
    protected array $alert_responses;

    public function __construct(array $responses, array $user_data, array $alert_responses)
    {
        $this->responses = $responses;
        $this->user_data = $user_data;
        $this->alert_responses = $alert_responses;
    }

    public function sheets(): array
    {
        return [
            'Empleado'   => new EmployeeDataExport($this->user_data),
            'Respuestas' => new ApplicationShowResponsesNom2Export($this->responses),
            'Alertas' => new AlertResponsesExport($this->alert_responses),
        ];
    }
}
