<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationShowResponsesExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    protected array $responses;

    public function __construct(array $responses)
    {
        $this->responses = $responses;
    }

    public function array(): array
    {
        return array_map(function ($item) {
            return [
                $item['uuid'] ?? '',
                $item['risk_level'] ?? '',
                $item['user']['name'] ?? 'Anónimo',
                $item['average_score'] ?? '',
            ];
        }, $this->responses);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tema',
            'Pregunta',
            'Respuesta',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:D1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 22,
            'C' => 18,
            'D' => 28,
        ];
    }
}
