<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel administrativo</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600">{{ $counts['areas'] }}</div>
                    <div class="text-sm text-gray-500">Áreas académicas</div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600">{{ $counts['careers'] }}</div>
                    <div class="text-sm text-gray-500">Carreras</div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600">{{ $counts['institutions'] }}</div>
                    <div class="text-sm text-gray-500">Instituciones</div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600">{{ $counts['questions'] }}</div>
                    <div class="text-sm text-gray-500">Preguntas</div>
                </div>
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm text-center">
                    <div class="text-2xl font-bold text-emerald-600">{{ $counts['users'] }}</div>
                    <div class="text-sm text-gray-500">Usuarios</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
