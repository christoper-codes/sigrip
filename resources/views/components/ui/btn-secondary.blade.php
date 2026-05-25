{{-- iOS Liquid Glass secondary button / link
     Usage (link):   <x-ui.btn-secondary href="{{ route('login') }}" wire:navigate>Label</x-ui.btn-secondary>
     Usage (button): <x-ui.btn-secondary>Label</x-ui.btn-secondary>
--}}
@props(['href' => null, 'type' => 'button'])

@if($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge([
            'class' => 'ios-glass inline-flex items-center justify-center gap-2 rounded-full border border-black/[0.08] px-7 py-3.5 text-[15px] font-medium leading-none text-gray-900 transition-all duration-200 ease-out hover:border-black/[0.13] hover:bg-white active:scale-[0.97] select-none cursor-pointer',
        ]) }}
    >{{ $slot }}</a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'ios-glass inline-flex items-center justify-center gap-2 rounded-full border border-black/[0.08] px-7 py-3.5 text-[15px] font-medium leading-none text-gray-900 transition-all duration-200 ease-out hover:border-black/[0.13] hover:bg-white active:scale-[0.97] select-none cursor-pointer',
        ]) }}
    >{{ $slot }}</button>
@endif
