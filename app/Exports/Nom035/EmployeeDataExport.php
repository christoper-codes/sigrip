<?php

namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeDataExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    protected array $user_data;

    public function __construct(array $user_data)
    {
        $this->user_data = $user_data;
    }

    public function array(): array
    {
       return $this->user_data;
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
            'E' => 25,
            'F' => 30,
            'G' => 25,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 30,
            'N' => 30,
        ];
    }
}
