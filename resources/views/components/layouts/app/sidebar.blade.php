<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-light text-dark dark:bg-dark dark:text-light text-base md:text-lg">
        <x-alert />
        <livewire:notifications.toast />

        <flux:sidebar sticky stashable class="!w-[280px] border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('home') }}" class="mt-4 me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Administración')" class="grid">
                    <flux:navlist.item class="!py-5" icon="bolt" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item class="!py-5" icon="building-office" :href="route('company.index')" :current="request()->routeIs('company.index')" wire:navigate>{{ __('Compañia') }}</flux:navlist.item>
                    <flux:navlist.item class="!py-5" icon="cube" :href="route('department.index')" :current="request()->routeIs('department.index')" wire:navigate>{{ __('Departamentos') }}</flux:navlist.item>
                    <flux:navlist.item class="!py-5" icon="users" :href="route('employee.index')" :current="request()->routeIs('employee.index')" wire:navigate>{{ __('Empleados') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Core')" class="grid">
                    <flux:sidebar.group expandable :heading="__('Principales')" class="grid">
                        <flux:sidebar.item class="!py-5 cursor-pointer!" icon="squares-plus" :href="route('application.index')" :current="request()->routeIs('application.index')" wire:navigate>{{ __('Aplicaciones') }}</flux:sidebar.item>
                        <flux:sidebar.item class="!py-5 cursor-pointer!" icon="clipboard-document-list" :href="route('questionnaire.index')" :current="request()->routeIs('questionnaire.index')" wire:navigate>{{ __('Questionarios') }}</flux:sidebar.item>
                    </flux:sidebar.group>
                </flux:navlist.group>
            </flux:navlist>
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Seguimiento')" class="grid">
                     <flux:sidebar.group expandable :expanded="request()->routeIs('notification.index')" :heading="__('Primordial')" class="grid">
                        <flux:sidebar.item class="!py-5 cursor-pointer!" icon="bell" :href="route('notification.index')" :current="request()->routeIs('notification.index')" wire:navigate>
                            <span>{{ __('Notificaciones') }}</span>
                            @if(auth()->user()->metadata['notifications'] > 0)
                                <div class="inline rounded-sm border border-primary bg-primary/10 text-center text-xs px-2 py-0.5 ml-1">
                                    {{ auth()->user()->metadata['notifications'] }}
                                </div>
                            @endif
                        </flux:sidebar.item>
                    </flux:sidebar.group>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-x-3 lg:hidden">
                    <div x-data class="flex items-center justify-center p-2 lg:p-3 rounded-full border border-neutral-300 dark:border-neutral-700 bg-light-variant dark:bg-dark-variant">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" x-on:click="$flux.dark = ! $flux.dark" class="cursor-pointer size-4! lg:size-5!" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" x-on:click="$flux.dark = ! $flux.dark" class="cursor-pointer size-4! lg:size-5!" />
                    </div>
                    <livewire:notifications.bell-alert />
                </div>
                <flux:dropdown position="top" align="end">
                    <flux:profile
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevron-down"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                        >
                                            {{ auth()->user()->initials() }}
                                        </span>
                                    </span>

                                    <div class="grid flex-1 text-start text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </div>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
