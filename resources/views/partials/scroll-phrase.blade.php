{{-- ============================================================
     Scroll Phrase — Apple-style pinned zoom-out
     ============================================================
     Uses position:fixed (not sticky) so it works even when an
     ancestor has overflow:hidden.

     400 vh scroll budget on the sentinel div.

     Fase 0 (sentinel enters viewport top):  panel appears, scale(3)
     Fase 1 (0 → 40 %):   scale 3 → 1  (zoom-out)
     Fase 2 (40 → 68 %):  info fades + rises in
     Fase 3 (68 → 100 %): dwell — user reads
     Panel disappears the moment sentinel bottom leaves viewport top.
     ============================================================ --}}

{{-- Sentinel: 400vh block that owns the scroll budget --}}
<div id="sp-sentinel" style="position: relative; height: 400vh; pointer-events: none;"></div>

{{-- Fixed full-viewport panel (hidden by default, shown via JS) --}}
<div
    id="sp-panel"
    class="sp-ocean"
    style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100vh;
        z-index: 40;
        display: none;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    "
    aria-hidden="true"
>
    {{-- Grain overlay --}}
    <div
        style="
            pointer-events: none;
            position: absolute; inset: 0;
            opacity: 0.04;
            background-image: url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E\");
            background-size: 200px 200px;
        "
    ></div>

    <div style="position: relative; width: 100%; max-width: 64rem; padding: 0 1.5rem; text-align: center;">

        {{-- ── Main phrase: always visible, starts at scale(3) ── --}}
        <div
            id="sp-phrase"
            style="will-change: transform; transform: scale(3); transform-origin: center center;"
        >
            <p
                class="font-semibold leading-[1.08] tracking-tight text-white"
                style="font-size: clamp(2.8rem, 6.5vw, 5.8rem); text-shadow: 0 2px 40px rgba(0,0,0,0.18);"
            >
                Cumple la NOM-035.<br>
                <span style="color: rgba(255,255,255,0.65);">Cuida a tu equipo.</span>
            </p>
        </div>

        {{-- ── Info: fade + rise after zoom ── --}}
        <div
            id="sp-info"
            style="opacity: 0; transform: translateY(32px); will-change: opacity, transform; margin-top: 2.5rem;"
        >
            <p
                style="color: rgba(255,255,255,0.80); font-size: clamp(1rem, 1.8vw, 1.2rem); max-width: 42rem; margin: 0 auto; line-height: 1.7;"
            >
                Una plataforma diseñada para automatizar el cumplimiento de la
                Norma Oficial Mexicana 035, prevención de riesgos psicosociales
                y gestión de incidentes laborales en tu organización.
            </p>

            {{-- Stats --}}
            <div style="margin-top: 2.5rem; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 2.5rem;">
                @foreach ([
                    ['+15',    'Empresas activas'],
                    ['6',      'Cuestionarios'],
                    ['100 %',  'Cumplimiento'],
                    ['24 / 7', 'Monitoreo IA'],
                ] as [$num, $label])
                <div style="display: flex; flex-direction: column; align-items: center; gap: 0.375rem;">
                    <span
                        class="font-semibold tracking-tight text-white"
                        style="font-size: clamp(1.8rem, 3vw, 2.4rem);"
                    >{{ $num }}</span>
                    <span
                        style="font-size: 11px; font-weight: 500; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.55);"
                    >{{ $label }}</span>
                </div>
                @endforeach
            </div>

            {{-- CTAs --}}
            <div style="margin-top: 2.5rem; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 0.75rem;">
                <a
                    href="{{ route('register') }}"
                    wire:navigate
                    style="
                        display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
                        border-radius: 9999px; background: white;
                        padding: 0.875rem 1.75rem;
                        font-size: 15px; font-weight: 500; color: #0369a1;
                        transition: background 0.2s; text-decoration: none;
                        pointer-events: auto;
                    "
                    onmouseover="this.style.background='rgba(255,255,255,0.9)'"
                    onmouseout="this.style.background='white'"
                >
                    Comenzar gratis
                </a>
                <a
                    href="#howworks"
                    class="ios-glass-dark"
                    style="
                        display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
                        border-radius: 9999px; border: 1px solid rgba(255,255,255,0.18);
                        padding: 0.875rem 1.75rem;
                        font-size: 15px; font-weight: 500; color: white;
                        transition: border-color 0.2s; text-decoration: none;
                        pointer-events: auto;
                    "
                >
                    Conocer más
                </a>
            </div>
        </div>{{-- /sp-info --}}

    </div>
</div>{{-- /sp-panel --}}

<script>
(function () {
    'use strict';

    var sentinel = document.getElementById('sp-sentinel');
    var panel    = document.getElementById('sp-panel');
    var phrase   = document.getElementById('sp-phrase');
    var info     = document.getElementById('sp-info');
    if (!sentinel || !panel || !phrase || !info) return;

    var SCALE_START = 3;
    var PHASE1_END  = 0.40;
    var INFO_START  = 0.40;
    var INFO_FULL   = 0.68;

    function easeOut(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function clamp(v, lo, hi) {
        return v < lo ? lo : v > hi ? hi : v;
    }

    function tick() {
        var rect   = sentinel.getBoundingClientRect();
        var total  = sentinel.offsetHeight - window.innerHeight;
        if (total <= 0) return;

        /* Panel is visible while sentinel is actively scrolling through:
           top of sentinel has passed the top of viewport  (rect.top <= 0)
           AND bottom of sentinel hasn't left viewport top (rect.bottom >= window.innerHeight) */
        var active = rect.top <= 0 && rect.bottom >= window.innerHeight;

        if (active) {
            panel.style.display = 'flex';

            var scrolled = -rect.top;
            var progress = clamp(scrolled / total, 0, 1);

            /* Fase 1: zoom-out */
            if (progress <= PHASE1_END) {
                var p     = easeOut(progress / PHASE1_END);
                var scale = SCALE_START - p * (SCALE_START - 1);
                phrase.style.transform = 'scale(' + scale.toFixed(4) + ')';
                info.style.opacity     = '0';
                info.style.transform   = 'translateY(32px)';
            } else {
                /* Fase 2 / 3: info fades in */
                phrase.style.transform = 'scale(1)';
                var rawP  = (progress - INFO_START) / (INFO_FULL - INFO_START);
                var infoP = easeOut(clamp(rawP, 0, 1));
                info.style.opacity   = infoP.toFixed(4);
                info.style.transform = 'translateY(' + ((1 - infoP) * 32).toFixed(2) + 'px)';
            }
        } else {
            panel.style.display = 'none';
            /* Reset phrase for next entry */
            phrase.style.transform = 'scale(' + SCALE_START + ')';
            info.style.opacity     = '0';
            info.style.transform   = 'translateY(32px)';
        }
    }

    window.addEventListener('scroll', tick, { passive: true });
    window.addEventListener('resize', tick, { passive: true });
    tick();
})();
</script>
