{{-- Liquid-glass primary button / link.
     Usage (link):   <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>Label</x-ui.btn-primary>
     Usage (button): <x-ui.btn-primary type="submit">Label</x-ui.btn-primary>

     Defaults to always-light styling (header/hero sit over photo/video and
     must stay light regardless of the site's dark mode). Pass `:adaptive="true"`
     for normal sections (like services) where the button should switch to the
     white-tinted glass in dark mode, same as the rest of the page.

     By default the adaptive switch follows `$flux.dark`. Pass `:follow="'scrolled'"`
     (any Alpine expression, as a string) to have it react to something else instead,
     e.g. a local x-data flag.

     Extra classes passed by the caller (e.g. class="px-5! py-2!") must land
     on the inner <span> — that's where the default padding/text-size
     classes live, so that's what they need to override.
--}}
@props(['href' => null, 'type' => 'button', 'adaptive' => false, 'follow' => null])

@php
$condition = $follow ?: '$flux.dark';
$wrapperClass = ($adaptive ? '' : 'liquid-glass-fixed ') . 'rounded-full w-fit block select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out';
$labelClass = 'block font-light text-[0.7rem] tracking-[0.2em] uppercase select-none px-8 py-3.5' . ($adaptive ? '' : ' text-black');
@endphp

@if($href)
    <a
        href="{{ $href }}"
        @if($adaptive) :class="{{ $condition }} ? 'liquid-glass' : 'liquid-glass-light'" @endif
        {{ $attributes->except('class')->merge(['class' => $wrapperClass]) }}
    >
        <span
            class="{{ $labelClass }} {{ $attributes->get('class') }}"
            @if($adaptive) :class="{{ $condition }} ? 'text-white' : 'text-black'" @endif
        >{{ $slot }}</span>
    </a>
@else
    <button
        type="{{ $type }}"
        @if($adaptive) :class="{{ $condition }} ? 'liquid-glass' : 'liquid-glass-light'" @endif
        {{ $attributes->except('class')->merge(['class' => $wrapperClass]) }}
    >
        <span
            class="{{ $labelClass }} {{ $attributes->get('class') }}"
            @if($adaptive) :class="{{ $condition }} ? 'text-white' : 'text-black'" @endif
        >{{ $slot }}</span>
    </button>
@endif
