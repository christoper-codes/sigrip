{{-- ============================================================
     Hero — SIGRIP · NOM-035
     Typewriter headline + interactive scrub video
     Dark mode synced to flux.appearance in localStorage (store lives in partials.header)
     ============================================================ --}}

<script>
function sigripHero() {
    return {
        emailInput: '',
        fullText: 'Cumple.\nProtege.\nAutomatiza.',
        displayedText: '',
        isDone: false,

        init() {
            this.initTypewriter();
            this.$nextTick(() => this.initVideo());
        },

        initTypewriter() {
            let i = 0;
            const timer = setInterval(() => {
                if (i < this.fullText.length) {
                    this.displayedText = this.fullText.slice(0, i + 1);
                    i++;
                } else {
                    clearInterval(timer);
                    this.isDone = true;
                }
            }, 55);
        },

        initVideo() {
            const video = this.$refs.bgVideo;
            if (!video) return;

            let prevX = null;
            let targetTime = 0;
            let isSeeking = false;

            const handleMouseMove = (e) => {
                if (window.innerWidth < 1024 || !video.duration) return;

                if (prevX === null) {
                    prevX = e.clientX;
                    return;
                }

                const delta = e.clientX - prevX;
                prevX = e.clientX;

                const timeChange = (delta / window.innerWidth) * 0.8 * video.duration;
                targetTime = Math.max(0, Math.min(video.duration, video.currentTime + timeChange));

                if (!isSeeking) {
                    isSeeking = true;
                    video.currentTime = targetTime;
                }
            };

            const handleSeeked = () => { isSeeking = false; };

            const handleResize = () => {
                if (window.innerWidth < 1024) {
                    window.removeEventListener('mousemove', handleMouseMove);
                    video.autoplay = true;
                    video.play().catch(() => {});
                } else {
                    video.pause();
                    window.addEventListener('mousemove', handleMouseMove);
                }
            };

            handleResize();
            window.addEventListener('resize', handleResize);
            video.addEventListener('seeked', handleSeeked);
        },

        submitDemo() {
            if (!this.emailInput.trim()) return;
            window.location.href = '{{ route("register") }}?email=' + encodeURIComponent(this.emailInput);
        }
    };
}
</script>

<div
    x-data="sigripHero()"
    :class="$store.appearance.dark ? 'bg-[#050505] text-white' : 'bg-zinc-50 text-zinc-950'"
    class="transition-colors duration-300 overflow-x-hidden"
>

{{-- ── TICKER (full-width) ─────────────────────────────────────── --}}
<div
    :class="$store.appearance.dark ? 'bg-[#0d0d0d] border-white/6 text-zinc-400' : 'bg-zinc-100 border-zinc-200 text-zinc-600'"
    class="w-full border-b text-[10px] tracking-[0.15em] font-semibold py-2.5 overflow-hidden select-none"
>
    <div class="flex whitespace-nowrap animate-marquee">
        <div class="flex items-center gap-12 px-6">
            <span>+15 EMPRESAS CERTIFICADAS</span>
            <span class="text-zinc-500">•</span>
            <span>CUESTIONARIOS NOM-035 AUTOMATIZADOS</span>
            <span class="text-zinc-500">•</span>
            <span class="text-blue-500 font-bold">NUEVO: MÓDULO DE INCIDENTES LABORALES</span>
            <span class="text-zinc-500">•</span>
            <span>✓ CUMPLIMIENTO 100% STPS</span>
            <span class="text-zinc-500">•</span>
            <span>MONITOREO IA 24 / 7</span>
            <span class="text-zinc-500">•</span>
        </div>
        <div class="flex items-center gap-12 px-6" aria-hidden="true">
            <span>+15 EMPRESAS CERTIFICADAS</span>
            <span class="text-zinc-500">•</span>
            <span>CUESTIONARIOS NOM-035 AUTOMATIZADOS</span>
            <span class="text-zinc-500">•</span>
            <span class="text-blue-500 font-bold">NUEVO: MÓDULO DE INCIDENTES LABORALES</span>
            <span class="text-zinc-500">•</span>
            <span>✓ CUMPLIMIENTO 100% STPS</span>
            <span class="text-zinc-500">•</span>
            <span>MONITOREO IA 24 / 7</span>
            <span class="text-zinc-500">•</span>
        </div>
    </div>
</div>

{{-- ── BORDERED CONTAINER ──────────────────────────────────────── --}}
<div
    class="max-w-7xl mx-auto border-x"
    :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
>
    <section id="hero" class="grid grid-cols-1 lg:grid-cols-2">

        {{-- Left column — typewriter headline + CTA ───────────────── --}}
        <div
            class="border-b lg:border-b-0 lg:border-r p-8 sm:p-10 lg:p-16 flex flex-col justify-center min-h-160"
            :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
        >
            {{-- Badge --}}
            <div
                :class="$store.appearance.dark ? 'border-[#222] bg-[#0a0a0a]' : 'border-zinc-200 bg-zinc-100'"
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full border w-fit mb-8"
            >
                <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></div>
                <span :class="$store.appearance.dark ? 'text-gray-300' : 'text-zinc-700'" class="text-xs font-medium uppercase tracking-wider">
                    Sistema NOM-035 · STPS México
                </span>
            </div>

            {{-- Typewriter headline --}}
            <h1
                :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'"
                class="font-extrabold text-5xl lg:text-7xl tracking-tighter leading-[0.95] mb-8 whitespace-pre-wrap transition-colors duration-300"
            >
                <span x-text="displayedText"></span><span
                    x-show="!isDone"
                    :class="$store.appearance.dark ? 'bg-white' : 'bg-zinc-950'"
                    class="inline-block w-0.75 h-[0.9em] align-middle ml-0.5 animate-pulse"
                ></span>
            </h1>

            {{-- Subtext --}}
            <p
                :class="$store.appearance.dark ? 'text-zinc-400' : 'text-zinc-500'"
                class="text-base max-w-sm leading-relaxed mb-10 font-light transition-colors duration-300"
            >
                Automatiza el cumplimiento de la NOM-035, prevención de riesgos psicosociales
                y gestión de incidentes — todo en una sola plataforma.
            </p>

            {{-- CTA form --}}
            <form @submit.prevent="submitDemo()" class="flex flex-col sm:flex-row gap-3 w-full max-w-sm">
                <div class="grow relative">
                    <span
                        class="absolute left-3.5 top-1/2 -translate-y-1/2"
                        :class="$store.appearance.dark ? 'text-zinc-600' : 'text-zinc-400'"
                    >
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <input
                        type="email"
                        x-model="emailInput"
                        placeholder="correo@empresa.com"
                        :class="$store.appearance.dark
                            ? 'bg-[#0a0a0a] border-[#252525] text-white placeholder-zinc-600 focus:border-zinc-600'
                            : 'bg-white border-zinc-200 text-zinc-950 placeholder-zinc-400 focus:border-zinc-400'"
                        class="w-full border pl-9 pr-4 py-3 rounded-lg text-sm transition-all focus:outline-none"
                    />
                </div>
                <button
                    type="submit"
                    :class="$store.appearance.dark
                        ? 'bg-white text-black hover:bg-zinc-100'
                        : 'bg-zinc-950 text-white hover:bg-zinc-800'"
                    class="px-6 py-3 rounded-lg text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 whitespace-nowrap"
                >Demo gratis</button>
            </form>
        </div>

        {{-- Right column — interactive scrub video ────────────────── --}}
        <div
            class="p-8 lg:p-12 flex items-center justify-center overflow-hidden relative min-h-100 lg:min-h-0"
            :class="$store.appearance.dark ? 'bg-[#080808]' : 'bg-zinc-100'"
        >
            <div class="relative w-full h-full rounded-3xl overflow-hidden shadow-2xl border" :class="$store.appearance.dark ? 'border-[#222]' : 'border-zinc-200'">
                <video
                    x-ref="bgVideo"
                    src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260601_110537_3a579fa0-7bbc-4d94-9d25-0e816c7840f5.mp4"
                    muted
                    playsinline
                    preload="auto"
                    class="w-full h-full object-cover"
                ></video>
                <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-black/10 pointer-events-none"></div>

                {{-- Floating score badge --}}
                <div class="glass-panel absolute bottom-6 right-6 p-3.5 rounded-2xl flex items-center gap-3 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.6)] border border-white/10 z-20">
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
            </div>
        </div>

    </section>
</div>{{-- /bordered container --}}

</div>{{-- /x-data --}}
