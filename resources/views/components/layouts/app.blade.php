<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="bg-light dark:bg-dark">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
