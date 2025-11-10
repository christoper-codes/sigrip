<x-layouts.app :title="__('Dashboard')">
    <div class="h-full w-full">
        <x-appearance.header>
            <div class="text-3xl leading-normal">
                <p class="uppercase">{{ auth()->user()->name }}</p>
                <p class="text-sm opacity-70">hello</p>
            </div>
        </x-appearance.header>
    </div>
</x-layouts.app>
