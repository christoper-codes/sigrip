<x-layouts.base.master>
   {{--  @include('partials.header') --}}
    <main class="overflow-hidden">
        {{-- <x-links.whatsapp /> --}}
        {{ $slot }}
    </main>
    {{-- @include('partials.footer') --}}
</x-layouts.base.master>
