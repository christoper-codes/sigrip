{{-- Animated grid: small squares softly twinkling, faded top-to-bottom. --}}
<script>
function footerGrid() {
    return {
        init() {
            const canvas = this.$refs.grid;
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const cell = 16;
            const size = 3;
            let squares = [];
            let width = 0;
            let height = 0;

            const resize = () => {
                const dpr = window.devicePixelRatio || 1;
                const rect = canvas.parentElement.getBoundingClientRect();
                width = rect.width;
                height = rect.height;
                canvas.width = width * dpr;
                canvas.height = height * dpr;
                canvas.style.width = width + 'px';
                canvas.style.height = height + 'px';
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

                const cols = Math.ceil(width / cell);
                const rows = Math.ceil(height / cell);
                squares = [];
                for (let y = 0; y < rows; y++) {
                    for (let x = 0; x < cols; x++) {
                        squares.push({
                            x: x * cell,
                            y: y * cell,
                            phase: Math.random() * Math.PI * 2,
                            speed: 0.5 + Math.random() * 0.9,
                        });
                    }
                }
            };

            const draw = (time) => {
                ctx.clearRect(0, 0, width, height);
                const color = document.documentElement.classList.contains('dark') ? '255,255,255' : '0,0,0';
                for (const s of squares) {
                    const opacity = (Math.sin((time / 1000) * s.speed + s.phase) + 1) / 2;
                    ctx.fillStyle = `rgba(${color}, ${(opacity * 0.25).toFixed(3)})`;
                    ctx.fillRect(s.x, s.y, size, size);
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

<footer class="max-w-7xl relative mx-auto px-6 sm:px-8 py-4 flex items-center justify-between" x-data="footerGrid()">
    <div class="absolute inset-0 top-0 left-0 right-0 h-25 overflow-hidden z-0">
        <div class="h-full w-full" style="mask-image:linear-gradient(to bottom, black, transparent);-webkit-mask-image:linear-gradient(to bottom, black, transparent)">
            <canvas x-ref="grid" class="pointer-events-none"></canvas>
        </div>
    </div>

    <div class="relative z-10 flex items-center gap-2 animate-blur-fade-up">
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
</footer>
