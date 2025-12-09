<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class QuestionnaireImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;

    public function collection(Collection $rows)
    {
        if ($rows->count() === 0) {
            throw new \Exception(__('El archivo debe contener al menos una pregunta.'));
        }

        foreach ($rows as $index => $row) {
            $type = strtolower(trim($row['tipo_de_respuesta'] ?? ''));
            $options = $row['opciones_y_valores'] ?? '';
            $critical = $row['valores_criticos'] ?? '';
            $weight = $row['peso_de_pregunta'] ?? '';

            if (!in_array($type, ['select', 'text'])) {
                throw new \Exception("Fila ".($index+2).": El tipo de respuesta debe ser 'select' o 'text'.");
            }

            if ($type === 'select') {
                if (empty($options)) {
                    throw new \Exception("Fila ".($index+2).": Las opciones y valores son requeridos para preguntas tipo 'select'.");
                }
                $opts = explode('|', $options);
                foreach ($opts as $opt) {
                    if (!preg_match('/^\d+\s*:.+$/', trim($opt))) {
                        throw new \Exception("Fila ".($index+2).": Cada opción debe tener el formato 'número:etiqueta'.");
                    }
                }
            }

            if ($type === 'select') {
                if (empty($critical)) {
                    throw new \Exception("Fila ".($index+2).": Los valores críticos son requeridos para preguntas tipo 'select'.");
                }
                if (!preg_match('/^\d+(,\d+)*$/', str_replace(' ', '', $critical))) {
                    throw new \Exception("Fila ".($index+2).": Los valores críticos deben ser números separados por coma.");
                }
            }

            if (!is_numeric($weight)) {
                throw new \Exception("Fila ".($index+2).": El peso de la pregunta debe ser un número.");
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.tema' => 'required|string|min:3',
            '*.descripcion' => 'required|string|min:3',
            '*.pregunta' => 'required|string|min:3',
            '*.tipo_de_respuesta' => 'required|string',
            '*.peso_de_pregunta' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.tema.required' => __('El tema es obligatorio.'),
            '*.tema.min' => __('El tema debe tener al menos 3 caracteres.'),
            '*.descripcion.required' => __('La descripción es obligatoria.'),
            '*.descripcion.min' => __('La descripción debe tener al menos 3 caracteres.'),
            '*.pregunta.required' => __('La pregunta es obligatoria.'),
            '*.pregunta.min' => __('La pregunta debe tener al menos 3 caracteres.'),
            '*.tipo_de_respuesta.required' => __('El tipo de respuesta es obligatorio.'),
            '*.peso_de_pregunta.required' => __('El peso de la pregunta es obligatorio.'),
        ];
    }
}
