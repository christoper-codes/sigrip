<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('heroApp', () => ({
        selectedServices: [],
        services: ['Diagnóstico NOM-035', 'Riesgos psicosociales', 'Incidentes', 'Reportes STPS'],

        init() {
            this.$nextTick(() => {
                const video = this.$refs.bgVideo;
                if (!video) return;
                video.playbackRate = 0.7;
                video.play().catch(() => {});
            });
        },

        toggleService(service) {
            if (this.selectedServices.includes(service)) {
                this.selectedServices = this.selectedServices.filter(s => s !== service);
            } else {
                this.selectedServices.push(service);
            }
        }
    }));
});
</script>

<div
    x-data="heroApp"
    class="relative font-sans antialiased overflow-x-hidden flex flex-col lg:block lg:min-h-screen bg-white text-neutral-900 selection:bg-[#EAECE9] selection:text-[#1C2E1E]"
>

    {{-- Background Video Component --}}
    <div
        class="order-last lg:order-0 relative lg:absolute lg:inset-0 lg:z-0 overflow-hidden pointer-events-none w-full aspect-square md:aspect-video lg:aspect-auto lg:h-full lg:bg-transparent bg-neutral-50"
    >
        <video
            x-ref="bgVideo"
            src="{{ asset('videos/hero.mp4') }}"
            autoplay
            loop
            muted
            playsinline
            preload="auto"
            class="w-full h-full object-cover object-right lg:object-bottom-right"
        ></video>
    </div>

    <div
        class="hidden lg:block lg:absolute lg:inset-0 lg:z-5 pointer-events-none"
        style="background: linear-gradient(to right, #ffffff 0%, rgba(255,255,255,0.1) 45%, rgba(255,255,255,0) 70%)"
    ></div>

    {{-- Content Layout Container --}}
    <div class="lg:mt-20 lg:pt-0 relative z-10 flex flex-col order-first lg:order-0 w-full lg:bg-transparent pb-8 lg:pb-0 lg:min-h-screen pt-28">
        <main class="w-full max-w-7xl mx-auto px-6 sm:px-8 py-12 flex-1 flex flex-col justify-center">

            {{-- Badge --}}
            <div class="animate-blur-fade-up text-dark dark:text-dark font-light text-[0.7rem] tracking-[0.2em] uppercase mb-2">
                <span>Sistema NOM-035 · STPS México</span>
            </div>

            {{-- Headline --}}
            <h1 class="text-dark dark:text-dark text-5xl md:text-6xl lg:text-[76px] font-normal tracking-tight leading-[1.08] mb-8 w-full animate-blur-fade-up">
                Cumple.<br>Protege.<br>Automatiza.
            </h1>

            {{-- Secondary Description Text --}}
            <p class="text-dark dark:text-dark text-lg md:text-xl leading-relaxed font-light mb-14 max-w-2xl animate-blur-fade-up animation-delay-200">
                Automatiza el cumplimiento de la NOM-035, prevención de riesgos psicosociales,
                y gestión de incidentes — todo en una sola plataforma.
            </p>

            <div class="animate-blur-fade-up">
                <x-ui.btn-primary href="{{ route('register') }}" wire:navigate class="px-12 py-5">
                    Comenzar gratis
                </x-ui.btn-primary>
            </div>
        </main>
    </div>
</div>
