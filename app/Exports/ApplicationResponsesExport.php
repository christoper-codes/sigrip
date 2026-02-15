<?php

declare(strict_types=1);

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationResponsesExport implements FromArray, WithColumnWidths, WithHeadings, WithStyles
{
    protected array $responses;

    public function __construct(array $responses)
    {
        $this->responses = $responses;
    }

    public function array(): array
    {
        return array_map(function ($item) {
            $created_at = Carbon::parse($item['created_at'])->format('d/m/Y H:i');

            return [
                $item['uuid'] ?? '',
                $created_at,
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
            'Fecha de Respuesta',
            'Nivel de Riesgo',
            'Nombre de empleado',
            'Promedio',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:E1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 22,
            'C' => 18,
            'D' => 28,
            'E' => 12,
        ];
    }
}
