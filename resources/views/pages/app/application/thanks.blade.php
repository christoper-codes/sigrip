<x-layouts.application :title="__('Applicación')">
    <section id="application-thanks" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="absolute left-0 lg:hidden top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
            <div class="absolute hidden lg:block right-0 top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-transparent dark:bg-yellow-50/20"></div>
            <div class="flex items-center justify-between relative">
                <a href="{{ route('home') }}" wire:navigate>
                    <x-app-logo-icon />
                </a>
                <div x-data class="size-7 border border-neutral-300 dark:border-neutral-600 rounded-full flex items-center justify-center">
                    <flux:icon.sun x-show="$flux.appearance === 'light'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                    <flux:icon.sun x-show="$flux.appearance === 'dark'" x-on:click="$flux.dark = ! $flux.dark" variant="mini" class="cursor-pointer size-4!" />
                </div>
            </div>
            <livewire:application.thanks />
            <x-appearance.rightsreserved />
        </flux:main>
    </section>
</x-layouts.application>
