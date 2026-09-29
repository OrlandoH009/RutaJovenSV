<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hola, {{ auth()->user()->name }} 👋</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-emerald-50 text-emerald-800 rounded-lg text-sm">{{ session('status') }}</div>
            @endif

            @unless ($questionnaireComplete)
                <div class="bg-emerald-600 text-white p-6 rounded-xl flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="font-semibold text-lg">Completa tu cuestionario de intereses</h3>
                        <p class="text-emerald-50 text-sm mt-1">Has respondido {{ $answeredQuestions }} de {{ $totalQuestions }} preguntas.</p>
                    </div>
                    <a href="{{ route('questionnaire.show') }}" class="px-5 py-2 bg-white text-emerald-700 rounded-md font-semibold hover:bg-emerald-50">
                        Continuar
                    </a>
                </div>
            @endunless

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900">Tu perfil de intereses</h3>
                            <a href="{{ route('interest-profile.show') }}" class="text-sm text-emerald-700 hover:underline">Ver completo</a>
                        </div>

                        @if ($profile)
                            <div class="space-y-3">
                                @foreach (array_slice($profile->scores, 0, 4, true) as $key => $score)
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-gray-700">{{ $labels[$key] ?? $key }}</span>
                                            <span class="text-gray-500">{{ $score }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                                            <div class="bg-emerald-500 h-2.5 rounded-full" style="width: {{ $score }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Aún no tienes un perfil de intereses. Completa el cuestionario para generarlo.</p>
                        @endif
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900">Carreras guardadas</h3>
                            <a href="{{ route('careers.index') }}" class="text-sm text-emerald-700 hover:underline">Explorar más</a>
                        </div>

                        @forelse ($savedCareers as $saved)
                            <a href="{{ route('careers.show', $saved->career) }}" class="flex items-center justify-between py-2 border-b last:border-0 border-gray-50">
                                <span class="text-gray-800">{{ $saved->career->name }}</span>
                                <span class="text-xs text-gray-400">{{ $saved->career->academicArea?->name }}</span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">No has guardado carreras todavía.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <h3 class="font-semibold text-gray-900 mb-4">Resumen</h3>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Carreras guardadas</dt>
                                <dd class="font-medium text-gray-900">{{ $savedCareersCount }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Instituciones guardadas</dt>
                                <dd class="font-medium text-gray-900">{{ $savedInstitutionsCount }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Objetivo en Mi Ruta</dt>
                                <dd class="font-medium text-gray-900 text-right">{{ $route?->goal_text ?? 'Sin definir' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-2">
                        <h3 class="font-semibold text-gray-900 mb-2">Próximos pasos</h3>
                        <a href="{{ route('my-route.show') }}" class="block text-sm text-emerald-700 hover:underline">→ Gestionar Mi Ruta</a>
                        <a href="{{ route('compare.index') }}" class="block text-sm text-emerald-700 hover:underline">→ Comparar carreras</a>
                        <a href="{{ route('cost-simulator.show') }}" class="block text-sm text-emerald-700 hover:underline">→ Simular costos</a>
                        <a href="{{ route('institutions.index') }}" class="block text-sm text-emerald-700 hover:underline">→ Explorar instituciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
