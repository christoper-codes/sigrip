@props([
    'title',
    'type' => 'button',
])

<flux:button
    {{ $attributes->merge(['class' => '!whitespace-nowrap !px-5 !py-3 cursor-pointer! rounded-full! !text-base !bg-light hover:!bg-neutral-200 !transition-all !duration-500 !text-center !text-neutral-800']) }}
    variant="primary"
    type="{{ $type }}"
    >
    {{ $title }}
</flux:button>
