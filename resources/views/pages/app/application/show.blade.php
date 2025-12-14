<x-layouts.application :title="__('Applicación')">
    <section id="application-show">
        <flux:main class="!max-w-[70rem] !w-full !mx-auto !px-0 !py-0">
            <div class="flex items-center justify-between">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-app-logo-icon class="w-24"/>
                    </a>
                <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                    <flux:icon.sun x-show="$flux.appearance === 'light'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                    <flux:icon.sun x-show="$flux.appearance === 'dark'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                </div>
            </div>
            <livewire:application.show :application="$application" />
        </flux:main>
    </section>
</x-layouts.application>
