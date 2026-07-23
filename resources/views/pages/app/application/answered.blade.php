<x-layouts.application :title="__('Applicación inactiva')">
    <section id="application-inactive" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="flex items-center justify-between relative">
                <a href="{{ route('home') }}" wire:navigate>
                    <x-app-logo-icon />
                </a>
                <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                    <flux:icon.sun x-show="$flux.appearance === 'light'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                    <flux:icon.sun x-show="$flux.appearance === 'dark'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                </div>
            </div>
            <livewire:application.answered />
            <x-appearance.rightsreserved />
        </flux:main>
    </section>
</x-layouts.application>
