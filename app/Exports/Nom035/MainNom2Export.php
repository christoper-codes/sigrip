<?php
namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainNom2Export implements WithMultipleSheets
{
    protected array $responses;
    protected array $user_data;

    public function __construct(array $responses, array $user_data)
    {
        $this->responses = $responses;
        $this->user_data = $user_data;
    }

    public function sheets(): array
    {
        return [
            'Respuestas' => new ApplicationShowResponsesNom2Export($this->responses),
            'Empleado'   => new EmployeeDataExport($this->user_data),
        ];
    }
}
