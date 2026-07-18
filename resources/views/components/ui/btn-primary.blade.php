{{-- Liquid-glass primary button / link — always light-mode styling.
     Header and hero are permanently light regardless of the site's dark
     mode, so this button never switches to the dark glass variant.
     Usage (link):   <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>Label</x-ui.btn-primary>
     Usage (button): <x-ui.btn-primary type="submit">Label</x-ui.btn-primary>

     Extra classes passed by the caller (e.g. class="px-5! py-2!") must land
     on the inner <span> — that's where the default padding/text-size
     classes live, so that's what they need to override.
--}}
@props(['href' => null, 'type' => 'button'])

@php
$wrapperClass = 'liquid-glass-light rounded-full w-fit block select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out';
$labelClass = 'block font-light text-[0.7rem] tracking-[0.2em] uppercase text-black select-none px-8 py-3.5';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->except('class')->merge(['class' => $wrapperClass]) }}>
        <span class="{{ $labelClass }} {{ $attributes->get('class') }}">{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->except('class')->merge(['class' => $wrapperClass]) }}>
        <span class="{{ $labelClass }} {{ $attributes->get('class') }}">{{ $slot }}</span>
    </button>
@endif
