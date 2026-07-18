{{-- GitHub-style contribution grid: cells ease up to lit then ease back down
     (no instant flashes), biased to ignite more often near the top so the
     whole strip reads as fading from top to bottom (reinforced by the
     mask-image below). --}}
<script>
function footerGrid() {
    return {
        init() {
            const canvas = this.$refs.grid;
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const cell = 12; // pitch between squares
            const size = 8; // square size (GitHub-style: mostly filled, thin gap)
            const radius = 2;
            let cells = [];
            let cols = 0;
            let rows = 0;
            let width = 0;
            let height = 0;

            const resize = () => {
                const dpr = window.devicePixelRatio || 1;
                const rect = canvas.getBoundingClientRect();
                width = rect.width;
                height = rect.height;
                canvas.width = width * dpr;
                canvas.height = height * dpr;
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

                cols = Math.ceil(width / cell);
                rows = Math.ceil(height / cell);
                cells = new Array(cols * rows).fill(null).map(() => ({ value: 0, target: 0, hold: 0 }));
            };

            const draw = () => {
                ctx.clearRect(0, 0, width, height);
                const color = document.documentElement.classList.contains('dark') ? '255,255,255' : '0,0,0';

                for (let y = 0; y < rows; y++) {
                    // Cells near the top ignite more often than cells near the
                    // bottom, so the animation itself fades top -> bottom.
                    const rowBias = 1 - (y / rows) * 0.85;
                    for (let x = 0; x < cols; x++) {
                        const c = cells[y * cols + x];

                        // Idle cell: small random chance to start easing up.
                        if (c.target === 0 && c.value < 0.02 && Math.random() < 0.0035 * rowBias) {
                            c.target = 1;
                            c.hold = 10 + Math.random() * 20;
                        }

                        if (c.target === 1) {
                            c.value += (1 - c.value) * 0.12;
                            if (c.value > 0.9) {
                                c.hold -= 1;
                                if (c.hold <= 0) c.target = 0;
                            }
                        } else if (c.value > 0.001) {
                            c.value += (0 - c.value) * 0.06;
                        } else {
                            continue;
                        }

                        ctx.fillStyle = `rgba(${color}, ${(c.value * 0.4).toFixed(3)})`;
                        ctx.beginPath();
                        ctx.roundRect(x * cell, y * cell, size, size, radius);
                        ctx.fill();
                    }
                }
                requestAnimationFrame(draw);
            };

            resize();
            window.addEventListener('resize', resize);
            requestAnimationFrame(draw);
        }
    };
}
</script>

<footer class="w-full">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 py-4 flex items-center justify-center mb-16">
        <div class="flex items-center gap-2 animate-blur-fade-up">
            <button
                x-data
                x-on:click="$flux.dark = !$flux.dark"
                class="liquid-glass-light w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                aria-label="Cambiar tema"
            >
                <svg x-show="$flux.dark" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg x-show="!$flux.dark" class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
            <span class="font-light text-sm tracking-[0.2em] uppercase select-none text-dark dark:text-light">
                Sigrip
            </span>
        </div>
    </div>

    <div class="w-full h-25 overflow-hidden" x-data="footerGrid()">
        <div class="h-full w-full" style="mask-image:linear-gradient(to bottom, black, transparent);-webkit-mask-image:linear-gradient(to bottom, black, transparent)">
            <canvas x-ref="grid" class="pointer-events-none block w-full h-full"></canvas>
        </div>
    </div>
</footer>
