@props([
    'title',
    'url'
])

<flux:link
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'hover:!no-underline !whitespace-nowrap !block !px-5 !py-3 cursor-pointer! rounded-full! !text-base !bg-light hover:!bg-neutral-200 !transition-all !duration-500 !text-center !text-neutral-800']) }}
    variant="ghost"
    wire:navigate
    >
    {{ $title }}
</flux:link>
