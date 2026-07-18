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

<section id="servicios" class="w-full py-24 sm:py-32 transition-colors duration-300" x-data="{ lightbox: null }">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">

        <div class="max-w-2xl mb-16 animate-blur-fade-up">
            <span class="block text-dark dark:text-light font-light text-[0.7rem] tracking-[0.2em] uppercase mb-4">
                Servicios
            </span>
            <h2 class="text-dark dark:text-light text-4xl sm:text-5xl font-normal tracking-tight leading-[1.08] mb-8">
                Todo lo que tu equipo necesita para cumplir la NOM-035.
            </h2>
            <x-ui.btn-primary href="{{ route('register') }}" wire:navigate :adaptive="true">
                Comenzar gratis
            </x-ui.btn-primary>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach ($services as $i => $service)
                <div class="animate-blur-fade-up {{ $i === 1 ? 'animation-delay-200' : ($i === 2 ? 'animation-delay-400' : '') }}">
                    <div
                        class="aspect-video rounded-2xl overflow-hidden border border-black/8 dark:border-white/10 shadow-[0_20px_60px_-20px_rgba(0,0,0,0.25)] cursor-zoom-in transition-transform duration-300 hover:scale-[1.02]"
                        @click="lightbox = '{{ asset('images/' . $service['image']) }}'"
                    >
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
    </div>

    {{-- Image lightbox --}}
    <div
        x-show="lightbox"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="lightbox = null"
        @keydown.escape.window="lightbox = null"
        class="fixed inset-0 z-100 flex items-center justify-center p-6 sm:p-12 backdrop-blur-2xl bg-black/70"
    >
        <button
            @click="lightbox = null"
            class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors duration-200 cursor-pointer"
            aria-label="Cerrar"
        >
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>

        <img
            :src="lightbox"
            x-show="lightbox"
            x-transition:enter="transition ease-out duration-200 delay-75"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="max-w-full max-h-full rounded-2xl shadow-2xl object-contain"
        >
    </div>
</section>
