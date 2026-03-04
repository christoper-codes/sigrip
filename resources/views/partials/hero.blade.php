<!-- Hero -->
<section id="hero"  class="relative flex min-h-screen flex-col bg-[#060608] lg:h-screen lg:overflow-hidden">
    <!-- Ambient glow -->
    <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
        <div
            class="h-[600px] w-[900px] rounded-full opacity-20 blur-[120px]"
            style="background: radial-gradient(ellipse, #7c6aff 0%, #3b82f6 40%, transparent 70%);"
        ></div>
    </div>
    <main class="relative z-10 flex flex-1 flex-col items-center justify-center px-6 py-24 text-center">

        <!-- Badge -->
        <div class="animate-fade-up mb-10 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 backdrop-blur-sm whitespace-nowrap">
            <span class="h-1.5 w-1.5 rounded-full bg-blue-400 shrink-0" style="box-shadow: 0 0 6px 2px rgba(59,130,246,0.6);"></span>
            <span class="text-[11px] font-medium tracking-widest text-white/50 uppercase">Impulsado por Inteligencia Artificial</span>
        </div>

        <!-- Headline -->
        <h1 class="animate-fade-up opacity-0 animation-delay-200 mx-auto uppercase max-w-4xl text-4xl lg:text-6xl font-bold leading-[1.05] tracking-[-0.03em] text-white">
            cumplimiento normativo<br />
            <span class="bg-clip-text text-transparent bg-linear-to-r from-white to-blue-500">
                035 y STPS
            </span>
        </h1>

        <!-- Subtitle -->
        <p class="animate-fade-up opacity-0 animation-delay-400 mx-auto mt-8 max-w-lg text-[15px] leading-[1.75] text-white/40">
           Automatiza el cumplimiento normativo mexicano con IA. Cuestionarios inteligentes y alertas automaticas.
        </p>

        <!-- CTAs -->
        <div class="animate-fade-up opacity-0 animation-delay-600 mt-12 flex flex-col items-center gap-3 sm:flex-row">
            <a href="{{ route('register') }}" wire:navigate class="group bg-linear-to-r from-blue-400 to-blue-600 relative inline-flex lg:min-w-[220px] h-12 w-full items-center justify-center overflow-hidden rounded-none px-8 text-sm font-medium text-white transition-all duration-300">
                <span class="relative z-10 tracking-wide">Comenzar ahora →</span>
            </a>
            <a href="{{ route('login') }}" wire:navigate class="inline-flex h-12 w-full items-center justify-center rounded-none border border-white/10 bg-white/5 px-8 text-sm font-medium tracking-wide text-white/60 backdrop-blur-sm transition-all duration-200 hover:border-white/20 hover:bg-white/10 hover:text-white/90">
                Iniciar sesión
            </a>
        </div>

        <!-- Stats / features row -->
        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center gap-2 w-full">
                <div class="h-px w-4 bg-white/20 block" aria-hidden="true"></div>
                <div class="block text-xs font-medium tracking-[0.15em] text-white/25 uppercase whitespace-nowrap">{{ __('Alertas automaticas') }}</div>
            </div>
            <div class="flex items-center gap-2 w-full">
                <div class="h-px w-4 bg-white/20 block" aria-hidden="true"></div>
                <div class="block text-xs font-medium tracking-[0.15em] text-white/25 uppercase whitespace-nowrap">{{ __('Tickets anonimos') }}</div>
            </div>
            <div class="flex items-center gap-2 w-full">
                <div class="h-px w-4 bg-white/20 block" aria-hidden="true"></div>
                <div class="block text-xs font-medium tracking-[0.15em] text-white/25 uppercase whitespace-nowrap">{{ __('Analisis predictivo') }}</div>
            </div>
            <div class="flex items-center gap-2 w-full">
                <div class="h-px w-4 bg-white/20 block" aria-hidden="true"></div>
                <div class="block text-xs font-medium tracking-[0.15em] text-white/25 uppercase whitespace-nowrap">{{ __('Reportes avanzados') }}</div>
            </div>
        </div>
    </main>
</section>
