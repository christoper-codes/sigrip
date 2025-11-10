<div {{ $attributes->merge(['class' => 'flex items-start justify-between mb-10']) }}>
        <div>
            {{ $slot }}
        </div>
        <div class="hidden lg:block relative">
            <div class="flex items-center justify-center p-3 rounded-full border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant">
                <flux:icon.bell class="size-5"/>
            </div>
            <div class="absolute -top-1 -right-1 text-light bg-primary text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">
                <span>{{ auth()->user()->metadata['notifications'] ?? 0 }}</span>
            </div>
        </div>
</div>
