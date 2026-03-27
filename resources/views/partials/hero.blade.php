<!-- Hero -->
<section id="hero" class="relative flex min-h-screen flex-col bg-white dark:bg-[#060608]">

    <main class="relative z-10 flex flex-1 flex-col items-center justify-center px-6 pt-32 pb-24 text-center">

        <!-- Social proof -->
        <div class="animate-fade-up mb-7 inline-flex items-center gap-3">
            <div class="flex -space-x-2">
                <div class="h-7 w-7 rounded-full ring-2 ring-white dark:ring-[#060608] bg-linear-to-br from-blue-400 to-blue-600 flex items-center justify-center text-[9px] font-bold text-white">AM</div>
                <div class="h-7 w-7 rounded-full ring-2 ring-white dark:ring-[#060608] bg-linear-to-br from-violet-400 to-violet-600 flex items-center justify-center text-[9px] font-bold text-white">LG</div>
                <div class="h-7 w-7 rounded-full ring-2 ring-white dark:ring-[#060608] bg-linear-to-br from-sky-400 to-sky-600 flex items-center justify-center text-[9px] font-bold text-white">CR</div>
            </div>
            <span class="text-[12px] font-medium text-neutral-400 dark:text-white/35">+15 empresas ya confían en nosotros</span>
        </div>

        <!-- Badge -->
        <div class="animate-fade-up mb-9 inline-flex items-center gap-2.5 border border-neutral-200 dark:border-neutral-700 px-5 py-2 backdrop-blur-sm whitespace-nowrap">
            <span class="text-[9px] font-semibold tracking-[0.18em] text-neutral-500 dark:text-white/60 uppercase">Impulsado por Inteligencia Artificial</span>
        </div>

        <!-- Headline -->
        <h1 class="animate-fade-up opacity-0 animation-delay-200 mx-auto uppercase max-w-5xl text-4xl lg:text-[64px] font-extrabold leading-[1.02] tracking-[-0.03em] text-neutral-900 dark:text-white special-font">
            Cumplimiento normativo<br />
            <span class="bg-clip-text text-transparent bg-linear-to-r from-orange-400 to-orange-600">
                NOM-035 & STPS
            </span>
        </h1>

        <!-- Subtitle -->
        <p class="animate-fade-up opacity-0 animation-delay-400 mx-auto mt-7 max-w-md text-[15px] leading-[1.85] text-neutral-500 dark:text-white/45">
            Detecta riesgos psicosociales antes de que escalen. Cuestionarios inteligentes y alertas automatizadas con IA.
        </p>

        <!-- CTAs -->
        <div class="animate-fade-up opacity-0 animation-delay-600 mt-10 flex flex-col items-center gap-3 sm:flex-row">
            <a href="{{ route('register') }}" wire:navigate class="group bg-linear-to-r from-orange-500 to-orange-600 relative inline-flex lg:min-w-[210px] h-12 w-full items-center justify-center overflow-hidden px-8 text-sm font-semibold text-white transition-all duration-300 hover:shadow-lg hover:shadow-orange-600/30">
                <span class="relative z-10 tracking-wide">Comenzar gratis →</span>
            </a>
            <a href="{{ route('login') }}" wire:navigate class="inline-flex h-12 w-full lg:min-w-[160px] items-center justify-center border border-neutral-200 dark:border-white/10 bg-neutral-100 dark:bg-white/5 px-8 text-sm font-medium tracking-wide text-neutral-600 dark:text-white/45 transition-all duration-200 hover:border-neutral-300 dark:hover:border-white/20 hover:bg-neutral-200 dark:hover:bg-white/10 hover:text-neutral-900 dark:hover:text-white/80">
                Iniciar sesión
            </a>
        </div>

        <p class="mt-4 text-[11px] font-medium tracking-widest text-neutral-400 dark:text-white/20 uppercase">Sin tarjeta de crédito · Cancela cuando quieras</p>

        <!-- Stats grid -->
        <div class="animate-fade-up opacity-0 animation-delay-600 mt-16 w-full max-w-2xl grid grid-cols-2 lg:grid-cols-4 border border-neutral-200 dark:border-white/6 bg-neutral-50 dark:bg-white/2 divide-x divide-neutral-200 dark:divide-white/6">
            <div class="flex flex-col items-center gap-1.5 px-6 py-5">
                <span class="text-2xl font-bold text-neutral-900 dark:text-white tabular-nums">+15</span>
                <span class="text-[10px] font-medium tracking-[0.15em] text-neutral-400 dark:text-white/20 uppercase">Empresas</span>
            </div>
            <div class="flex flex-col items-center gap-1.5 px-6 py-5">
                <span class="text-2xl font-bold text-neutral-900 dark:text-white tabular-nums">6</span>
                <span class="text-[10px] font-medium tracking-[0.15em] text-neutral-400 dark:text-white/20 uppercase">Cuestionarios NOM-035</span>
            </div>
            <div class="flex flex-col items-center gap-1.5 px-6 py-5">
                <span class="text-2xl font-bold text-neutral-900 dark:text-white tabular-nums">100%</span>
                <span class="text-[10px] font-medium tracking-[0.15em] text-neutral-400 dark:text-white/20 uppercase">Cumplimiento</span>
            </div>
            <div class="flex flex-col items-center gap-1.5 px-6 py-5">
                <span class="text-2xl font-bold text-neutral-900 dark:text-white tabular-nums">24/7</span>
                <span class="text-[10px] font-medium tracking-[0.15em] text-neutral-400 dark:text-white/20 uppercase">Monitoreo IA</span>
            </div>
        </div>
    </main>

    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex-col items-center gap-1.5 text-neutral-300 dark:text-white/15 animate-bounce hidden lg:flex">
        <span class="text-[9px] tracking-[0.2em] uppercase font-medium">Scroll</span>
        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>
