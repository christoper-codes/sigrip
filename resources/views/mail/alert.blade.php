<x-mail::message>
# Alerta generada en respuestas de empleado ⚠️❗



Hola,<br>
Se ha generado una <strong>alerta</strong> en las respuestas de un empleado.<br><br>

@if(!empty($employee_name))
**Empleado:** {{ $employee_name }}<br>
@endif
**Cuestionario:** {{ $questionnaire_name }}<br>
**Alerta:** {{ $alert_name }}<br>
**Alerta ID:** {{ $alert_uuid }}<br>

@if(!empty($recommendation_for_department))
**Recomendación para el departamento:**<br>
{{ $recommendation_for_department }}
@endif

<x-mail::button :url="route('alert.index')">
Ver detalles de la alerta
</x-mail::button>

Si tienes dudas, contacta al equipo de soporte.

Gracias.<br>

</x-mail::message>
