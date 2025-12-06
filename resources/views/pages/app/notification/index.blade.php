<x-layouts.app :title="__('Notificaciones')">
    <div class="h-full w-full">
        <x-appearance.header>
            <div class="text-3xl leading-normal space-y-2">
                <p class="uppercase">{{ __('Notificaciones') }}</p>
                <p class="text-sm opacity-70">{{ __('Revisa nuevas y antiguas notificaciones.') }}</p>
            </div>
        </x-appearance.header>

        <div x-data="{ selectedTab: 'recent' }" class="w-full">
            <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                <button x-on:click="selectedTab = 'recent'" x-bind:aria-selected="selectedTab === 'recent'" x-bind:tabindex="selectedTab === 'recent' ? '0' : '-1'" x-bind:class="selectedTab === 'recent' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelRecent">
                    <div class="flex items-center gap-2">
                        <flux:icon.bell-alert class="size-5" />
                        <span>{{ __('Recientes') }}</span>
                    </div>
                </button>
            </div>
            <div class="px-2 mt-10">
                <div x-cloak x-show="selectedTab === 'recent'" id="tabpanelRecent" role="tabpanel" aria-label="recent">
                    <livewire:notifications.index />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
