<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-light text-dark dark:bg-dark dark:text-light text-base md:text-lg">
        <x-alert />
        <livewire:notifications.toast />

        <flux:sidebar sticky collapsible stashable class="border-e overflow-hidden border-zinc-200 bg-dark dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
                <flux:sidebar.header>
                    <flux:sidebar.brand
                        href="{{ route('home') }}"
                        logo="/images/ai-logo-dark.svg"
                        logo:dark="/images/ai-logo-dark.svg"
                        name="NEURA"
                        wire:navigate
                    />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav variant="outline">
                <flux:navlist.group :heading="__('Administración')" class="grid sidebar-heading"></flux:navlist.group>
                <flux:sidebar.item class="!py-5 text-neutral-300! dark:text-neutral-200!" icon="bolt" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                <flux:sidebar.item class="!py-5 text-neutral-300! dark:text-neutral-200!" icon="building-office" :href="route('company.index')" :current="request()->routeIs('company.index')" wire:navigate>{{ __('Compañia') }}</flux:navlist.item>
                <flux:sidebar.item class="!py-5 text-neutral-300! dark:text-neutral-200!" icon="cube" :href="route('department.index')" :current="request()->routeIs('department.index')" wire:navigate>{{ __('Departamentos') }}</flux:navlist.item>
                <flux:sidebar.item class="!py-5 text-neutral-300! dark:text-neutral-200!" icon="users" :href="route('employee.index')" :current="request()->routeIs('employee.index')" wire:navigate>{{ __('Empleados') }}</flux:navlist.item>
            </flux:sidebar.nav>
            <flux:sidebar.nav variant="outline">
                <flux:navlist.group :heading="__('Core')" class="grid sidebar-heading"></flux:navlist.group>
                <flux:sidebar.group expandable icon="star" :heading="__('Principales')" class="grid">
                    <flux:sidebar.item class="!py-5 cursor-pointer! text-neutral-300! dark:text-neutral-200!" icon="squares-plus" :href="route('application.index')" :current="request()->routeIs('application.index')" wire:navigate>{{ __('Aplicaciones') }}</flux:sidebar.item>
                    <flux:sidebar.item class="!py-5 cursor-pointer! text-neutral-300! dark:text-neutral-200!" icon="clipboard-document-list" :href="route('questionnaire.index')" :current="request()->routeIs('questionnaire.index')" wire:navigate>{{ __('Questionarios') }}</flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>
            <flux:sidebar.nav variant="outline">
                <flux:navlist.group :heading="__('Seguimiento')" class="grid sidebar-heading"></flux:navlist.group>
                <flux:sidebar.group
                    expandable icon="bell-alert"
                    :expanded="
                        request()->routeIs('notification.index') ||
                        request()->routeIs('alert.index') ||
                        request()->routeIs('ticket.index')
                    "
                    :heading="__('Primordial')" class="grid">
                    <flux:sidebar.item class="!py-5 cursor-pointer! text-neutral-300! dark:text-neutral-200!" icon="bell" :href="route('notification.index')" :current="request()->routeIs('notification.index')" wire:navigate>
                        <span>{{ __('Notificaciones') }}</span>
                        @if(auth()->user()->metadata['notifications'] > 0)
                            <div class="inline rounded-sm border border-primary bg-primary/10 text-center text-xs px-2 py-0.5 ml-1">
                                {{ auth()->user()->metadata['notifications'] }}
                            </div>
                        @endif
                    </flux:sidebar.item>
                    <flux:sidebar.item class="!py-5 cursor-pointer! text-neutral-300! dark:text-neutral-200!" icon="exclamation-triangle" :href="route('alert.index')" :current="request()->routeIs('alert.index')" wire:navigate>
                        <span>{{ __('Alertas') }}</span>
                        @if(auth()->user()->metadata['alerts'] > 0)
                            <div class="inline rounded-sm border border-blue-500 bg-blue-500/10 text-center text-xs px-2 py-0.5 ml-1">
                                {{ auth()->user()->metadata['alerts'] }}
                            </div>
                        @endif
                    </flux:sidebar.item>
                    <flux:sidebar.item class="!py-5 cursor-pointer! text-neutral-300! dark:text-neutral-200!" icon="document-text" :href="route('ticket.index')" :current="request()->routeIs('ticket.index')" wire:navigate>
                        <span>{{ __('Tickets') }}</span>
                        @if(auth()->user()->metadata['tickets'] > 0)
                            <div class="inline rounded-sm border border-green-500 bg-green-500/10 text-center text-xs px-2 py-0.5 ml-1">
                                {{ auth()->user()->metadata['tickets'] }}
                            </div>
                        @endif
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav variant="outline">
                <flux:sidebar.item class="text-neutral-300! dark:text-neutral-200!" icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item class="text-neutral-300! dark:text-neutral-200!" icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:sidebar.item>
           </flux:sidebar.nav>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:sidebar.profile
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
                     <flux:link x-data x-on:click="$flux.dark = ! $flux.dark" variants="outline" class="!cursor-pointer p-2 lg:p-3 border! border-neutral-300! dark:border-neutral-600! rounded-full! flex! items-center! justify-center! bg-light-variant dark:bg-dark-variant">
                        <x-icon.sun class="size-4! lg:size-5! text-dark! dark:text-light!"/>
                    </flux:link>
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
