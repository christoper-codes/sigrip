<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light scroll-smooth">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-light text-dark dark:bg-dark dark:text-light text-base md:text-lg">
        {{ $slot }}
        @include('partials.foot')
    </body>
</html>
