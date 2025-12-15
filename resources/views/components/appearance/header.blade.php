<div {{ $attributes->merge(['class' => 'flex items-start justify-between mb-10']) }}>
    <div>
        {{ $slot }}
    </div>
    <div class="hidden lg:flex items-center gap-x-4 relative">
        <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer p-2 lg:p-3 border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center! bg-light-variant dark:bg-dark-variant">
            <x-icon.sun class="size-4! lg:size-5! text-dark! dark:text-light!"/>
        </flux:link>
        <livewire:notifications.bell-alert />
    </div>
</div>
