<x-layouts.base.master>
    @include('partials.header')
    <main class="overflow-hidden">
        {{ $slot }}
    </main>
    @include('partials.footer')
</x-layouts.base.master>
