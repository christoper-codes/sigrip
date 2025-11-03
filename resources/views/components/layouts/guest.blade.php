<x-layouts.guest.simple :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.guest.simple>
