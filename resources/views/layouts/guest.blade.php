<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('layouts.partials.theme-script')

        @include('layouts.partials.fonts')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark:text-slate-100">
        <div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-10 bg-gray-100 dark:bg-slate-900">
            <div class="dot-grid pointer-events-none absolute inset-x-0 top-0 h-[40rem]" aria-hidden="true"></div>

            <a href="/" class="relative flex items-center gap-2" data-animate="hero">
                <x-application-logo class="h-10 w-10" />
                <span class="font-display text-2xl text-gray-900 dark:text-slate-100">RutaJoven SV</span>
            </a>

            <div data-animate="hero" data-animate-delay="0.1" class="surface relative mt-6 w-full max-w-md px-6 py-6 sm:px-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
