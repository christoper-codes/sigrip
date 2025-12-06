<a href="{{ route('notification.index') }}" class="relative">
    <div class="flex items-center justify-center p-2 lg:p-3 rounded-full border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant">
        <flux:icon.bell class="size-4 lg:size-5"/>
    </div>
    <div class="absolute -top-1 -right-1 border border-primary bg-primary/20 backdrop-blur-2xl text-xs rounded-full h-4.5 lg:h-5 w-4.5 lg:w-5 flex items-center justify-center font-semibold">
        <span>{{ $notifications }}</span>
    </div>
</a>
