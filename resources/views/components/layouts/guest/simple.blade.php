<x-layouts.base.master>
    @include('partials.header')
    <main>
        {{ $slot }}
    </main>
</x-layouts.base.master>
