<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light scroll-smooth">
    <head>
        @include('partials.head')
    </head>
    <body class="relative antialiased min-h-screen bg-light text-lg text-dark dark:bg-dark dark:text-light/90">
        {{ $slot }}
        @include('partials.foot')
    </body>
</html>
