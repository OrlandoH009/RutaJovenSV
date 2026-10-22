<footer class="mt-24 border-t border-gray-200 dark:border-slate-800">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-12 sm:px-6 md:flex-row md:justify-between lg:px-8">
        <div class="max-w-xs">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <x-application-logo class="h-8 w-8" />
                <span class="font-display text-xl text-gray-900 dark:text-slate-100">RutaJoven SV</span>
            </a>
            <p class="mt-3 text-sm text-gray-500 dark:text-slate-400">Orientación académica para jóvenes de El Salvador. Exploración, no imposición.</p>
        </div>
        <div class="grid grid-cols-2 gap-8 text-sm sm:grid-cols-3">
            <div class="space-y-2">
                <div class="font-medium text-gray-900 dark:text-slate-100">Explorar</div>
                <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('careers.index') }}">Carreras</a>
                <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('institutions.index') }}">Instituciones</a>
            </div>
            <div class="space-y-2">
                <div class="font-medium text-gray-900 dark:text-slate-100">Herramientas</div>
                <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('compare.index') }}">Comparador</a>
                <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('search.index') }}">Buscar</a>
            </div>
            <div class="space-y-2">
                <div class="font-medium text-gray-900 dark:text-slate-100">Cuenta</div>
                @auth
                    <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('login') }}">Iniciar sesión</a>
                    <a class="block text-gray-500 hover:text-emerald-600 dark:text-slate-400" href="{{ route('register') }}">Crear cuenta</a>
                @endauth
            </div>
        </div>
    </div>
    <div class="border-t border-gray-200 py-5 text-center text-xs text-gray-400 dark:border-slate-800">© {{ date('Y') }} RutaJoven SV</div>
</footer>
