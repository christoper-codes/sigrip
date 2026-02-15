
# Neura: Automatización NOM-035 con Laravel 🚀

![Hero](public/images/hero.png)

Neura es una plataforma TALL Stack diseñada para automatizar el cumplimiento de la Norma Oficial Mexicana 035 (NOM-035) en bienestar laboral, prevención de riesgos psicosociales y gestión de incidentes.

---

## Convenciones y buenas prácticas 🧠

- **Laravel Boost + AI:** El proyecto utiliza Laravel Boost para guiar la IA y mantener código actualizado.
- **Facades sobre helpers:** Preferir facades (`Auth::user()`) sobre helpers (`auth()->user()`).
- **Controladores CRUDDY:** Todos los controladores siguen el patrón CRUDDY by Design (solo los 7 métodos resourceful).
- **Patrón Actions:** La lógica de negocio se encapsula en clases Action para desacoplar y limpiar el código.
- **Documentación técnica:** Actualizar README y archivos de instrucciones para la IA tras cada cambio relevante.

---

## Herramientas y tecnologías principales 🛠️

- **TALL Stack:**
	- Tailwind CSS v4.1.18
	- Alpine.js
	- Laravel v12.51.0
	- Livewire v3.7.10
- **Laravel Boost v2.1.4**
- **Laravel Reverb v1.7.1**
- **Livewire Volt v1.10.2**
- **Livewire Flux v2.12.0**
- **phpstan v2.1.39**
- **Laravel Pint v1.27.1**
- **Colas:** Jobs y workers para tareas asíncronas.
- **Tickets:** Sistema para reportar incidentes laborales, incluyendo tickets anónimos.
- **Notificaciones:** Automáticas y en tiempo real para RH y empleados.

---

## Funcionalidades principales ⚡

- **Automatización NOM-035:** Cuestionarios inteligentes, alertas automáticas, reportes y análisis predictivo.
- **Tickets de incidentes:** Reporte y seguimiento de incidentes laborales, dashboard para RH.
- **Notificaciones en tiempo real:** Alertas push, emails automáticos y dashboard interactivo.
- **Análisis predictivo:** IA que detecta riesgos antes de que ocurran y previene demandas laborales.

---

## Estructura técnica del proyecto 🗂️

- `.ai/guidelines/`: Convenciones personalizadas y guías para la IA.
- `app/Actions/`: Clases Action para lógica de negocio.
- `app/Livewire/`: Componentes Livewire organizados por módulos:
	- `Actions/`
	- `Alert/`
	- `Analysis/`
	- `Application/`
	- `Company/`
	- `Department/`
	- `Employee/`
	- `Forms/`
	- `Notifications/`
	- `Questionnaire/`
	- `Ticket/`
	- `Traits/`
- `resources/views/app/`: Vistas principales de la aplicación.
- `resources/views/partials/`: Componentes Blade reutilizables.
- `public/images/hero.png`: Imagen principal del proyecto.

---

**Neura** es la solución integral para el cumplimiento automatizado de NOM-035, mejorando el bienestar laboral y la gestión de riesgos en las empresas mexicanas. 🏢✨
