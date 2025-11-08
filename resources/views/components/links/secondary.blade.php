@props([
    'title',
    'url'
])

<flux:link
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'hover:!no-underline !whitespace-nowrap !block !px-5 !py-3 cursor-pointer! rounded-full! !text-base !transition-all !duration-500 !text-center !bg-transparent !border-2 !border-neutral-700 !text-white hover:!bg-neutral-800']) }}
    variant="ghost"
    wire:navigate
    >
    {{ $title }}
</flux:link>
