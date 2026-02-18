<section id="hero">
    <x-main-container>
        <div data-aos="fade-zoom-in"
            data-aos-once="true"
            data-aos-duration="2000"
            class="min-h-screen pt-52 relative">
            <div class="absolute left-0 lg:-left-72  top-0 lg:-top-52 h-[380px] w-[200px] lg:h-[580px] lg:w-[400px] rounded-full blur-[120px] lg:blur-[150px] bg-primary/30"></div>
            <div class="text-center flex flex-col gap-6 items-center justify-center">
                <h1 data-aos="fade-up"
                    data-aos-once="true"
                    data-aos-duration="1000"
                    class="text-4xl md:text-5xl">
                    {{ __('Bienestar laboral y cumplimiento ') }} <br> <span class="uppercase mt-1 lg:mt-4 block tracking-[5px] [filter:drop-shadow(0px_0px_15px_rgb(255_193_7_/_100%))]">{{ __('NOM-035') }}</span>
                </h1>
                <div class="max-w-2xl opacity-70 leading-relaxed">
                    <p data-aos="fade-up"
                        data-aos-once="true"
                        data-aos-duration="1500">
                        {{ __('Automatiza el cumplimiento de la NOM-035 con IA que previene riesgos laborales, detecta problemas antes de que ocurran y protege tu empresa de demandas costosas. Cuestionarios inteligentes y alertas automáticas.') }}
                    </p>
                </div>
                <div data-aos="fade-up"
                        data-aos-once="true"
                        data-aos-duration="2000" class="z-20 relative">
                   <x-links.primary
                        url="{{ route('register') }}"
                        title="{{ __('Comenzar gratis') }}"
                        class="py-5! px-8!"
                    />
                </div>
            </div>
            <div class="mt-20 relative">
                <div class="absolute h-80 w-full -top-20 left-0">
                    <div class="particles-container">
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                        <div class="particle"><div class="circle"></div></div>
                    </div>
                </div>

                <div class="w-full relative [filter:drop-shadow(0px_0px_40px_rgb(255_193_7_/_100%))_drop-shadow(0px_0px_80px_rgb(255_193_7_/_70%))_drop-shadow(0px_0px_120px_rgb(255_193_7_/_90%))]">
                    <div class="w-full h-[2px] bg-gradient-to-r from-transparent via-dark/50 dark:via-light to-transparent [filter:drop-shadow(0px_0px_20px_rgb(255_255_255_/_100%))]"></div>
                </div>
                <div x-data="{ dark: document.documentElement.classList.contains('dark') }"
                        x-init="
                            const observer = new MutationObserver(() => {
                                dark = document.documentElement.classList.contains('dark')
                            })
                            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] })
                        "
                        class="w-full"
                    >
                    {{-- light hero image --}}
                    <img x-show="!dark" class="w-full rounded md:rounded-md shadow-2xl shadow-neutral-900/30 dark:shadow-white/10" src="/images/hero-light.png" alt="hero image">

                    {{-- dark hero image --}}
                    <img x-show="dark" class="w-full rounded md:rounded-md shadow-2xl shadow-neutral-900/30 dark:shadow-white/10" src="/images/hero-dark.png" alt="hero image">
                </div>
            </div>
        </div>
    </x-main-container>
</section>
