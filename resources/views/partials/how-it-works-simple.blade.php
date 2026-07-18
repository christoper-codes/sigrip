{{-- ============================================================
     How it works — minimal, text-only version
     No cards, no icons — just a short numbered list.
     ============================================================ --}}

@php
$steps = [
    ['n' => '01', 'title' => 'Configura tu empresa', 'desc' => 'Departamentos, roles y empleados en minutos.'],
    ['n' => '02', 'title' => 'Lanza los cuestionarios', 'desc' => 'Guías NOM-035 listas para responder desde cualquier dispositivo.'],
    ['n' => '03', 'title' => 'Da seguimiento y cumple', 'desc' => 'Alertas, reevaluación automática y evidencia lista para auditoría.'],
];
@endphp

<section id="como-funciona" class="w-full py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-6 sm:px-8">

        <div class="max-w-2xl mb-16 animate-blur-fade-up">
            <span class="block text-dark dark:text-light font-light text-[0.7rem] tracking-[0.2em] uppercase mb-4">
                Cómo funciona
            </span>
            <h2 class="text-dark dark:text-light text-4xl sm:text-5xl font-normal tracking-tight leading-[1.08]">
                Tres pasos, sin complicaciones.
            </h2>
        </div>

        <div class="divide-y divide-black/8 dark:divide-white/10">
            @foreach ($steps as $i => $step)
                <div class="flex items-baseline gap-6 py-8 animate-blur-fade-up {{ $i === 1 ? 'animation-delay-200' : ($i === 2 ? 'animation-delay-400' : '') }}">
                    <span class="text-sm font-light text-dark/40 dark:text-light/40 tabular-nums shrink-0">{{ $step['n'] }}</span>
                    <div>
                        <h3 class="text-dark dark:text-light text-xl font-medium tracking-tight">{{ $step['title'] }}</h3>
                        <p class="mt-1 text-dark/60 dark:text-light/60 text-base font-light">{{ $step['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
