<x-layouts.app :title="__('Dashboard')">
    <div class="h-full w-full">
        <div x-data="{
                greeting: '',
                currentDateTime: new Date().toLocaleString('es-MX', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' }),
                init() {
                    const hour = new Date().getHours();
                    if (hour >= 5 && hour < 12) {
                        this.greeting = '{{ __('Buenos días,') }}';
                    } else if (hour >= 12 && hour < 18) {
                        this.greeting = '{{ __('Buenas tardes,') }}';
                    } else {
                        this.greeting = '{{ __('Buenas noches,') }}';
                    }
                }
            }" class="text-3xl leading-normal">
            <span x-text="greeting"></span>
            <br>
            <span class="uppercase">{{ auth()->user()->name }}</span>
             <br>
            <span class="text-sm opacity-70" x-text="currentDateTime"></span>
        </div>

        <div class="mt-10">
            <div x-data="{ selectedTab: 'analitics' }" class="w-full">
                <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                    <button x-on:click="selectedTab = 'analitics'" x-bind:aria-selected="selectedTab === 'analitics'" x-bind:tabindex="selectedTab === 'analitics' ? '0' : '-1'" x-bind:class="selectedTab === 'analitics' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelAnalitics">
                        <div class="flex items-center gap-2">
                            <flux:icon.chart-bar class="size-5" />
                            <span>{{ __('Analiticas') }}</span>
                        </div>
                    </button>
                    <button x-on:click="selectedTab = 'steps'" x-bind:aria-selected="selectedTab === 'steps'" x-bind:tabindex="selectedTab === 'steps' ? '0' : '-1'" x-bind:class="selectedTab === 'steps' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelSteps">
                        <div class="flex items-center gap-2">
                            <flux:icon.cube class="size-5" />
                            <span>{{ __('Pasos faltantes') }}</span>
                        </div>
                    </button>
                </div>
                <div class="px-2 mt-10">
                    <div x-cloak x-show="selectedTab === 'analitics'" id="tabpanelAnalitics" role="tabpanel" aria-label="analitics">
                        <div class="w-full">
                            <div class="grid gap-4 lg:grid-cols-3 lg:grid-rows-2">
                            <div class="relative lg:row-span-2">
                                <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 lg:rounded-l-4xl"></div>
                                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                                <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                                    <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">Mobile friendly</p>
                                    <p class="mt-2 max-w-lg text-sm/6 opacity-70 max-lg:text-center">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.</p>
                                </div>

                                </div>
                                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 lg:rounded-l-4xl"></div>
                            </div>
                            <div class="relative max-lg:row-start-1">
                                <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 max-lg:rounded-t-4xl"></div>
                                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                                <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                    <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">Performance</p>
                                    <p class="mt-2 max-w-lg text-sm/6 opacity-70 max-lg:text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit maiores impedit.</p>
                                </div>

                                </div>
                                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 max-lg:rounded-t-4xl"></div>
                            </div>
                            <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                                <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800"></div>
                                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
                                <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                                    <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">Security</p>
                                    <p class="mt-2 max-w-lg text-sm/6 opacity-70 max-lg:text-center">Morbi viverra dui mi arcu sed. Tellus semper adipiscing suspendisse semper morbi.</p>
                                </div>
                                <div class="@container flex flex-1 items-center max-lg:py-6 lg:pb-2">
                                    <img src="https://tailwindcss.com/plus-assets/img/component-images/dark-bento-03-security.png" alt="" class="h-[min(152px,40cqw)] object-cover" />
                                </div>
                                </div>
                                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15"></div>
                            </div>
                            <div class="relative lg:row-span-2">
                                <div class="absolute inset-px rounded-lg bg-light-variant dark:bg-dark-variant border border-neutral-200 dark:border-neutral-800 max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
                                <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                                    <p class="mt-2 text-lg font-medium tracking-tight max-lg:text-center">Powerful APIs</p>
                                    <p class="mt-2 max-w-lg text-sm/6 opacity-70 max-lg:text-center">Sit quis amet rutrum tellus ullamcorper ultricies libero dolor eget sem sodales gravida.</p>
                                </div>

                                </div>
                                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-white/15 max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div x-cloak x-show="selectedTab === 'steps'" id="tabpanelSteps" role="tabpanel" aria-label="steps">
                        <b><a href="#" class="underline">{{ __('Pasos faltantes') }}</a></b> tab is selected
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
