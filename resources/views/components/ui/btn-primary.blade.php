{{-- Apple-style primary button / link
     Usage (link):   <x-ui.btn-primary href="{{ route('register') }}" wire:navigate>Label</x-ui.btn-primary>
     Usage (button): <x-ui.btn-primary type="submit">Label</x-ui.btn-primary>
--}}
@props(['href' => null, 'type' => 'button'])

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center gap-2 rounded-full bg-[#1d1d1f] px-7 py-3.5 text-[15px] font-medium leading-none text-white transition-all duration-200 ease-out hover:bg-[#3a3a3c] active:scale-[0.97] select-none cursor-pointer',
        ]) }}
    >{{ $slot }}</a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'inline-flex items-center justify-center gap-2 rounded-full bg-[#1d1d1f] px-7 py-3.5 text-[15px] font-medium leading-none text-white transition-all duration-200 ease-out hover:bg-[#3a3a3c] active:scale-[0.97] select-none cursor-pointer',
        ]) }}
    >{{ $slot }}</button>
@endif
