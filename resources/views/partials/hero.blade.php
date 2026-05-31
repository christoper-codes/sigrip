{{-- ============================================================
     Hero — SIGRIP · NOM-035
     Dark mode synced to flux.appearance in localStorage
     ============================================================ --}}

{{-- Alpine store: shared appearance state (read by all partials) --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('appearance', {
        dark: localStorage.getItem('flux.appearance') === 'dark',
        toggle() {
            this.dark = !this.dark;
            localStorage.setItem('flux.appearance', this.dark ? 'dark' : 'light');
        }
    });
});

/* ── Phone card: scroll-driven transition from hero right → features left ──
   Position is captured at the MOMENT scrolling begins (not on load),
   so the flying card always starts from exactly where the hero card is.   */
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        var heroFade    = document.getElementById('hero-card-fade');  /* card + badge wrapper */
        var heroCard    = document.getElementById('phone-card-scroll'); /* position reference */
        var flyingCard  = document.getElementById('flying-card');
        var heroSection = document.getElementById('hero');
        var featLanding = document.getElementById('features-landing');

        if (!heroFade || !heroCard || !flyingCard || !heroSection || !featLanding) return;

        var snapPos = null;   /* captured at the very first scroll tick */
        var ticking = false;

        function clamp(v, lo, hi) { return v < lo ? lo : v > hi ? hi : v; }
        function lerp(a, b, t)    { return a + (b - a) * t; }
        function easeInOut(t)     { return t < 0.5 ? 2*t*t : -1+(4-2*t)*t; }

        function tick() {
            var desktop  = window.innerWidth >= 1024;
            var heroRect = heroSection.getBoundingClientRect();
            var scrolled = -heroRect.top;

            /* ── Phase 0: at top (or mobile) ── */
            if (scrolled <= 0 || !desktop) {
                snapPos = null;                          /* reset so next scroll re-captures */
                heroFade.style.opacity   = '';
                flyingCard.style.display = 'none';
                featLanding.style.opacity = desktop ? '0' : '1';
                ticking = false;
                return;
            }

            /* Capture hero card rect at the FIRST tick after scroll starts */
            if (!snapPos) {
                var r = heroCard.getBoundingClientRect();
                snapPos = { left: r.left, top: r.top, width: r.width, height: r.height };
            }

            var progress = clamp(scrolled / heroRect.height, 0, 1);

            /* ── Phase 2: hero off-screen → landed ── */
            if (progress >= 1) {
                heroFade.style.opacity   = '0';
                flyingCard.style.display = 'none';
                featLanding.style.opacity = '1';
                ticking = false;
                return;
            }

            /* ── Phase 1: in-flight ── */
            var p   = easeInOut(progress);
            var lr  = featLanding.getBoundingClientRect();
            var cx  = lerp(snapPos.left,   lr.left,   p);
            var cy  = lerp(snapPos.top,    lr.top,    p);
            var cw  = lerp(snapPos.width,  lr.width,  p);
            var ch  = lerp(snapPos.height, lr.height, p);
            var rot = Math.sin(p * Math.PI) * (-10);  /* arc −10deg at mid */

            /* Fade hero content out in the first 40% of scroll */
            heroFade.style.opacity    = Math.max(0, 1 - progress / 0.40).toFixed(3);
            featLanding.style.opacity = '0';

            flyingCard.style.display   = 'block';
            flyingCard.style.left      = cx.toFixed(1) + 'px';
            flyingCard.style.top       = cy.toFixed(1) + 'px';
            flyingCard.style.width     = cw.toFixed(1) + 'px';
            flyingCard.style.height    = ch.toFixed(1) + 'px';
            flyingCard.style.transform = 'rotate(' + rot.toFixed(2) + 'deg)';
            flyingCard.style.opacity   = '1';

            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) { ticking = true; requestAnimationFrame(tick); }
        }, { passive: true });
        window.addEventListener('resize', function() {
            snapPos = null;
            if (!ticking) { ticking = true; requestAnimationFrame(tick); }
        }, { passive: true });

        tick(); /* set initial state */
    });
})();

function sigripHero() {
    return {
        mobileMenuOpen: false,
        emailInput: '',
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

{{-- ── 1. TICKER (full-width) ──────────────────────────────────── --}}
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

{{-- ── 2. BORDERED CONTAINER ───────────────────────────────────── --}}
<div
    class="max-w-7xl mx-auto border-x"
    :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
>

    {{-- ── Navbar (minimal · Apple) ──────────────────────────── --}}
    <header
        class="px-6 lg:px-12 py-4 flex items-center justify-between border-b relative z-40"
        :class="$store.appearance.dark ? 'border-zinc-800' : 'border-zinc-200'"
        aria-label="Navegación"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-2.5 select-none">
            <svg viewBox="0 0 32 32" fill="none" class="w-7 h-7 shrink-0">
                <path d="M16 3L5 7.5V15c0 5.8 4.6 10.8 11 12.5C22.4 25.8 27 20.8 27 15V7.5L16 3Z" fill="url(#sh-hero)"/>
                <path d="M16 5.5L7 9.4V15c0 4.6 3.6 8.5 9 10.2 5.4-1.7 9-5.6 9-10.2V9.4L16 5.5Z" fill="white" fill-opacity="0.12"/>
                <path d="M11.5 15.8l3 3 6.5-6.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <defs>
                    <linearGradient id="sh-hero" x1="16" y1="3" x2="16" y2="27.5" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0ea5e9"/><stop offset="1" stop-color="#2563eb"/>
                    </linearGradient>
                </defs>
            </svg>
            <span :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'" class="font-extrabold tracking-widest text-sm uppercase">SIGRIP</span>
        </div>

        {{-- Right actions --}}
        <div class="flex items-center gap-2 sm:gap-3">
            {{-- Theme toggle --}}
            <button
                @click="$store.appearance.toggle()"
                :class="$store.appearance.dark
                    ? 'border-white/10 text-zinc-400 hover:text-white hover:border-white/20'
                    : 'border-zinc-200 text-zinc-400 hover:text-zinc-700 hover:border-zinc-300'"
                class="w-8 h-8 rounded-full border flex items-center justify-center transition-all duration-200"
                aria-label="Cambiar tema"
            >
                <svg x-show="$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg x-show="!$store.appearance.dark" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            {{-- Iniciar sesión --}}
            <a
                href="{{ route('login') }}" wire:navigate
                :class="$store.appearance.dark ? 'text-zinc-400 hover:text-white' : 'text-zinc-500 hover:text-zinc-900'"
                class="hidden sm:block text-sm font-medium transition-colors duration-200 px-1"
            >Iniciar sesión</a>

            {{-- Comenzar gratis --}}
            <a
                href="{{ route('register') }}" wire:navigate
                :class="$store.appearance.dark
                    ? 'bg-white text-black hover:bg-zinc-100'
                    : 'bg-zinc-950 text-white hover:bg-zinc-800'"
                class="px-4 py-2 rounded-lg text-xs font-bold tracking-wide transition-all duration-200 active:scale-95"
            >Comenzar gratis</a>

            {{-- Mobile: login link --}}
            <a
                href="{{ route('login') }}" wire:navigate
                :class="$store.appearance.dark ? 'text-zinc-400 hover:text-white' : 'text-zinc-500 hover:text-zinc-900'"
                class="sm:hidden text-sm font-medium transition-colors"
            >Entrar</a>
        </div>
    </header>

    {{-- ── HERO GRID ────────────────────────────────────────────── --}}
    <section id="hero" class="grid grid-cols-1 lg:grid-cols-2">

        {{-- Left column ─────────────────────────────────────────── --}}
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

            {{-- Headline --}}
            <h1
                :class="$store.appearance.dark ? 'text-white' : 'text-zinc-950'"
                class="font-extrabold text-6xl lg:text-8xl tracking-tighter leading-[0.9] mb-8 transition-colors duration-300"
            >
                <div class="overflow-hidden"><span class="block">Cumple.</span></div>
                <div class="overflow-hidden">
                    <span :class="$store.appearance.dark ? 'text-zinc-600' : 'text-zinc-400'" class="block transition-colors duration-300">Protege.</span>
                </div>
                <div class="overflow-hidden"><span class="block">Automatiza.</span></div>
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

        {{-- Right column — phone card ───────────────────────────── --}}
        <div
            class="p-8 lg:p-12 flex items-center justify-center overflow-hidden relative group"
            :class="$store.appearance.dark ? 'bg-[#080808]' : 'bg-zinc-100'"
        >
            {{-- Ambient blur (matches image palette) --}}
            <div
                class="absolute inset-0 bg-cover bg-center opacity-10 blur-3xl scale-125 animate-pulse"
                style="background-image: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/a37bed4a-3482-4d77-8630-f16831c0d7a9_1600w.webp'); animation-duration: 4s;"
                aria-hidden="true"
            ></div>

            {{-- Fade group: card + badge fade out together as flying card takes over --}}
            <div id="hero-card-fade">

            {{-- Phone card (position reference for JS) --}}
            <div id="phone-card-scroll" class="relative w-64 aspect-9/16 rounded-4xl overflow-hidden shadow-2xl border border-[#222] cursor-pointer ring-1 ring-white/5">
                <img
                    src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/16391788-f7da-4cd2-88de-e0421c307b8f_800w.webp"
                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                    alt="SIGRIP NOM-035"
                />
                <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-black/20"></div>

                <div class="absolute inset-0 p-5 flex flex-col justify-between z-10">
                    {{-- Top bar --}}
                    <div class="flex justify-between items-start">
                        <div class="glass-panel px-3 py-1 rounded-full text-[11px] font-medium flex items-center gap-2 text-white">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></div>
                            EN VIVO
                        </div>
                        <div class="glass-panel w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/10 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Tracking box (hover) --}}
                    <div class="absolute top-[30%] left-1/2 -translate-x-1/2 w-36 h-36 border border-white/40 rounded-2xl flex items-end justify-center pb-2 opacity-0 group-hover:opacity-100 transition-all duration-500 scale-90 group-hover:scale-100 pointer-events-none">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-white -mt-0.5 -ml-0.5"></div>
                        <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-white -mt-0.5 -mr-0.5"></div>
                        <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-white -mb-0.5 -ml-0.5"></div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-white -mb-0.5 -mr-0.5"></div>
                        <div class="glass-panel px-2 py-1 rounded text-[9px] text-white font-mono uppercase tracking-widest">Análisis IA</div>
                    </div>

                    {{-- Caption --}}
                    <div class="glass-panel p-4 rounded-2xl border border-white/5 shadow-lg transform group-hover:-translate-y-2 transition-transform duration-500">
                        <p class="text-base font-bold text-yellow-400 text-center leading-tight">
                            "El bienestar es tu ventaja competitiva."
                        </p>
                    </div>
                </div>
            </div>{{-- /phone-card-scroll --}}

            {{-- Floating score badge --}}
            <div class="glass-panel absolute bottom-10 right-10 p-3.5 rounded-2xl flex items-center gap-3 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.6)] border border-white/10 z-20 hover:scale-105 transition-transform duration-200">
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

            </div>{{-- /hero-card-fade --}}
        </div>

    </section>
</div>{{-- /bordered container --}}

{{-- Mobile nav overlay --}}
<div
    x-show="mobileMenuOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    :class="$store.appearance.dark ? 'bg-[#050505]/98' : 'bg-zinc-50/98'"
    class="md:hidden fixed inset-0 z-50 backdrop-blur-xl pt-20 px-6"
    style="display: none;"
>
    <div class="flex flex-col gap-3 mt-4">
        <a href="{{ route('login') }}"    wire:navigate :class="$store.appearance.dark ? 'border-white/10 text-zinc-300' : 'border-zinc-200 text-zinc-700'" class="py-4 text-center border rounded-xl text-sm font-semibold" @click="mobileMenuOpen = false">Iniciar sesión</a>
        <a href="{{ route('register') }}" wire:navigate :class="$store.appearance.dark ? 'bg-white text-black' : 'bg-zinc-950 text-white'" class="py-4 text-center rounded-xl text-sm font-extrabold" @click="mobileMenuOpen = false">Comenzar gratis</a>
    </div>
</div>

</div>{{-- /x-data --}}

{{-- ── Flying card: position:fixed, JS-driven during scroll transition ── --}}
<div
    id="flying-card"
    aria-hidden="true"
    style="
        position: fixed;
        display: none;
        z-index: 60;
        pointer-events: none;
        will-change: transform, left, top, width, height;
        border-radius: 2rem;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.55);
        border: 1px solid #222;
    "
>
    <img
        src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/16391788-f7da-4cd2-88de-e0421c307b8f_800w.webp"
        style="width:100%; height:100%; object-fit:cover; display:block;"
        alt=""
    />
    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.8), transparent, rgba(0,0,0,0.2));"></div>
    <div style="position:absolute; bottom:1.25rem; left:1.25rem; right:1.25rem;">
        <div style="background:rgba(255,255,255,0.07); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); padding:1rem; border-radius:1rem; border:1px solid rgba(255,255,255,0.06);">
            <p style="color:#fbbf24; font-weight:700; text-align:center; font-size:0.9rem; line-height:1.35; margin:0;">
                "El bienestar es tu ventaja competitiva."
            </p>
        </div>
    </div>
</div>
