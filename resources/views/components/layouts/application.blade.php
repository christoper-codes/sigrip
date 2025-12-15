<x-layouts.guest.zero :title="$title ?? null">
    <flux:main class="h-screen!">
        {{ $slot }}
    </flux:main>
</x-layouts.guest.zero>
