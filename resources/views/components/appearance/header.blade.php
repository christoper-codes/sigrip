<div {{ $attributes->merge(['class' => 'flex items-start justify-between mb-10']) }}>
        <div>
            {{ $slot }}
        </div>
        <div class="hidden lg:block">
           <livewire:notifications.bell-alert />
        </div>
</div>
