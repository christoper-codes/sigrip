<x-layouts.app :title="__('Questionarios')">
    <div class="h-full w-full relative">
        <x-appearance.header>
            <div class="text-3xl leading-normal space-y-2">
                <p class="uppercase">{{ __('Questionarios') }}</p>
                <p class="text-sm opacity-70">{{ __('Información y configuración de tus questionarios') }}</p>
            </div>
        </x-appearance.header>
        <div x-data="{ selectedTab: 'info' }" class="w-full">
            <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                <button x-on:click="selectedTab = 'info'" x-bind:aria-selected="selectedTab === 'info'" x-bind:tabindex="selectedTab === 'info' ? '0' : '-1'" x-bind:class="selectedTab === 'info' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelInfo">
                    <div class="flex items-center gap-2">
                        <flux:icon.document class="size-5" />
                        <span>{{ __('Información') }}</span>
                    </div>
                </button>
                <button x-on:click="selectedTab = 'create'" x-bind:aria-selected="selectedTab === 'create'" x-bind:tabindex="selectedTab === 'create' ? '0' : '-1'" x-bind:class="selectedTab === 'create' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelCreateUpdate">
                    <div class="flex items-center gap-2">
                        <flux:icon.cube class="size-5" />
                        <span>{{ __('Crear') }}</span>
                    </div>
                </button>
            </div>
            <div class="px-2 mt-10">
                <div x-cloak x-show="selectedTab === 'info'" id="tabpanelInfo" role="tabpanel" aria-label="info">
                    <flux:heading size="xl">{{ __('Cuestionarios activos e inactivos') }}</flux:heading>
                    <flux:text class="mt-2">{{ __('Información de cuestionarios bases basada en: ') }}</flux:text>
                    <ul class="list-disc ml-5">
                        <li class="mt-2 underline"><flux:text>{{ __('Decreto 1072 de 2015') }}</flux:text></li>
                        <li class="mt-2 underline"><flux:text>{{ __('Resolución 2646 de 2008') }}</flux:text></li>
                        <li class="mt-2 underline"><flux:text>{{ __('Resolución 0312 de 2019') }}</flux:text></li>
                    </ul>
                    <div class="mt-10">
                        <livewire:questionnaire.index />
                    </div>
                </div>
                <div x-cloak x-show="selectedTab === 'create'" id="tabpanelCreateUpdate" role="tabpanel" aria-label="create">
                    <div class="max-w-2xl">
                        <flux:heading size="xl">{{ __('Crear un nuevo questionario') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Completa el formulario para crear y asociarlo a tu compañia.') }}</flux:text>
                        <div class="mt-10">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
