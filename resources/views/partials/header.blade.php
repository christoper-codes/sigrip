<header
    x-data="{
        scrolled: false,
        mobileMenuOpen: false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 50
        })
    "
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'pt-4' : 'pt-0'"
    >
    <div class="mx-auto transition-all duration-500 ease-in-out" :class="scrolled ? 'max-w-5xl px-6' : 'max-w-full px-0'">
        <div
            class="border-0 border-transparent transition-all duration-500 ease-in-out [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_100ms_ease-in-out] overflow-hidden dark:overflow-visible"
            :class="scrolled ? 'backdrop-blur-lg bg-neutral-500/5 rounded-full !border-[1px] !border-neutral-200 dark:!border-neutral-800 [transition:background-color_500ms_ease-in-out,backdrop-filter_500ms_ease-in-out,border-radius_500ms_ease-in-out,border_300ms_ease-in-out_500ms]' : 'border-0 border-transparent'"
        >
            <x-main-container>
                <nav class="flex items-center justify-between gap-10 transition-all duration-500 py-2.5" :class="scrolled ? 'px-1 lg:px-5' : ''">
                    <div>
                        <x-app-logo-icon class="w-[90px] mr-5"/>
                    </div>
                    <div class="lg:hidden">
                        <button @click="mobileMenuOpen = true">
                            <flux:icon.bars-2 class="size-8"/>
                        </button>
                    </div>
                    <div class="transition-all duration-500 hidden lg:block">
                        <div class="flex items-center gap-5 text-base">
                            <a href="#">{{ __('Como funciona') }}</a>
                            <div class="flex items-center gap-2">
                                <flux:icon.chat-bubble-left class="size-5" />
                                <a href="#" icon="chat-bubble-bottom-center">{{ __('Preguntas') }}</a>
                            </div>
                            <a href="#">{{ __('Precios') }}</a>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center ">
                        <flux:link href="{{ route('login') }}" class="btn hover:!no-underline !px-0" variant="ghost">
                            {{ __('Iniciar sesion') }}
                        </flux:link>
                        <flux:link href="{{ route('register') }}" class="hover:!no-underline" variant="ghost" wire:navigate>
                            <x-buttons.primary title="{{ __('Registrarse') }}" />
                        </flux:link>
                    </div>
                </nav>
            </x-main-container>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div
        x-show="mobileMenuOpen"
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black/50 backdrop-blur-lg z-[60] lg:hidden"
        @click="mobileMenuOpen = false"
    >
        <!-- Mobile Menu Content -->
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-[-100%]"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-[-100%]"
            class="bg-white dark:bg-neutral-900 border-b border-neutral-200 dark:border-neutral-800 shadow-lg"
            @click.stop
        >
            <div class="px-6 py-6">
                <!-- Header with close button -->
                <div class="flex items-center justify-between mb-8">
                    <x-app-logo-icon class="w-[90px]"/>
                    <button @click="mobileMenuOpen = false" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                        <flux:icon.x-mark class="size-6"/>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-6">
                    <a href="#" @click="mobileMenuOpen = false" class="block text-lg font-medium py-3 border-b border-neutral-200 dark:border-neutral-800">
                        {{ __('Como funciona') }}
                    </a>
                    <a href="#" @click="mobileMenuOpen = false" class="block text-lg font-medium py-3 border-b border-neutral-200 dark:border-neutral-800">
                        <div class="flex items-center gap-3">
                            <flux:icon.chat-bubble-left class="size-5" />
                            <span>{{ __('Preguntas') }}</span>
                        </div>
                    </a>
                    <a href="#" @click="mobileMenuOpen = false" class="block text-lg font-medium py-3 border-b border-neutral-200 dark:border-neutral-800">
                        {{ __('Precios') }}
                    </a>
                </nav>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col gap-4">
                    <flux:button class="btn" variant="primary">
                        {{ __('Iniciar sesion') }}
                    </flux:button>
                    <flux:link href="{{ route('register') }}" class="hover:!no-underline" variant="ghost" wire:navigate>
                        <x-buttons.primary title="{{ __('Registrarse') }}" />
                    </flux:link>
                </div>
            </div>
        </div>
    </div>
</header>
