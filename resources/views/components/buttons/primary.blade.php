@props([
    'title',
])

<flux:button {{ $attributes->merge(['class' => 'btn !px-6 !py-6']) }} variant="primary">
    {{ $title }}
</flux:button>
