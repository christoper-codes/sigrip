{{-- ============================================================
     Rabbit Hole Reveal — SIGRIP · NOM-035
     Word split reveal + parallax cards
     ============================================================ --}}

{{-- 220vh scroll budget for the full reveal sequence --}}
<section id="rh-shell" class="relative">
    <div id="rh-sentinel" class="h-[220vh] pointer-events-none" aria-hidden="true"></div>
</section>

{{-- Fixed reveal word (must be white in dark, black in light) --}}
<div
    id="rh-header"
    aria-hidden="true"
    style="
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 45;
        overflow: hidden;
        will-change: clip-path;
    "
>
    <div
        id="rh-top"
        style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            clip-path: inset(0 0 calc(50% - 0.5px) 0);
            will-change: transform;
        "
    >
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:100%; text-align:center; white-space:nowrap; line-height:1;">
            <span style="font-size: clamp(2.7rem, 13vw, 15rem); font-weight: 900; letter-spacing: -0.05em; display: block;">RABBIT HOLE</span>
        </div>
    </div>

    <div
        id="rh-bot"
        style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            clip-path: inset(calc(50% - 0.5px) 0 0 0);
            will-change: transform;
        "
    >
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:100%; text-align:center; white-space:nowrap; line-height:1;">
            <span style="font-size: clamp(2.7rem, 13vw, 15rem); font-weight: 900; letter-spacing: -0.05em; display: block;">RABBIT HOLE</span>
        </div>
    </div>
</div>

{{-- Fixed narrative content + floating SIGRIP cards --}}
<section
    id="rh-content"
    class="pointer-events-none"
    style="
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 44;
        overflow: hidden;
        opacity: 0;
    "
>
    <div
        id="rh-inner"
        class="w-full h-full flex items-center justify-center px-6"
        style="transform: translateY(52%); will-change: transform;"
    >
        <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

            <div class="relative h-[26rem] sm:h-[30rem] lg:h-[34rem]">
                <div id="rh-float-1" class="absolute top-3 left-4 sm:left-8 rounded-2xl border p-4 shadow-2xl backdrop-blur-md w-56 sm:w-64">
                    <p class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Deteccion temprana</p>
                    <p class="mt-2 text-sm leading-relaxed">Identifica factores de riesgo psicosocial por area y puesto en tiempo real.</p>
                </div>

                <div id="rh-float-2" class="absolute top-32 right-3 sm:right-10 rounded-2xl border p-4 shadow-2xl backdrop-blur-md w-52 sm:w-60">
                    <p class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Radar IA</p>
                    <p class="mt-2 text-sm leading-relaxed">Alertas accionables para priorizar intervenciones antes de que escalen.</p>
                </div>

                <div id="rh-float-3" class="absolute bottom-10 left-1/2 -translate-x-1/2 rounded-2xl border p-5 shadow-2xl backdrop-blur-md w-[17rem] sm:w-[20rem]">
                    <p class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Cumplimiento STPS</p>
                    <div class="mt-2 flex items-end gap-2">
                        <span class="text-4xl font-black leading-none">94</span>
                        <span class="text-sm opacity-70">/100 score NOM-035</span>
                    </div>
                </div>

                <div id="rh-float-4" class="absolute -bottom-2 right-0 rounded-2xl border p-3 shadow-2xl backdrop-blur-md w-44 sm:w-52">
                    <p class="text-[10px] font-bold tracking-[0.2em] uppercase opacity-70">Incidentes</p>
                    <p class="mt-1 text-sm">Seguimiento integral 24 / 7</p>
                </div>
            </div>

            <div class="text-left max-w-xl">
                <p class="text-[10px] font-bold tracking-[0.25em] uppercase opacity-60 mb-5">SIGRIP · NOM-035</p>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[0.94] mb-6">
                    No esperes a caer en el riesgo.
                </h2>
                <p class="text-base sm:text-lg leading-relaxed opacity-75 mb-8">
                    Rabbit Hole representa lo que no se ve a tiempo: estres, violencia laboral y desgaste emocional. SIGRIP convierte esa zona ciega en decisiones medibles para proteger a tu equipo y cumplir con la STPS.
                </p>
                <a
                    href="{{ route('register') }}"
                    wire:navigate
                    class="pointer-events-auto inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold transition-all duration-200 hover:scale-[1.02] active:scale-95"
                    id="rh-cta"
                >
                    Comenzar gratis
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var sentinel = document.getElementById('rh-sentinel');
        var header = document.getElementById('rh-header');
        var top = document.getElementById('rh-top');
        var bot = document.getElementById('rh-bot');
        var content = document.getElementById('rh-content');
        var inner = document.getElementById('rh-inner');
        var cta = document.getElementById('rh-cta');
        var f1 = document.getElementById('rh-float-1');
        var f2 = document.getElementById('rh-float-2');
        var f3 = document.getElementById('rh-float-3');
        var f4 = document.getElementById('rh-float-4');

        if (!sentinel || !header || !top || !bot || !content || !inner) {
            return;
        }

        var ticking = false;

        function clamp(value, min, max) {
            return value < min ? min : value > max ? max : value;
        }

        function lerp(start, end, amount) {
            return start + (end - start) * amount;
        }

        function ease(amount) {
            amount = clamp(amount, 0, 1);
            return amount < 0.5
                ? 4 * amount * amount * amount
                : 1 - Math.pow(-2 * amount + 2, 3) / 2;
        }

        function applyTheme() {
            var dark = localStorage.getItem('flux.appearance') === 'dark';
            var headerBg = dark ? '#050505' : '#f8fafc';
            var headerText = dark ? '#ffffff' : '#0a0a0a';
            var contentBg = dark
                ? 'radial-gradient(circle at 20% 20%, #121212 0%, #050505 55%, #050505 100%)'
                : 'radial-gradient(circle at 20% 20%, #ffffff 0%, #f4f6f8 55%, #eef2f7 100%)';
            var cardBg = dark ? 'rgba(255,255,255,0.06)' : 'rgba(255,255,255,0.75)';
            var cardBorder = dark ? 'rgba(255,255,255,0.12)' : 'rgba(10,10,10,0.12)';

            header.style.background = headerBg;
            header.style.color = headerText;
            content.style.background = contentBg;
            content.style.color = headerText;

            [f1, f2, f3, f4].forEach(function (el) {
                if (!el) {
                    return;
                }
                el.style.background = cardBg;
                el.style.borderColor = cardBorder;
            });

            if (cta) {
                cta.style.background = dark ? '#ffffff' : '#0a0a0a';
                cta.style.color = dark ? '#0a0a0a' : '#ffffff';
            }
        }

        function reset() {
            header.style.display = 'none';
            content.style.display = 'none';
            content.style.opacity = '0';
            header.style.clipPath = '';
            top.style.transform = '';
            bot.style.transform = '';
            inner.style.transform = 'translateY(52%)';
            if (f1) f1.style.transform = 'translate3d(0,0,0)';
            if (f2) f2.style.transform = 'translate3d(0,0,0)';
            if (f3) f3.style.transform = 'translate3d(0,0,0)';
            if (f4) f4.style.transform = 'translate3d(0,0,0)';
        }

        function tick() {
            applyTheme();

            var rect = sentinel.getBoundingClientRect();
            var total = sentinel.offsetHeight - window.innerHeight;

            if (total <= 0) {
                ticking = false;
                return;
            }

            var active = rect.top <= 0 && rect.bottom >= window.innerHeight;

            if (!active) {
                reset();
                ticking = false;
                return;
            }

            header.style.display = 'block';
            content.style.display = 'block';

            var progress = clamp(-rect.top / total, 0, 1);
            var eased = ease(progress);
            var topEdge = lerp(50, 0, eased).toFixed(3);
            var bottomEdge = lerp(50, 100, eased).toFixed(3);

            header.style.clipPath =
                'polygon(0 0, 100% 0, 100% ' + topEdge + '%, 0 ' + topEdge + '%, 0 ' +
                bottomEdge + '%, 100% ' + bottomEdge + '%, 100% 100%, 0 100%)';

            top.style.transform = 'translateY(' + lerp(0, -32, eased).toFixed(3) + '%)';
            bot.style.transform = 'translateY(' + lerp(0, 32, eased).toFixed(3) + '%)';
            inner.style.transform = 'translateY(' + lerp(52, 0, eased).toFixed(3) + '%)';
            content.style.opacity = Math.min(1, eased * 2.2).toFixed(3);

            if (f1) f1.style.transform = 'translate3d(0,' + lerp(0, -140, eased).toFixed(2) + 'px,0)';
            if (f2) f2.style.transform = 'translate3d(0,' + lerp(0, -210, eased).toFixed(2) + 'px,0)';
            if (f3) f3.style.transform = 'translate3d(0,' + lerp(0, -90, eased).toFixed(2) + 'px,0)';
            if (f4) f4.style.transform = 'translate3d(0,' + lerp(0, -260, eased).toFixed(2) + 'px,0)';

            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                ticking = true;
                requestAnimationFrame(tick);
            }
        }, { passive: true });

        window.addEventListener('resize', function () {
            if (!ticking) {
                ticking = true;
                requestAnimationFrame(tick);
            }
        }, { passive: true });

        document.addEventListener('click', function (event) {
            var target = event.target;
            if (target && target.closest('[aria-label="Cambiar tema"]')) {
                requestAnimationFrame(applyTheme);
            }
        });

        tick();
    });
})();
</script>
