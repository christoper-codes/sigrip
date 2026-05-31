{{-- ============================================================
     Features — 2-column · phone card lands left · steps right
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
            class="flex items-center justify-between px-8 sm:px-10 lg:px-16 py-7 border-b"
            :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
        >
            <span class="text-[10px] font-bold uppercase tracking-[0.2em]" :class="$store.appearance.dark ? 'text-zinc-500' : 'text-zinc-400'">
                Cómo funciona
            </span>
            <a
                href="{{ route('register') }}" wire:navigate
                :class="$store.appearance.dark ? 'text-zinc-500 hover:text-white' : 'text-zinc-400 hover:text-zinc-900'"
                class="text-xs font-medium transition-colors duration-200 flex items-center gap-1"
            >
                Ver demo
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- 2-column grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- ── LEFT: phone card landing zone ─────────────────────── --}}
            <div
                class="border-b lg:border-b-0 lg:border-r flex items-center justify-center p-8 lg:p-12 min-h-160 relative overflow-hidden"
                :class="$store.appearance.dark ? 'border-zinc-800 bg-[#080808]' : 'border-zinc-200 bg-zinc-100'"
            >
                {{-- Ambient blur decoration --}}
                <div
                    class="absolute inset-0 bg-cover bg-center opacity-10 blur-3xl scale-125 animate-pulse pointer-events-none"
                    style="background-image: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/a37bed4a-3482-4d77-8630-f16831c0d7a9_1600w.webp'); animation-duration: 4s;"
                    aria-hidden="true"
                ></div>

                {{-- Landing placeholder (hidden until flying card arrives) --}}
                <div
                    id="features-landing"
                    class="relative w-64 aspect-9/16 rounded-4xl overflow-hidden shadow-2xl border border-[#222] ring-1 ring-white/5"
                    style="opacity: 0; will-change: opacity; transition: opacity 0.35s ease;"
                >
                    <img
                        src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/16391788-f7da-4cd2-88de-e0421c307b8f_800w.webp"
                        class="w-full h-full object-cover"
                        alt="SIGRIP NOM-035"
                    />
                    <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-black/20"></div>

                    <div class="absolute inset-0 p-5 flex flex-col justify-between z-10">
                        {{-- Status badge --}}
                        <div class="glass-panel px-3 py-1 rounded-full text-[11px] font-medium flex items-center gap-2 text-white w-fit">
                            <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                            ANÁLISIS ACTIVO
                        </div>

                        {{-- Caption --}}
                        <div class="glass-panel p-4 rounded-2xl border border-white/5 shadow-lg">
                            <p class="text-base font-bold text-yellow-400 text-center leading-tight">
                                "El bienestar es tu ventaja competitiva."
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Floating score badge --}}
                <div
                    class="glass-panel absolute bottom-10 right-10 p-3.5 rounded-2xl flex items-center gap-3 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.6)] border border-white/10 z-20"
                    id="features-badge"
                    style="opacity: 0; transition: opacity 0.35s ease 0.15s;"
                >
                    <div class="bg-blue-500/15 p-2 rounded-lg text-blue-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m7 14l2.293-2.293a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 0 1.414 0L17 10m0 0v2.5m0-2.5h-2.5"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] text-zinc-500 uppercase tracking-wider">Score NOM-035</div>
                        <div class="text-base font-bold text-white leading-none mt-0.5">94<span class="text-zinc-600 text-xs font-normal">/100</span></div>
                    </div>
                </div>

            </div>{{-- /left column --}}

            {{-- ── RIGHT: 3 stacked feature steps ─────────────────────── --}}
            <div class="flex flex-col justify-center divide-y" :class="$store.appearance.dark ? 'divide-zinc-800' : 'divide-zinc-200'">

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
                        'desc'  => 'Identifica factores de riesgo psicosocial por área, turno y puesto. Dashboards en tiempo real con insights accionables para tu equipo.',
                    ],
                    [
                        'step'  => '03',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>',
                        'title' => 'Cumplimiento y reporte',
                        'desc'  => 'Genera el informe de resultados listo para la STPS. Programa de acciones preventivas integrado y seguimiento de incidentes laborales.',
                    ],
                ];
                @endphp

                @foreach ($features as $f)
                <div class="flex items-start gap-6 p-8 sm:p-10 lg:p-12">
                    {{-- Step number --}}
                    <span
                        class="text-[11px] font-bold tracking-[0.2em] uppercase tabular-nums pt-0.5 shrink-0 w-6"
                        :class="$store.appearance.dark ? 'text-zinc-700' : 'text-zinc-300'"
                    >{{ $f['step'] }}</span>

                    {{-- Icon --}}
                    <div
                        :class="$store.appearance.dark ? 'bg-zinc-900 border-zinc-800' : 'bg-zinc-100 border-zinc-200'"
                        class="w-9 h-9 rounded-xl border flex items-center justify-center shrink-0"
                    >
                        <svg class="w-4.5 h-4.5" :class="$store.appearance.dark ? 'text-zinc-300' : 'text-zinc-600'" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            {!! $f['icon'] !!}
                        </svg>
                    </div>

                    {{-- Text --}}
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold tracking-tight mb-1.5" :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'">
                            {{ $f['title'] }}
                        </h3>
                        <p class="text-sm leading-relaxed" :class="$store.appearance.dark ? 'text-zinc-500' : 'text-zinc-500'">
                            {{ $f['desc'] }}
                        </p>
                    </div>
                </div>
                @endforeach

            </div>{{-- /right column --}}

        </div>{{-- /2-col grid --}}
    </div>{{-- /bordered container --}}
</div>

{{-- Sync features-badge opacity with features-landing --}}
<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        var landing = document.getElementById('features-landing');
        var badge   = document.getElementById('features-badge');
        if (!landing || !badge) return;
        new MutationObserver(function() {
            badge.style.opacity = landing.style.opacity;
        }).observe(landing, { attributes: true, attributeFilter: ['style'] });
    });
})();
</script>
