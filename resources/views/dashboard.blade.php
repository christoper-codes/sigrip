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
                <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-500 dark:border-neutral-700" role="tablist" aria-label="tab options">
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
                        <b><a href="#" class="underline">{{ __('Analiticas') }}</a></b> tab is selected
                    </div>
                    <div x-cloak x-show="selectedTab === 'steps'" id="tabpanelSteps" role="tabpanel" aria-label="steps">
                        <b><a href="#" class="underline">{{ __('Pasos faltantes') }}</a></b> tab is selected
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
