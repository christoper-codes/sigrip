@props([
    'title',
    'type' => 'button',
])

<flux:button
    {{ $attributes->merge(['class' => '!whitespace-nowrap !px-5 !py-3 cursor-pointer! rounded-full! !text-base !bg-dark dark:!bg-light hover:!bg-neutral-800 dark:hover:!bg-neutral-200 !transition-all !duration-500 !text-center !text-white dark:!text-neutral-800']) }}
    variant="primary"
    type="{{ $type }}"
    >
    {{ $title }}
</flux:button>
