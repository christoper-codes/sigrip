<?php

namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlertResponsesExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected array $alert_responses;

    public function __construct(array $alert_responses)
    {
        $this->alert_responses = $alert_responses;
    }

    public function array(): array
    {
       return $this->alert_responses;
    }

    public function headings(): array
    {
        return [
            'Nombre completo',
            'Sexo',
            'Edad',
            'Estado civil',
            'Nivel de estudios',
            'Puesto de trabajo',
            'Departamento',
            'Tipo de puesto',
            'Tipo de contratación',
            'Tipo de personal',
            'Tipo de jornada',
            'Realiza rotación de turnos',
            'Experiencia en el puesto actual (años)',
            'Experiencia laboral total (años)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->getFont()->setBold(true);
        $sheet->getStyle('A1:N1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:N1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 15,
            'C' => 10,
            'D' => 20,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
            'L' => 30,
            'M' => 35,
            'N' => 30,
        ];
    }

    public function title(): string
    {
        return 'Empleado';
    }
}
