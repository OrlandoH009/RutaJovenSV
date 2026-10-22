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
    <body class="font-sans antialiased">
        <div class="relative min-h-screen bg-gray-100 dark:bg-slate-900">
            <div class="dot-grid pointer-events-none absolute inset-x-0 top-0 h-[40rem]" aria-hidden="true"></div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="relative">
                    <div class="max-w-7xl mx-auto pt-10 pb-2 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative">
                {{ $slot }}
            </main>

            @include('layouts.partials.footer')

            <x-confirm-modal />
        </div>
    </body>
</html>
