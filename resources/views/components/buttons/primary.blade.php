@props([
    'title',
])

<button {{ $attributes->merge(['class' => 'btn-simple !text-base']) }} data-text="{{ $title }}">
    {{ $title }}
</button>
