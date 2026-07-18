<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-light dark:bg-dark">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-20 text-white lg:flex">
                <div class="absolute inset-0 rounded-3xl m-5 overflow-hidden border border-neutral-900">
                    <video
                        src="{{ asset('videos/auth.mp4') }}"
                        autoplay
                        loop
                        muted
                        playsinline
                        class="absolute inset-0 w-full h-full object-cover"
                    ></video>
                    <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.9));"></div>
                </div>
                <div class="relative z-20 flex items-center">
                    <div class="flex items-center gap-2">
                            <button
                                x-data
                                x-on:click="$flux.dark = !$flux.dark"
                                class="w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                                :class="scrolled ? 'liquid-glass' : 'liquid-glass-fixed'"
                                aria-label="Cambiar tema"
                                >
                                <svg x-show="$flux.dark" class="w-3.5 h-3.5" :class="scrolled ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                                </svg>
                                <svg x-show="!$flux.dark" class="w-3.5 h-3.5" :class="scrolled ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </button>
                            <span class="font-light text-sm tracking-[0.2em] uppercase select-none" :class="scrolled ? 'text-white' : 'text-dark dark:text-dark'">
                                Sigrip
                            </span>
                        </div>
                </div>

                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative z-20 mt-auto ">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg" class="!text-white">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><flux:heading class="!text-white opacity-70">{{ trim($author) }}</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <div class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden">
                       <div class="flex items-center gap-2">
                            <button
                                x-data
                                x-on:click="$flux.dark = !$flux.dark"
                                class="w-9 h-9 rounded-full flex items-center justify-center select-none cursor-pointer active:scale-[0.97] transition-transform duration-200 ease-out"
                                :class="scrolled ? 'liquid-glass' : 'liquid-glass-fixed'"
                                aria-label="Cambiar tema"
                                >
                                <svg x-show="$flux.dark" class="w-3.5 h-3.5" :class="scrolled ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                                </svg>
                                <svg x-show="!$flux.dark" class="w-3.5 h-3.5" :class="scrolled ? 'text-white' : 'text-black'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </button>
                            <span class="font-light text-sm tracking-[0.2em] uppercase select-none" :class="scrolled ? 'text-white' : 'text-dark dark:text-dark'">
                                Sigrip
                            </span>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
