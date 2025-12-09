<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QuestionnaireTemplateExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        return [
            [
                'Bienestar General',
                'Evaluación de la satisfacción personal y energía en el desempeño laboral.',
                '¿Qué tan satisfecho/a estás con tu desempeño este mes?',
                'select',
                '1:Muy insatisfecho|2:Insatisfecho|3:Neutral|4:Satisfecho|5:Muy satisfecho',
                '1|2',
                '1',
            ],
            [
                'Bienestar General',
                'Evaluación de la satisfacción personal y energía en el desempeño laboral.',
                '¿Te sentiste con energía suficiente para realizar tu trabajo?',
                'select',
                '1:Muy insatisfecho|2:Insatisfecho|3:Neutral|4:Satisfecho|5:Muy satisfecho',
                '1|2',
                '1',
            ],
            [
                'Manejo del Estrés',
                'Evaluación del control del estrés y adecuación de la carga laboral.',
                '¿Qué tan controlable sentiste tu nivel de estrés este mes?',
                'select',
                '1:Nada controlable|2:Poco controlable|3:Neutral|4:Controlable|5:Muy controlable',
                '1|2',
                '1',
            ],
            [
                'Manejo del Estrés',
                'Evaluación del control del estrés y adecuación de la carga laboral.',
                '¿Tu carga laboral fue adecuada a tus capacidades?',
                'radio_button',
                '1:No, demasiado trabajo|2:No, muy poco trabajo|3:Sí',
                '1',
                '1',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'tema',
            'descripcion',
            'pregunta',
            'tipo de respuesta',
            'opciones y valores',
            'valores criticos',
            'peso de pregunta',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,
            'B' => 40,
            'C' => 55,
            'D' => 18,
            'E' => 45,
            'F' => 18,
            'G' => 18,
        ];
    }
}
