<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">Hola, {{ auth()->user()->name }} 👋</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div data-animate="hero" class="p-4 bg-emerald-50 text-emerald-800 dark:bg-emerald-950/30 dark:text-emerald-300 rounded-lg text-sm">{{ session('status') }}</div>
            @endif

            @unless ($questionnaireComplete)
                <div data-animate="hero" class="cta-glow bg-emerald-600 text-white p-6 rounded-xl flex items-center justify-between flex-wrap gap-4">
                    <div class="relative z-10">
                        <h3 class="font-semibold text-lg">Completa tu cuestionario de intereses</h3>
                        <p class="text-emerald-50 text-sm mt-1">Has respondido {{ $answeredQuestions }} de {{ $totalQuestions }} preguntas.</p>
                    </div>
                    <a href="{{ route('questionnaire.show') }}" class="relative z-10 px-5 py-2 bg-white text-emerald-700 rounded-md font-semibold transition duration-300 hover:bg-emerald-50 hover:scale-105 hover:shadow-lg">
                        Continuar
                    </a>
                </div>
            @endunless

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div data-animate="up" data-animate-group="dashboard-cards" class="card-hover bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900 dark:text-slate-100">Tu perfil de intereses</h3>
                            <a href="{{ route('interest-profile.show') }}" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline">Ver completo</a>
                        </div>

                        @if ($profile)
                            <div class="space-y-3">
                                @foreach (array_slice($profile->scores, 0, 4, true) as $key => $score)
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-gray-700 dark:text-slate-300">{{ $labels[$key] ?? $key }}</span>
                                            <span class="text-gray-500 dark:text-slate-400"><span data-counter="{{ $score }}" data-counter-suffix="%">0%</span></span>
                                        </div>
                                        <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                            <div data-bar="{{ $score }}" class="bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-400 h-2.5 rounded-full" style="width: 0%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 dark:text-slate-400">Aún no tienes un perfil de intereses. Completa el cuestionario para generarlo.</p>
                        @endif
                    </div>

                    <div data-animate="up" data-animate-group="dashboard-cards" class="card-hover bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-900 dark:text-slate-100">Carreras guardadas</h3>
                            <a href="{{ route('careers.index') }}" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline">Explorar más</a>
                        </div>

                        @forelse ($savedCareers as $saved)
                            <a href="{{ route('careers.show', $saved->career) }}" class="flex items-center justify-between flex-wrap gap-1 py-2 border-b last:border-0 border-gray-50 dark:border-slate-700/60 transition-colors duration-200 hover:bg-emerald-50/60 dark:hover:bg-emerald-950/20 hover:px-2 rounded-md">
                                <span class="text-gray-800 dark:text-slate-200">{{ $saved->career->name }}</span>
                                <span class="text-xs text-gray-400 dark:text-slate-500">{{ $saved->career->academicArea?->name }}</span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-slate-400">No has guardado carreras todavía.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-6">
                    <div data-animate="up" data-animate-group="dashboard-cards" class="card-hover bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">Resumen</h3>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-gray-500 dark:text-slate-400">Carreras guardadas</dt>
                                <dd class="font-medium text-gray-900 dark:text-slate-100"><span data-counter="{{ $savedCareersCount }}">0</span></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500 dark:text-slate-400">Instituciones guardadas</dt>
                                <dd class="font-medium text-gray-900 dark:text-slate-100"><span data-counter="{{ $savedInstitutionsCount }}">0</span></dd>
                            </div>
                            <div class="flex justify-between gap-2">
                                <dt class="text-gray-500 dark:text-slate-400">Objetivo en Mi Ruta</dt>
                                <dd class="font-medium text-gray-900 dark:text-slate-100 text-right">{{ $route?->goal_text ?? 'Sin definir' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div data-animate="up" data-animate-group="dashboard-cards" class="card-hover bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-2">Próximos pasos</h3>
                        <a href="{{ route('my-route.show') }}" class="group flex items-center text-sm text-emerald-700 dark:text-emerald-400 hover:underline"><span class="mr-1 transition-transform duration-200 group-hover:translate-x-1">→</span> Gestionar Mi Ruta</a>
                        <a href="{{ route('compare.index') }}" class="group flex items-center text-sm text-emerald-700 dark:text-emerald-400 hover:underline"><span class="mr-1 transition-transform duration-200 group-hover:translate-x-1">→</span> Comparar carreras</a>
                        <a href="{{ route('cost-simulator.show') }}" class="group flex items-center text-sm text-emerald-700 dark:text-emerald-400 hover:underline"><span class="mr-1 transition-transform duration-200 group-hover:translate-x-1">→</span> Simular costos</a>
                        <a href="{{ route('institutions.index') }}" class="group flex items-center text-sm text-emerald-700 dark:text-emerald-400 hover:underline"><span class="mr-1 transition-transform duration-200 group-hover:translate-x-1">→</span> Explorar instituciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
