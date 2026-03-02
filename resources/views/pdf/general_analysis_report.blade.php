<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de cumplimiento (STPS)</title>
    <style>
        body { font-family: Arial, sans-serif; color: #222; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 2em; font-weight: bold; margin-bottom: 10px; }
        .subtitle { font-size: 1.1em; margin-bottom: 5px; }
        .section { margin-bottom: 25px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #bbb; padding: 6px 10px; text-align: left; }
        .table th { background: #f5f5f5; font-weight: bold; }
        .stats-title { font-size: 1.1em; font-weight: bold; margin-top: 20px; margin-bottom: 8px; }
        .footer { margin-top: 40px; text-align: center; font-size: 0.9em; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Informe de cumplimiento (STPS)</div>
        <div class="subtitle">Empresa: <strong>{{ $empresa }}</strong></div>
        <div class="subtitle">Cuestionario aplicado: <strong>{{ $questionnaire_name }}</strong></div>
        <div class="subtitle">Departamento ejecutor: <strong>{{ $executing_department }}</strong></div>
        <div class="subtitle">Departamento respondiente: <strong>{{ $responding_department }}</strong></div>
    </div>

    <div class="section">
        <h2>Resultados generales</h2>
        <ul>
            <li>Total de respuestas: <strong>{{ $general_analysis['total_responses'] ?? 0 }}</strong></li>
            <li>Fecha de inicio: <strong>{{ $general_analysis['start_date'] ?? '-' }}</strong></li>
            <li>Fecha de expiración: <strong>{{ $general_analysis['expiration_date'] ?? '-' }}</strong></li>
        </ul>
    </div>

    @if(isset($general_analysis['employee_data_stats']))
        <div class="section">
            <div class="stats-title">Estadísticas de datos de empleado</div>
            @foreach($general_analysis['employee_data_stats'] as $key => $stats)
                <div style="margin-bottom: 18px;">
                    <div style="font-weight: bold; margin-bottom: 5px;">{{ __(ucfirst(str_replace('_', ' ', $key))) }}</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Respuesta</th>
                                <th>Empleados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats as $value => $count)
                                <tr>
                                    <td>{{ $value }}</td>
                                    <td>{{ $count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <div class="footer">
        Informe generado automáticamente por el sistema de cumplimiento (STPS).<br>
        Fecha de generación: {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>
