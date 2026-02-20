<x-layouts.app :title="__('Tickets')">
    <div class="h-full w-full relative">
        <x-appearance.header>
            <div class="text-3xl leading-normal space-y-2">
                <p class="uppercase">{{ __('Tickets') }}</p>
                <p class="text-sm opacity-70">{{ __('Creación y seguimiento de tickets para incidencias.') }}</p>
            </div>
        </x-appearance.header>

        <div
            x-data="{
                selectedTab: (new URLSearchParams(window.location.search).get('tab')) ??
                    '{{ auth()->user()->can('viewDepartmentManager', auth()->user()) ? 'recent' : 'employee' }}'
            }"
            class="w-full">
            <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()" class="flex items-end gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700" role="tablist" aria-label="tab options">
                 @can('viewDepartmentManager', auth()->user())
                    <a href="{{ route('ticket.index') }}?tab=recent" wire:navigate>
                        <button x-bind:aria-selected="selectedTab === 'recent'" x-bind:tabindex="selectedTab === 'recent' ? '0' : '-1'" x-bind:class="selectedTab === 'recent' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelRecent">
                            <div class="flex items-center gap-2">
                                <flux:icon.bell-alert class="size-5" />
                                <span>{{ __('Recientes') }}</span>
                            </div>
                        </button>
                    </a>
                @endcan
                <a href="{{ route('ticket.index') }}?tab=employee" wire:navigate
                    <button x-bind:aria-selected="selectedTab === 'employee'" x-bind:tabindex="selectedTab === 'employee' ? '0' : '-1'" x-bind:class="selectedTab === 'employee' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelEmployee">
                        <div class="flex items-center gap-2">
                            <flux:icon.folder class="size-5" />
                            <span>{{ __('Mis tickets') }}</span>
                        </div>
                    </button>
                </a>
                <button x-on:click="selectedTab = 'create'" x-bind:aria-selected="selectedTab === 'create'" x-bind:tabindex="selectedTab === 'create' ? '0' : '-1'" x-bind:class="selectedTab === 'create' ? 'font-bold text-primary border-b-2 border-primary' : 'font-medium hover:border-b-2'" class="h-min px-4 py-2 text-sm cursor-pointer" type="button" role="tab" aria-controls="tabpanelCreateUpdate">
                    <div class="flex items-center gap-2">
                        <flux:icon.cube class="size-5" />
                        <span>{{ __('Crear') }}</span>
                    </div>
                </button>
            </div>
            <div class="px-2 mt-10">
                @can('viewDepartmentManager', auth()->user())
                    <div x-cloak x-show="selectedTab === 'recent'" id="tabpanelRecent" role="tabpanel" aria-label="recent">
                        <livewire:ticket.index />
                    </div>
                @endcan
                <div x-cloak x-show="selectedTab === 'employee'" id="tabpanelEmployee" role="tabpanel" aria-label="employee">
                    <div>
                        <flux:heading size="xl">{{ __('Mis tickets') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Aquí puedes ver y gestionar tus tickets creados.') }}</flux:text>
                        <div class="mt-5">
                            <livewire:ticket.employee />
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="selectedTab === 'create'" id="tabpanelCreateUpdate" role="tabpanel" aria-label="create">
                    <div class="max-w-2xl">
                        <flux:heading size="xl">{{ __('Crear un nuevo ticket') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Completa el formulario para crear un nuevo ticket y dar seguimiento a la incidencia.') }}</flux:text>
                        <div class="mt-10">
                            <livewire:ticket.store />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
