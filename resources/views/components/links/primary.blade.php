@props([
    'title',
    'url'
])

<flux:link
    href="{{ $url }}"
    {{ $attributes->merge(['class' => '!inline-block hover:!no-underline !whitespace-nowrap !px-5 !py-3 cursor-pointer! rounded-full! !text-base !bg-dark dark:!bg-light hover:!bg-neutral-800 dark:hover:!bg-neutral-200 !transition-all !duration-500 !text-center text-light dark:!text-neutral-800']) }}
    variant="ghost"
    wire:navigate
    >
    {{ $title }}
</flux:link>
