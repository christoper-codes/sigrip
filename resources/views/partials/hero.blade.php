{{-- ============================================================
     Hero — SIGRIP · NOM-035
     Exact structure/interactions from the Mainframe reference design:
     ping-pong (forward/reverse) autoplaying background video,
     typewriter headline, interactive multi-select pills + contingent
     feedback banner.
     Dark mode synced to flux.appearance in localStorage (store lives in partials.header)
     ============================================================ --}}

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('heroApp', () => ({
        selectedServices: [],
        services: ['Diagnóstico NOM-035', 'Riesgos psicosociales', 'Incidentes', 'Reportes STPS'],

        // Typewriter state
        fullText: "Cumple.\nProtege.\nAutomatiza.",
        displayedText: '',
        isDone: false,

        init() {
            this.initTypewriter();
            this.$nextTick(() => this.initVideo());
        },

        // Ping-pong loop: plays forward natively, then on 'ended' scrubs
        // back to the start manually (browsers don't support real reverse
        // playback), then resumes forward — no jump-cut at the loop point.
        //
        // Each backward step waits for the previous seek to actually finish
        // ('seeked') before requesting the next one. Driving currentTime off
        // a rAF/clock timer instead fires far more seeks per second than a
        // streamed video's decoder can keep up with, so it just freezes on
        // the last frame in real browsers even though the property itself
        // keeps updating.
        initVideo() {
            const video = this.$refs.bgVideo;
            if (!video) return;

            const STEP = 1 / 24; // seconds per backward frame
            let reversing = false;
            let watchdog = null;

            const stepBack = () => {
                clearTimeout(watchdog);

                if (video.currentTime <= STEP) {
                    reversing = false;
                    video.currentTime = 0;
                    video.play().catch(() => {});
                    return;
                }

                video.currentTime = Math.max(0, video.currentTime - STEP);
                // Safety net: if 'seeked' never fires (dropped event), keep going anyway.
                watchdog = setTimeout(stepBack, 300);
            };

            video.addEventListener('seeked', () => {
                if (reversing) stepBack();
            });

            video.addEventListener('ended', () => {
                reversing = true;
                stepBack();
            });

            video.play().catch(() => {});
        },

        initTypewriter() {
            let i = 0;
            setTimeout(() => {
                const timer = setInterval(() => {
                    if (i < this.fullText.length) {
                        this.displayedText = this.fullText.slice(0, i + 1);
                        i++;
                    } else {
                        clearInterval(timer);
                        this.isDone = true;
                    }
                }, 38);
            }, 600);
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
            src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260601_110537_3a579fa0-7bbc-4d94-9d25-0e816c7840f5.mp4"
            autoplay
            muted
            playsinline
            preload="auto"
            class="w-full h-full object-cover object-right lg:object-bottom-right"
        ></video>
    </div>

    {{-- Content Layout Container --}}
    <div
        class="relative z-10 flex flex-col order-first lg:order-0 w-full lg:bg-transparent pb-8 lg:pb-0 lg:min-h-screen pt-24 lg:pt-0 transition-colors duration-300"
        :class="$store.appearance.dark ? 'bg-[#050505]' : 'bg-white'"
    >
        <main class="w-full max-w-7xl mx-auto px-6 py-12 flex-1 flex flex-col justify-center">

            {{-- Typewriter Headline --}}
            <h1
                class="text-5xl md:text-6xl lg:text-[76px] font-normal tracking-tight leading-[1.08] mb-8 select-none w-full whitespace-pre-wrap fade-in-start animate-fade-in-up"
                :class="$store.appearance.dark ? 'text-white' : 'text-black'"
            >
                <span x-text="displayedText"></span><span
                    x-show="!isDone"
                    class="inline-block w-0.5 h-[1.1em] align-middle ml-0.5 animate-blink"
                    :class="$store.appearance.dark ? 'bg-white' : 'bg-black'"
                ></span>
            </h1>

            {{-- Secondary Description Text --}}
            <p
                class="text-lg md:text-xl leading-relaxed font-normal mb-14 max-w-2xl fade-in-start animate-fade-in-up-delay-1"
                :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#5A635A]'"
            >
                Automatiza el cumplimiento de la NOM-035, prevención de riesgos psicosociales, <br class="hidden sm:block" />
                y gestión de incidentes — todo en una sola plataforma.
            </p>

            {{-- Interactive Multi-Select Service Pills --}}
            <div class="fade-in-start animate-fade-in-up-delay-2">
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
                            class="flex items-center gap-2 px-6 py-3 rounded-full text-base font-medium transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                            :class="selectedServices.includes(service)
                                ? ($store.appearance.dark
                                    ? 'bg-white text-black shadow-md transform'
                                    : 'bg-[#1C2E1E] text-white shadow-md shadow-emerald-950/5 transform')
                                : ($store.appearance.dark
                                    ? 'bg-[#0a0a0a] text-white border border-white/10 hover:bg-white/5'
                                    : 'bg-white text-[#1C2E1E] border border-[#F1F3F1] hover:bg-[#F1F3F1]/55')
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
                            class="flex items-center justify-between p-4 border rounded-2xl max-w-xl mt-2"
                            :class="$store.appearance.dark ? 'bg-white/5 border-white/10' : 'bg-[#FAFBF9] border-[#F1F3F1]'"
                        >
                            <span class="text-sm font-medium truncate pr-4" :class="$store.appearance.dark ? 'text-white' : 'text-[#1C2E1E]'">
                                Listo para conocer más sobre: <span class="font-normal" :class="$store.appearance.dark ? 'text-zinc-400' : 'text-[#5A635A]'" x-text="selectedServices.join(', ')"></span>
                            </span>
                            <a
                                href="{{ route('register') }}" wire:navigate
                                class="flex items-center gap-1.5 uppercase text-xs font-semibold tracking-wider hover:opacity-70 transition-opacity shrink-0"
                                :class="$store.appearance.dark ? 'text-blue-400' : 'text-[#4D6D47]'"
                            >
                                Comenzar
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
