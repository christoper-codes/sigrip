{{-- ============================================================
     Features — Cómo funciona · 3 pasos · NOM-035
     Continúa el bordered max-w-7xl del hero
     ============================================================ --}}
<div
    x-data
    :class="$store.appearance.dark ? 'bg-[#050505]' : 'bg-zinc-50'"
    class="transition-colors duration-300"
>
    <div
        class="max-w-7xl mx-auto border-x border-b"
        :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
    >
        {{-- Section header --}}
        <div
            class="flex items-center justify-between px-8 sm:px-10 lg:px-16 py-8 border-b"
            :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
        >
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-bold uppercase tracking-[0.2em]" :class="$store.appearance.dark ? 'text-zinc-500' : 'text-zinc-400'">Cómo funciona</span>
            </div>
            <a
                href="{{ route('register') }}" wire:navigate
                :class="$store.appearance.dark ? 'text-zinc-500 hover:text-white' : 'text-zinc-400 hover:text-zinc-900'"
                class="text-xs font-medium transition-colors duration-200 flex items-center gap-1"
            >
                Ver demo
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- 3-column feature grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3">

            @php
            $features = [
                [
                    'step'  => '01',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>',
                    'title' => 'Diagnóstico NOM-035',
                    'desc'  => 'Configura tu organización y lanza cuestionarios inteligentes en minutos. La IA adapta las preguntas al perfil de cada trabajador.',
                ],
                [
                    'step'  => '02',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>',
                    'title' => 'Análisis de riesgos',
                    'desc'  => 'Identifica factores de riesgo psicosocial por área, turno o puesto. Dashboards en tiempo real con insights accionables.',
                ],
                [
                    'step'  => '03',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>',
                    'title' => 'Cumplimiento y reporte',
                    'desc'  => 'Genera el informe de resultados listo para la STPS. Programa de acciones preventivas integrado y seguimiento de incidentes.',
                ],
            ];
            @endphp

            @foreach ($features as $i => $f)
            <div
                class="p-8 sm:p-10 lg:p-12 flex flex-col gap-6 {{ $i < 2 ? 'border-b md:border-b-0 md:border-r' : '' }}"
                :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
            >
                {{-- Step + icon row --}}
                <div class="flex items-start justify-between">
                    <span
                        class="text-[11px] font-bold tracking-[0.2em] uppercase tabular-nums"
                        :class="$store.appearance.dark ? 'text-zinc-600' : 'text-zinc-400'"
                    >{{ $f['step'] }}</span>
                    <div
                        :class="$store.appearance.dark ? 'bg-zinc-900 border-zinc-800' : 'bg-zinc-100 border-zinc-200'"
                        class="w-10 h-10 rounded-xl border flex items-center justify-center shrink-0"
                    >
                        <svg
                            class="w-5 h-5"
                            :class="$store.appearance.dark ? 'text-zinc-300' : 'text-zinc-600'"
                            fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                        >{!! $f['icon'] !!}</svg>
                    </div>
                </div>

                {{-- Text --}}
                <div>
                    <h3
                        :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'"
                        class="text-base font-semibold mb-2 tracking-tight"
                    >{{ $f['title'] }}</h3>
                    <p
                        :class="$store.appearance.dark ? 'text-zinc-500' : 'text-zinc-500'"
                        class="text-sm leading-relaxed"
                    >{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
