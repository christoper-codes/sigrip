{{-- ============================================================
     Services — SIGRIP · NOM-035
     3-card showcase of the product screens. Unlike header/hero, this
     section follows the site's normal dark mode (text-dark dark:text-light).
     ============================================================ --}}

@php
$services = [
    [
        'image' => 'hero-ascii-1.png',
        'title' => 'Cuestionarios para empleados',
        'desc'  => 'Guías de referencia NOM-035 listas para responder desde cualquier dispositivo, con departamento y vigencia siempre a la vista.',
    ],
    [
        'image' => 'hero-ascii-2.png',
        'title' => 'Panel de administración',
        'desc'  => 'Dashboard con IA, tiempos de respuesta y seguridad de datos en un solo lugar para tu equipo de RH.',
    ],
    [
        'image' => 'hero-ascii-3.png',
        'title' => 'Gestión de cuestionarios',
        'desc'  => 'Activa, edita y evalúa el riesgo psicosocial de cada cuestionario basado en la NORMA Oficial Mexicana NOM-035-STPS-2018.',
    ],
];
@endphp

<section id="servicios" class="w-full py-24 sm:py-32 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">

        <div class="max-w-2xl mb-16 animate-blur-fade-up">
            <span class="block text-dark dark:text-light font-light text-[0.7rem] tracking-[0.2em] uppercase mb-4">
                Servicios
            </span>
            <h2 class="text-dark dark:text-light text-4xl sm:text-5xl font-normal tracking-tight leading-[1.08]">
                Todo lo que tu equipo necesita para cumplir la NOM-035.
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach ($services as $i => $service)
                <div class="animate-blur-fade-up {{ $i === 1 ? 'animation-delay-200' : ($i === 2 ? 'animation-delay-400' : '') }}">
                    <div class="aspect-video rounded-2xl overflow-hidden border border-black/8 dark:border-white/10 shadow-[0_20px_60px_-20px_rgba(0,0,0,0.25)]">
                        <img
                            src="{{ asset('images/' . $service['image']) }}"
                            alt="{{ $service['title'] }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        >
                    </div>
                    <h3 class="mt-6 text-dark dark:text-light text-lg font-medium tracking-tight">
                        {{ $service['title'] }}
                    </h3>
                    <p class="mt-2 text-dark/60 dark:text-light/60 text-sm leading-relaxed font-light">
                        {{ $service['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-16 flex justify-center animate-blur-fade-up animation-delay-600">
            <x-ui.btn-primary href="{{ route('register') }}" wire:navigate :adaptive="true">
                Comenzar gratis
            </x-ui.btn-primary>
        </div>

    </div>
</section>
