{{-- ============================================================
     How it works — SIGRIP · NOM-035
     Bento-style feature grid connected by animated SVG paths on
     desktop, 2-column card grid on mobile. Cards reuse the same
     liquid-glass system as the buttons (adaptive to $flux.dark).
     ============================================================ --}}

@php
$steps = [
    [
        'top' => 24, 'left' => 8,
        'title' => 'Diagnóstico en minutos',
        'bullets' => ['Configura tu empresa sin fricción', 'Listo en minutos, sin instalar nada'],
        'icon' => '<path d="M52 8 q-6 1 -14 7 q-9 7 -13 16 q-2 5 -2 10 l6 -3 q9 -5 15 -13 q7 -9 8 -17 Z"/><path d="M48 12 q-10 9 -17 20 q-4 7 -6 13" stroke-width="1.2"/><path d="M42 15 L36 18" stroke-width="1"/><path d="M38 21 L31 25" stroke-width="1"/><path d="M34 27 L28 32" stroke-width="1"/><path d="M31 34 L25 38" stroke-width="1"/><path d="M23 41 L18 52"/><path d="M12 56 q8 -3 16 0 q8 3 16 0" stroke-width="1.3"/><circle cx="16" cy="49" r="1.2" fill="currentColor" stroke="none"/><circle cx="52" cy="52" r="1" fill="currentColor" stroke="none"/><path d="M55 24 Q55 30 61 30 Q55 30 55 36 Q55 30 49 30 Q55 30 55 24 Z" fill="currentColor" stroke-width="1"/>',
    ],
    [
        'top' => 250, 'left' => 8,
        'title' => 'Acceso para tu equipo',
        'bullets' => ['Cada colaborador responde desde su celular', 'Roles y permisos por departamento'],
        'icon' => '<circle cx="29" cy="29" r="21"/><path d="M8 29 L50 29" stroke-width="1.2"/><path d="M29 8 q-11 10 -11 21 q0 11 11 21" stroke-width="1.2"/><path d="M29 8 q11 10 11 21 q0 11 -11 21" stroke-width="1.2"/><path d="M12 18 q17 6 34 0" stroke-width="1"/><path d="M12 40 q17 -6 34 0" stroke-width="1"/><path d="M35 22 q4 0 4 4 q0 3 -4 7 q-4 -4 -4 -7 q0 -4 4 -4 Z" fill="currentColor" stroke-width="1.1"/><circle cx="41" cy="41" r="13"/><path d="M50.5 50.5 L59 59" stroke-width="2.4"/><path d="M34 38 q7 -4 14 0" stroke-width="1"/>',
    ],
    [
        'top' => 4, 'left' => 332,
        'title' => 'Cumplimiento verificado',
        'bullets' => ['Alineado a la NOM-035-STPS-2018', 'Evidencia lista para auditoría'],
        'icon' => '<path d="M32 51 C 21 37 21 10 32 10 C 43 10 43 37 32 51 Z"/><circle cx="32" cy="23" r="6.5" stroke-width="1.3"/><circle cx="32" cy="23" r="2" fill="currentColor" stroke="none"/><path d="M23 54 q9 4 18 0" stroke-width="1.2"/><path d="M49 16 L53 14" stroke-width="1.1"/><path d="M12 44 L16 43" stroke-width="1.1"/><circle cx="51" cy="40" r="1.1" fill="currentColor" stroke="none"/>',
    ],
    [
        'top' => 244, 'left' => 332,
        'title' => 'Seguimiento y alertas',
        'bullets' => ['Vigencia y reevaluación automática', 'Notificaciones a RH en tiempo real'],
        'icon' => '<path d="M9 16 L55 16 L55 55 L9 55 Z"/><path d="M9 26 L55 26"/><path d="M20 8 L20 20"/><path d="M44 8 L44 20"/><rect x="15" y="32" width="8" height="7" rx="1.2" fill="currentColor" stroke="none"/><rect x="28" y="32" width="8" height="7" rx="1.2" stroke-width="1.3"/><rect x="41" y="32" width="8" height="7" rx="1.2" fill="currentColor" stroke="none"/><rect x="15" y="44" width="8" height="7" rx="1.2" stroke-width="1.3"/><rect x="28" y="44" width="8" height="7" rx="1.2" fill="currentColor" stroke="none"/><rect x="41" y="44" width="8" height="7" rx="1.2" stroke-width="1.3"/><path d="M14 21.5 L17 21.5" stroke-width="1.1"/><path d="M28 21.5 L36 21.5" stroke-width="1.1"/><path d="M50 21.5 L50 21.5" stroke-width="1.1"/>',
    ],
    [
        'top' => 24, 'left' => 656,
        'title' => 'Analítica con IA',
        'bullets' => ['Detecta riesgos psicosociales por área', 'Datos protegidos, sin exponer identidad'],
        'icon' => '<circle cx="32" cy="34" r="23"/><circle cx="32" cy="34" r="18" stroke-width="1.2"/><path d="M27 10 L28 6 L36 6 L37 10"/><path d="M32 17 L32 20.5" stroke-width="1.3"/><path d="M32 47.5 L32 51" stroke-width="1.3"/><path d="M17 34 L20.5 34" stroke-width="1.3"/><path d="M43.5 34 L47 34" stroke-width="1.3"/><path d="M21.5 23.5 L23.5 25.5" stroke-width="1"/><path d="M42.5 23.5 L40.5 25.5" stroke-width="1"/><path d="M21.5 44.5 L23.5 42.5" stroke-width="1"/><path d="M42.5 44.5 L40.5 42.5" stroke-width="1"/><path d="M32 22 L36 34 L28 34 Z" fill="currentColor" stroke-width="1.2"/><path d="M32 46 L36 34 L28 34 Z" stroke-width="1.2"/><circle cx="32" cy="34" r="2" fill="currentColor" stroke="none"/><circle cx="54" cy="13" r="1" fill="currentColor" stroke="none"/><path d="M57 19 L59 17" stroke-width="1.1"/>',
    ],
    [
        'top' => 250, 'left' => 656,
        'title' => 'Actualiza sin fricción',
        'bullets' => ['Edita cuestionarios desde el panel', 'Cambios visibles al instante'],
        'icon' => '<path d="M20 12 L20 45 L28 37.5 L33.5 50 L38.5 47.8 L33 35.5 L42 35 Z"/><path d="M16 9 L13 6" stroke-width="1.1"/><path d="M25 7.5 L26.5 4.5" stroke-width="1.1"/><path d="M54 20 Q54 25 59 25 Q54 25 54 30 Q54 25 49 25 Q54 25 54 20 Z" fill="currentColor" stroke-width="1"/><circle cx="47" cy="51" r="1" fill="currentColor" stroke="none"/>',
    ],
];
@endphp

<section id="como-funciona" class="w-full py-24 sm:py-32">
    <div class="mx-auto max-w-6xl px-6 sm:px-8">

        <div class="max-w-2xl mb-16 animate-blur-fade-up">
            <span class="block text-dark dark:text-light font-light text-[0.7rem] tracking-[0.2em] uppercase mb-4">
                Cómo funciona
            </span>
            <h2 class="text-dark dark:text-light text-4xl sm:text-5xl font-normal tracking-tight leading-[1.08]">
                De la configuración al cumplimiento, sin complicaciones.
            </h2>
        </div>

        {{-- Desktop: bento grid with connector lines --}}
        <div class="relative hidden h-125 lg:block">
            <div class="absolute left-1/2 top-8 h-[440px] w-[900px] -translate-x-1/2 select-none">
                <svg class="pointer-events-none absolute inset-0 h-full w-full overflow-visible" viewBox="0 0 900 440" fill="none" preserveAspectRatio="none">
                    <g class="text-black/10 dark:text-white/15" stroke="currentColor" stroke-width="1.5">
                        <path d="M240,85 C288,85 284,65 338,65" stroke-dasharray="5 6" style="animation: bn-flow 1.1s linear infinite;"></path>
                        <path d="M564,65 C610,65 612,85 662,85"></path>
                        <path d="M240,311 C288,311 284,305 338,305"></path>
                        <path d="M564,305 C610,305 612,311 662,311"></path>
                        <path d="M451,119 C451,160 451,205 451,250"></path>
                        <path d="M127,139 C127,175 127,215 127,256"></path>
                    </g>
                </svg>

                @foreach ($steps as $step)
                    <div class="absolute w-[238px]" style="top: {{ $step['top'] }}px; left: {{ $step['left'] }}px;">
                        <div class="rounded-2xl p-5" :class="$flux.dark ? 'liquid-glass' : 'liquid-glass-light'">
                            <div class="flex items-center gap-2.5 pb-2.5 border-b border-black/8 dark:border-white/10">
                                <svg class="size-8 shrink-0 text-dark dark:text-light" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    {!! $step['icon'] !!}
                                </svg>
                                <span class="text-[13px] font-semibold text-dark dark:text-light">{{ $step['title'] }}</span>
                            </div>
                            <div class="flex flex-col gap-1.5 pt-2.5">
                                @foreach ($step['bullets'] as $bullet)
                                    <span class="flex items-center gap-2 text-[12px] text-dark/60 dark:text-light/60">
                                        <span aria-hidden="true" class="h-px w-3 shrink-0 bg-dark/30 dark:bg-light/30"></span>
                                        {{ $bullet }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="absolute -top-2 -right-3 z-10 flex items-center gap-1.5 rounded-lg bg-black dark:bg-white px-2.5 py-1.5 text-[11px] font-medium text-white dark:text-black shadow-xl shadow-black/40">
                            <svg class="size-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                            </svg>
                            Incluido
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Mobile: simple 2-column grid, no connectors --}}
        <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:hidden">
            @foreach ($steps as $step)
                <div class="rounded-2xl p-5" :class="$flux.dark ? 'liquid-glass' : 'liquid-glass-light'">
                    <div class="flex items-start gap-3">
                        <svg class="size-11 shrink-0 text-dark dark:text-light" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {!! $step['icon'] !!}
                        </svg>
                        <div class="flex-1">
                            <span class="block font-semibold leading-tight text-dark dark:text-light">{{ $step['title'] }}</span>
                            <div class="mt-2 flex flex-col gap-2">
                                @foreach ($step['bullets'] as $bullet)
                                    <span class="flex items-center gap-2.5 text-sm text-dark/60 dark:text-light/60">
                                        <span aria-hidden="true" class="h-px w-3 shrink-0 bg-dark/30 dark:bg-light/30"></span>
                                        <span>{{ $bullet }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
