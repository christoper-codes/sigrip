<section id="brands" class="relative border-y border-border/50 bg-neutral-50 dark:bg-card/30 py-10 overflow-hidden">
    <!-- Fade edges -->
    <div class="pointer-events-none absolute left-0 top-0 z-10 h-full w-28 bg-linear-to-r from-neutral-50 dark:from-[#08090d] to-transparent"></div>
    <div class="pointer-events-none absolute right-0 top-0 z-10 h-full w-28 bg-linear-to-l from-neutral-50 dark:from-[#08090d] to-transparent"></div>

    <!-- Row 1: Tech & IA features -->
    <div class="animate-marquee flex w-max items-center gap-3 mb-3">
        @php
        $row1 = [
            ['color' => 'blue',   'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'label' => 'Inteligencia Artificial'],
            ['color' => 'green',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'NOM-035 Incluido'],
            ['color' => 'amber',  'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'label' => 'Alertas Automáticas'],
            ['color' => 'violet', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'label' => 'Análisis Predictivo'],
            ['color' => 'blue',   'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Tickets Anónimos'],
            ['color' => 'green',  'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'label' => 'Datos Encriptados'],
            ['color' => 'violet', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label' => 'Reportes con IA'],
            ['color' => 'amber',  'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'label' => 'Tiempo Real'],
            ['color' => 'blue',   'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'label' => 'API de Integración'],
            ['color' => 'green',  'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'label' => 'Cumplimiento STPS'],
            ['color' => 'violet', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Gestión de Empleados'],
            ['color' => 'amber',  'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Soporte 24/7'],
        ];
        // Duplicate for seamless loop
        $row1 = array_merge($row1, $row1);
        @endphp

        @php
        $colors = [
            'blue'   => ['border' => 'border-neutral-200 dark:border-blue-500/20',   'bg' => 'bg-neutral-50 dark:bg-blue-500/8',   'text' => 'text-neutral-500 dark:text-blue-400/70',   'icon' => 'text-neutral-400 dark:text-blue-400/60'],
            'green'  => ['border' => 'border-neutral-200 dark:border-green-500/20',  'bg' => 'bg-neutral-50 dark:bg-green-500/8',  'text' => 'text-neutral-500 dark:text-green-400/70',  'icon' => 'text-neutral-400 dark:text-green-400/60'],
            'amber'  => ['border' => 'border-neutral-200 dark:border-amber-500/20',  'bg' => 'bg-neutral-50 dark:bg-amber-500/8',  'text' => 'text-neutral-500 dark:text-amber-400/70',  'icon' => 'text-neutral-400 dark:text-amber-400/60'],
            'violet' => ['border' => 'border-neutral-200 dark:border-violet-500/20', 'bg' => 'bg-neutral-50 dark:bg-violet-500/8', 'text' => 'text-neutral-500 dark:text-violet-400/70', 'icon' => 'text-neutral-400 dark:text-violet-400/60'],
        ];
        @endphp

        @foreach ($row1 as $item)
        @php $c = $colors[$item['color']]; @endphp
        <div class="flex items-center gap-2 px-4 py-2 border {{ $c['border'] }} {{ $c['bg'] }} whitespace-nowrap shrink-0 mx-1.5">
            <svg class="h-3.5 w-3.5 {{ $c['icon'] }} shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
            </svg>
            <span class="text-[11px] font-semibold tracking-wide {{ $c['text'] }}">{{ $item['label'] }}</span>
        </div>
        @endforeach
    </div>

    <!-- Row 2: Reverse direction -->
    <div class="animate-marquee-reverse flex w-max items-center gap-3">
        @php
        $row2 = [
            ['color' => 'green',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'label' => 'Cuestionarios Inteligentes'],
            ['color' => 'blue',   'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'label' => 'Machine Learning'],
            ['color' => 'violet', 'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z', 'label' => 'Dashboard Inteligente'],
            ['color' => 'amber',  'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z', 'label' => 'Gestión de Riesgos'],
            ['color' => 'blue',   'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'label' => 'Métricas Avanzadas'],
            ['color' => 'green',  'icon' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z', 'label' => 'Nube Segura'],
            ['color' => 'violet', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'label' => 'Notificaciones Push'],
            ['color' => 'amber',  'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label' => 'Reportes Automáticos'],
            ['color' => 'blue',   'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9', 'label' => 'Acceso Multi-Dispositivo'],
            ['color' => 'green',  'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'ROI Comprobado'],
            ['color' => 'violet', 'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1', 'label' => 'Integración Google Drive'],
            ['color' => 'amber',  'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Capacitación de Equipos'],
        ];
        $row2 = array_merge($row2, $row2);
        @endphp

        @foreach ($row2 as $item)
        @php $c = $colors[$item['color']]; @endphp
        <div class="flex items-center gap-2 px-4 py-2 border {{ $c['border'] }} {{ $c['bg'] }} whitespace-nowrap shrink-0 mx-1.5">
            <svg class="h-3.5 w-3.5 {{ $c['icon'] }} shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
            </svg>
            <span class="text-[11px] font-semibold tracking-wide {{ $c['text'] }}">{{ $item['label'] }}</span>
        </div>
        @endforeach
    </div>
</section>
