<x-layouts.app :title="__('Dashboard')">
    <div class="h-full w-full">
        <x-appearance.header>
            <div class="text-3xl leading-normal space-y-2">
                <p class="uppercase">{{ __('Departamentos') }}</p>
                <p class="text-sm opacity-70">{{ __('Lista y crea departamentos para tu compañía') }}</p>
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
                        <span>{{ __('Crear / Actualizar') }}</span>
                    </div>
                </button>
            </div>
            <div class="px-2 mt-10">
                <div x-cloak x-show="selectedTab === 'info'" id="tabpanelInfo" role="tabpanel" aria-label="info">
                    <livewire:department.index />
                </div>
                <div x-cloak x-show="selectedTab === 'create'" id="tabpanelCreateUpdate" role="tabpanel" aria-label="create">
                    <div class="max-w-2xl">
                        @if (!auth()->user()->company_id)
                            <flux:heading size="xl">{{ __('Crea tu compañía') }}</flux:heading>
                            <flux:text class="mt-2">{{ __('Completa el formulario para configurar tu cuenta y agregar departamentos.') }}</flux:text>
                            <div class="mt-5">
                                <livewire:company.store />
                            </div>
                        @endif

                        @if (auth()->user()->company_id)
                            <flux:heading size="xl">{{ __('Actualiza tu compañía') }}</flux:heading>
                            <flux:text class="mt-2">{{ __('Actualiza la información de tu compañía.') }}</flux:text>
                            <div class="mt-5">
                                <livewire:company.update :company="auth()->user()->company" />
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
