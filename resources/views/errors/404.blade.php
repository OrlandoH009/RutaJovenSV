<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Página no encontrada - {{ config('app.name', 'RutaJoven SV') }}</title>

        @include('layouts.partials.theme-script')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-slate-100 antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-gray-50 dark:bg-slate-900 px-6 py-12">
            <div data-float class="blob w-72 h-72 bg-emerald-300 -top-16 -left-16"></div>
            <div data-float class="blob w-72 h-72 bg-teal-300 bottom-0 right-0"></div>

            <div class="relative z-10 w-full max-w-lg text-center">
                <a href="/" class="inline-block mb-8" data-animate="hero">
                    <x-application-logo class="w-16 h-16 fill-current text-emerald-600 dark:text-emerald-400 mx-auto" />
                </a>

                <p data-animate="hero" data-animate-delay="0.1" class="text-gradient text-7xl sm:text-8xl font-extrabold tracking-tight">
                    404
                </p>

                <h1 data-animate="hero" data-animate-delay="0.2" class="mt-4 text-2xl sm:text-3xl font-semibold text-gray-900 dark:text-slate-100">
                    No encontramos esta página
                </h1>

                <p data-animate="hero" data-animate-delay="0.3" class="mt-3 text-gray-500 dark:text-slate-400">
                    Es posible que el enlace esté roto o que la página se haya movido. Vuelve al inicio o explora las carreras disponibles.
                </p>

                <div data-animate="hero" data-animate-delay="0.4" class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a
                        href="{{ url('/') }}"
                        class="w-full sm:w-auto px-6 py-3 rounded-md font-semibold text-white bg-emerald-600 transition duration-300 hover:bg-emerald-700 hover:-translate-y-0.5 hover:shadow-lg"
                    >
                        Volver al inicio
                    </a>
                    <a
                        href="{{ route('careers.index') }}"
                        class="w-full sm:w-auto px-6 py-3 rounded-md font-semibold text-emerald-700 dark:text-emerald-400 bg-white dark:bg-slate-800 border border-emerald-200 dark:border-emerald-800 transition duration-300 hover:bg-emerald-50 dark:hover:bg-emerald-950/30 hover:-translate-y-0.5"
                    >
                        Explorar carreras
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
