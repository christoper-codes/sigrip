<div {{ $attributes->merge(['class' => 'flex items-start justify-between mb-10']) }}>
    <div>
        {{ $slot }}
    </div>
    <div class="hidden lg:flex items-center gap-x-4 relative">
        <div x-data x-on:click="$flux.dark = ! $flux.dark" class="cursor-pointer flex items-center justify-center p-2 lg:p-3 rounded-full border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant">
            <flux:icon.sun class="size-4! lg:size-5!" />
        </div>
        <livewire:notifications.bell-alert />
    </div>
</div>
