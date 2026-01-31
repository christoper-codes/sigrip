<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationShowResponsesNom2Export implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    protected array $responses;

    public function __construct(array $responses)
    {
        $this->responses = $responses;
    }

    public function array(): array
    {
       $rows = [];
        foreach ($this->responses as $item) {
            foreach ($item['questions'] as $question) {
                $rows[] = [
                    $question['id'] ?? '',
                    $question['category'] ?? '',
                    $question['domain'] ?? '',
                    $question['question'] ?? '',
                    $question['answer'] ?? '',
                    $question['value'] ?? '',
                ];
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Categoria',
            'Dominio',
            'Pregunta',
            'Respuesta',
            'Valor'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:F1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 35,
            'C' => 40,
            'D' => 70,
            'E' => 20,
            'F' => 15,
        ];
    }
}
