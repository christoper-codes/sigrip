<x-layouts.base.master>
    @include('partials.header')
    <main>
        {{ $slot }}
    </main>
    @include('partials.footer')
</x-layouts.base.master>
