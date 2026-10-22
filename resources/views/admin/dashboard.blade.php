<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('home')" label="Volver al inicio" />
        <h2 class="display text-3xl sm:text-4xl">Panel administrativo</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $counts['areas'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-slate-400">Áreas académicas</div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $counts['careers'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-slate-400">Carreras</div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $counts['institutions'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-slate-400">Instituciones</div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $counts['questions'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-slate-400">Preguntas</div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $counts['users'] }}</div>
                    <div class="text-sm text-gray-500 dark:text-slate-400">Usuarios</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
