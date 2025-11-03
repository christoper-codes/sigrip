<header>
    <x-main-container>
        <nav class="flex items-center justify-between gap-5">
            <div>
                <x-app-logo-icon class="size-5 fill-current uppercase tracking-widest [filter:drop-shadow(0px_0px_15px_rgb(255_255_255_/_100%))]"/>
            </div>
            <div>
                <flux:navbar>
                    <flux:navbar.item href="#" icon="bolt">{{ __('Como funciona') }}</flux:navbar.item>
                    <flux:navbar.item href="#" icon="chat-bubble-bottom-center">{{ __('Preguntas') }}</flux:navbar.item>
                    <flux:navbar.item href="#" icon="cube">{{ __('Precios') }}</flux:navbar.item>
                </flux:navbar>
            </div>
            <div>
                <flux:button variant="primary">{{ __('Iniciar sesión') }}</flux:button>
            </div>
        </nav>
    </x-main-container>
</header>
