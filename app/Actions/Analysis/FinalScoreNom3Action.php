<?php

declare(strict_types=1);

namespace App\Actions\Analysis;

class FinalScoreNom3Action
{
    public function execute(array $responses): array
    {
        $final_score = collect($responses)
            ->sum(fn ($response) => (int) $response['value']);

        $levels = [

            [
                'min' => 0,
                'max' => 49,
                'label' => 'Nulo o despreciable',
                'risk_level' => 'green',
                'description' => 'El riesgo resulta despreciable por lo que no se requiere medidas adicionales.',
            ],

            [
                'min' => 50,
                'max' => 74,
                'label' => 'Bajo',
                'risk_level' => 'green',
                'description' => 'Es necesario una mayor difusión de la política de prevención de riesgos psicosociales y programas para: la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral.',
            ],

            [
                'min' => 75,
                'max' => 98,
                'label' => 'Medio',
                'risk_level' => 'yellow',
                'description' => 'Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión, mediante un Programa de intervención.',
            ],

            [
                'min' => 99,
                'max' => 139,
                'label' => 'Alto',
                'risk_level' => 'orange',
                'description' => 'Se requiere realizar un análisis de cada categoría y dominio, de manera que se puedan determinar las acciones de intervención apropiadas a través de un Programa de intervención, que podrá incluir una evaluación específica1 y deberá incluir una campaña de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión.',
            ],

            [
                'min' => 140,
                'max' => PHP_INT_MAX,
                'label' => 'Muy alto',
                'risk_level' => 'red',
                'description' => 'Se requiere realizar el análisis de cada categoría y dominio para establecer las acciones de intervención apropiadas, mediante un Programa de intervención que deberá incluir evaluaciones específicas1, y contemplar campañas de sensibilización, revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión.',
            ],
        ];

        $classification = collect($levels)->first(
            fn ($level) => $final_score >= $level['min'] && $final_score <= $level['max']
        );

        return [
            'final_score' => $final_score,
            'classification' => [
                'label' => $classification['label'],
                'risk_level' => $classification['risk_level'],
                'description' => $classification['description'],
            ],
        ];
    }
}
