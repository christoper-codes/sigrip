<x-layouts.base.master>
    @include('partials.header')
    <main>
        <x-links.whatsapp />
        {{ $slot }}
    </main>
    @include('partials.footer')
</x-layouts.base.master>
