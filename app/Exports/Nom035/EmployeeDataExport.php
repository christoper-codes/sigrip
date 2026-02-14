<?php

namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeDataExport implements FromArray, WithStyles, WithColumnWidths, WithTitle
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

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A:A')->getFont()->setBold(true);
        $sheet->getStyle('B:B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 40,
        ];
    }

    public function title(): string
    {
        return 'Empleado';
    }
}
