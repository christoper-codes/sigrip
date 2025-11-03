@props([
    'title',
])

<button {{ $attributes->merge(['class' => 'btn-simple uppercase !text-xs']) }} data-text="{{ $title }}">
    {{ $title }}
</button>
