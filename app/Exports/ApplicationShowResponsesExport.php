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
       $rows = [];
        $counter = 1;
        foreach ($this->responses as $item) {
            foreach ($item['questions'] as $question) {
                $rows[] = [
                    $counter++,
                    $item['theme_name'] ?? '',
                    $question['question'] ?? '',
                    $question['answer'] ?? '',
                ];
            }
        }
        return $rows;
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
            'C' => 50,
            'D' => 28,
        ];
    }
}
