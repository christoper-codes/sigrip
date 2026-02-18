<x-layouts.application :title="__('Applicación')">
    <section id="application-show" class="h-full!">
        <flux:main class="!max-w-[70rem] !w-full h-full! !mx-auto !px-0 !py-0 relative flex! flex-col! justify-between!">
            <div class="absolute left-0 lg:hidden top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-primary/30"></div>
            <div class="absolute hidden lg:block right-0 top-0 lg:-top-96 h-[280px] w-[100px] lg:h-[400px] lg:w-[300px] rounded-full blur-[100px] lg:blur-[150px] bg-primary/30"></div>
            <div>
                <div class="flex items-center justify-between relative">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-app-logo-icon />
                    </a>
                    <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer size-7! border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center!">
                        <x-icon.sun variant="mini" class="size-4! text-dark! dark:text-light!"/>
                    </flux:link>
                </div>
                <livewire:application.show :application="$application" :is_visitor="$is_visitor" />
            </div>
            <div class="mt-40">
                <x-appearance.rightsreserved />
            </div>
        </flux:main>
    </section>
</x-layouts.application>
