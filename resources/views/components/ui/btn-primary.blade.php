{{-- Liquid-glass primary button / link
     Usage (link):   <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>Label</x-ui.btn-primary>
     Usage (button): <x-ui.btn-primary type="submit">Label</x-ui.btn-primary>

     .liquid-glass (white tint, landing.css) reads on dark backgrounds;
     .liquid-glass-light (dark tint) is its light-mode counterpart. Which one
     applies is driven by Flux's own $flux.dark magic.
--}}
@props(['href' => null, 'type' => 'button'])

@php
$wrapperClass = 'rounded-full w-fit block select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out';
$labelClass = 'block font-light text-[0.7rem] tracking-[0.2em] uppercase px-8 py-3.5 select-none';
@endphp

@if($href)
    <a
        href="{{ $href }}"
        :class="$flux.dark ? 'liquid-glass' : 'liquid-glass-light'"
        {{ $attributes->merge(['class' => $wrapperClass]) }}
    >
        <span class="{{ $labelClass }}" :class="$flux.dark ? 'text-white' : 'text-black'">{{ $slot }}</span>
    </a>
@else
    <button
        type="{{ $type }}"
        :class="$flux.dark ? 'liquid-glass' : 'liquid-glass-light'"
        {{ $attributes->merge(['class' => $wrapperClass]) }}
    >
        <span class="{{ $labelClass }}" :class="$flux.dark ? 'text-white' : 'text-black'">{{ $slot }}</span>
    </button>
@endif
