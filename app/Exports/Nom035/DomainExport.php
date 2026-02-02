<?php

namespace App\Exports\Nom035;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DomainExport implements FromArray, WithStyles, WithColumnWidths, WithTitle, WithHeadings
{
    protected array $domain_data;

    public function __construct(array $domain_data)
    {
        $this->domain_data = $domain_data;
    }

    public function array(): array
    {
        return $this->domain_data;
    }

    public function headings(): array
    {
        return [
            'Dominio',
            'Calificación',
            'Clasificación',
            'Categoría',
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
        return 'Dominio';
    }
}
