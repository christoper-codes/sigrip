@props([
    'status' => 'active' // active, inactive, pending
])

<div>
    @if ($status == 'active')
        <div class="border-2 border-green-500 text-green-500 rounded-full py-2 px-4 inline-block text-center text-xs">
            {{ __('Activo') }}
        </div>
    @endif

    @if ($status == 'inactive')
        <div class="border-2 border-red-500 text-red-500 rounded-full py-2 px-4 inline-block text-center text-xs">
            {{ __('Inactivo') }}
        </div>
    @endif

    @if ($status == 'pending')
        <div class="border-2 border-yellow-500 text-yellow-500 rounded-full py-2 px-4 inline-block text-center text-xs">
            {{ __('Pendiente') }}
        </div>
    @endif
</div>
