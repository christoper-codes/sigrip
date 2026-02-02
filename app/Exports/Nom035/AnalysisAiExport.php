<?php

namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnalysisAiExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected array $analysis_ai;

    public function __construct(array $analysis_ai)
    {
        $this->analysis_ai = $analysis_ai;
    }

    public function array(): array
    {
       return $this->analysis_ai;
    }

    public function headings(): array
    {
        return [
            'Recomendación para el empleado',
            'Recomendación para el departamento',
            'Título del ticket sugerido',
            'Descripción del ticket sugerido',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
        $sheet->getStyle('A:D')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A:D')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 40,
            'C' => 40,
            'D' => 40,
        ];
    }

    public function title(): string
    {
        return 'Análisis AI';
    }
}
