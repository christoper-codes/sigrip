<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="bg-light dark:bg-dark !mb-20 relative">
{{--    <div class="absolute left-0 lg:-left-40  top-0 lg:-top-80 h-[380px] w-[200px] lg:h-[580px] lg:w-[400px] rounded-full blur-[120px] lg:blur-[150px] bg-primary/30"></div> --}}
        <div class="absolute right-0 top-0 lg:-top-96 h-[380px] w-[200px] lg:h-[500px] lg:w-[400px] rounded-full blur-[120px] lg:blur-[150px] bg-transparent dark:bg-light/20"></div>
        {{ $slot }}
        <x-appearance.rightsreserved />
    </flux:main>
</x-layouts.app.sidebar>
