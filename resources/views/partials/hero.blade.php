{{-- ============================================================
     Hero — SIGRIP · NOM-035
     Apple/iOS style: frosted glass badge & pills, solid black
     rounded-full CTAs, autoplaying looped background video.
     Dark mode synced to flux.appearance in localStorage (store lives in partials.header)
     ============================================================ --}}

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('heroApp', () => ({
        selectedServices: [],
        services: ['Diagnóstico NOM-035', 'Riesgos psicosociales', 'Incidentes', 'Reportes STPS'],

        init() {
            this.$nextTick(() => {
                const video = this.$refs.bgVideo;
                if (video) video.play().catch(() => {});
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
    class="relative font-sans antialiased overflow-x-hidden flex flex-col lg:block lg:min-h-screen transition-colors duration-300"
    :class="$store.appearance.dark ? 'bg-[#050505] text-white selection:bg-white/10 selection:text-white' : 'bg-white text-neutral-900 selection:bg-[#EAECE9] selection:text-[#1C2E1E]'"
>

    {{-- Background Video Component --}}
    <div
        class="order-last lg:order-0 relative lg:absolute lg:inset-0 lg:z-0 overflow-hidden pointer-events-none w-full aspect-square md:aspect-video lg:aspect-auto lg:h-full lg:bg-transparent"
        :class="$store.appearance.dark ? 'bg-[#0a0a0a]' : 'bg-neutral-50'"
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

    {{-- Scrim: keeps text readable over the video regardless of its own
         footage colors or the active theme. Plain CSS gradient (not Tailwind
         stop-position utilities) so the fade position is unambiguous. --}}
    <div
        class="hidden lg:block lg:absolute lg:inset-0 lg:z-5 pointer-events-none"
        :style="$store.appearance.dark
            ? 'background: linear-gradient(to right, #050505 0%, rgba(5,5,5,0.85) 45%, rgba(5,5,5,0) 70%)'
            : 'background: linear-gradient(to right, #ffffff 0%, rgba(255,255,255,0.85) 45%, rgba(255,255,255,0) 70%)'"
    ></div>

    {{-- Content Layout Container --}}
    <div
        class="relative z-10 flex flex-col order-first lg:order-0 w-full lg:bg-transparent pb-8 lg:pb-0 lg:min-h-screen pt-28 lg:pt-0 transition-colors duration-300"
        :class="$store.appearance.dark ? 'bg-[#050505]' : 'bg-white'"
    >
        <main class="w-full max-w-7xl mx-auto px-6 sm:px-8 py-12 flex-1 flex flex-col justify-center">

            {{-- Badge --}}
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border w-fit mb-8 animate-blur-fade-up"
                :class="$store.appearance.dark ? 'ios-glass-dark border-white/10' : 'ios-glass border-black/6'"
            >
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span
                    class="text-xs font-medium uppercase tracking-wider"
                    :class="$store.appearance.dark ? 'text-zinc-200' : 'text-zinc-700'"
                >Sistema NOM-035 · STPS México</span>
            </div>

            {{-- Headline --}}
            <h1
                class="text-5xl md:text-6xl lg:text-[76px] font-normal tracking-tight leading-[1.08] mb-8 w-full animate-blur-fade-up"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >
                Cumple.<br>Protege.<br>Automatiza.
            </h1>

            {{-- Secondary Description Text --}}
            <p
                class="text-lg md:text-xl leading-relaxed font-normal mb-14 max-w-2xl animate-blur-fade-up animation-delay-200"
                :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#5A635A]'"
            >
                Automatiza el cumplimiento de la NOM-035, prevención de riesgos psicosociales, <br class="hidden sm:block" />
                y gestión de incidentes — todo en una sola plataforma.
            </p>

            {{-- Interactive Multi-Select Service Pills --}}
            <div class="animate-blur-fade-up animation-delay-400">
                <h2
                    class="text-2xl font-medium tracking-tight mb-2"
                    :class="$store.appearance.dark ? 'text-white' : 'text-black'"
                >¿Qué te gustaría automatizar?</h2>
                <p
                    class="opacity-85 mb-8"
                    :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#738273]'"
                >Selecciona todo lo que aplique</p>

                <div class="flex flex-wrap gap-3 mb-8">
                    <template x-for="service in services" :key="service">
                        <button
                            @click="toggleService(service)"
                            class="flex items-center gap-2 px-6 py-3 rounded-full text-base font-medium border transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                            :class="selectedServices.includes(service)
                                ? 'bg-[#1d1d1f] text-white border-transparent shadow-lg shadow-black/10'
                                : ($store.appearance.dark
                                    ? 'ios-glass-dark text-white border-white/10 hover:bg-white/10'
                                    : 'ios-glass text-black border-black/8 hover:bg-white')
                            "
                        >
                            <span x-text="service"></span>

                            {{-- Check icon with smooth width/opacity transition --}}
                            <div
                                x-show="selectedServices.includes(service)"
                                x-transition:enter="transition-all ease-out duration-300"
                                x-transition:enter-start="opacity-0 w-0 scale-50"
                                x-transition:enter-end="opacity-100 w-5 scale-100"
                                x-transition:leave="transition-all ease-in duration-200"
                                x-transition:leave-start="opacity-100 w-5 scale-100"
                                x-transition:leave-end="opacity-0 w-0 scale-50"
                                class="flex items-center justify-center overflow-hidden origin-left"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                        </button>
                    </template>
                </div>

                {{-- Contingent Feedback Status Banner --}}
                <div class="min-h-15 relative">
                    {{-- Empty State --}}
                    <div
                        x-show="selectedServices.length === 0"
                        x-transition:enter="transition ease-out duration-300 delay-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-50"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-50"
                        x-transition:leave-end="opacity-0"
                        class="italic text-xs absolute top-0"
                        :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#5A635A]'"
                    >
                        Da clic para seleccionar los módulos que te interesan.
                    </div>

                    {{-- Active State --}}
                    <div
                        x-show="selectedServices.length > 0"
                        x-cloak
                        x-transition:enter="transition-all ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2 max-h-0"
                        x-transition:enter-end="opacity-100 translate-y-0 max-h-40"
                        x-transition:leave="transition-all ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 max-h-40"
                        x-transition:leave-end="opacity-0 -translate-y-2 max-h-0"
                        class="overflow-hidden"
                    >
                        <div
                            class="flex items-center justify-between gap-4 p-4 border rounded-2xl max-w-xl mt-2"
                            :class="$store.appearance.dark ? 'ios-glass-dark border-white/10' : 'ios-glass border-black/8'"
                        >
                            <span class="text-sm font-medium truncate" :class="$store.appearance.dark ? 'text-white' : 'text-[#1C2E1E]'">
                                Listo para conocer más sobre: <span class="font-normal" :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#5A635A]'" x-text="selectedServices.join(', ')"></span>
                            </span>
                            <x-ui.btn-primary href="{{ route('register') }}" wire:navigate class="px-5! py-2.5! text-[13px]! shrink-0">
                                Comenzar
                            </x-ui.btn-primary>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
