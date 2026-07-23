<x-layouts.app :title="__('Análisis Ai')">
    <div class="h-full w-full relative">
        <x-appearance.header>
            <div class="text-3xl leading-normal space-y-2">
                <p class="uppercase font-bold special-font">{{ __('Análisis Ai') }}</p>
                <p class="text-sm opacity-70">{{ __('Resultados y análisis de aplicaciones con inteligencia artificial') }}</p>
            </div>
        </x-appearance.header>
        <div x-data="{ selectedTab: 'show' }" class="w-full">
            <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                <button x-on:click="selectedTab = 'show'" x-bind:aria-selected="selectedTab === 'show'" x-bind:tabindex="selectedTab === 'show' ? '0' : '-1'" x-bind:class="selectedTab === 'show' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelCreateUpdate">
                    <div class="flex items-center gap-2">
                        <flux:icon.document-chart-bar class="size-5" />
                        <span>{{ __('Resultados') }}</span>
                    </div>
                </button>
                <button x-on:click="selectedTab = 'ai'" x-bind:aria-selected="selectedTab === 'ai'" x-bind:tabindex="selectedTab === 'ai' ? '0' : '-1'" x-bind:class="selectedTab === 'ai' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelCreateUpdate">
                    <div class="flex items-center gap-2">
                        <flux:icon.sparkles class="size-5" />
                        <span>{{ __('Análisis') }}</span>
                    </div>
                </button>
                 <button x-on:click="selectedTab = 'info'" x-bind:aria-selected="selectedTab === 'info'" x-bind:tabindex="selectedTab === 'info' ? '0' : '-1'" x-bind:class="selectedTab === 'info' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelInfo">
                    <div class="flex items-center gap-2">
                        <flux:icon.document class="size-5" />
                        <span>{{ __('Estadísticas') }}</span>
                    </div>
                </button>
            </div>
            <div class="px-2 mt-10">
                <div x-cloak x-show="selectedTab === 'show'" id="tabpanelCreateUpdate" role="tabpanel" aria-label="create">
                    <div>
                        <flux:heading size="xl">{{ __('Resultados particulares') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Análisis detallados de aplicaciones específicas') }}</flux:text>
                        <div class="mt-5">
                            <livewire:analysis.show />
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="selectedTab === 'ai'" id="tabpanelCreateUpdate" role="tabpanel" aria-label="create">
                    <div>
                        <flux:heading size="xl">{{ __('Análisis de IA') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Resultados y análisis de aplicaciones con inteligencia artificial. La selección aplica para todos los departamentos.') }}</flux:text>
                        <div class="mt-5">
                            <livewire:analysis.ai />
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="selectedTab === 'info'" id="tabpanelInfo" role="tabpanel" aria-label="info">
                    <div>
                        <livewire:analysis.index />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
