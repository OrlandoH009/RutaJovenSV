<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('dashboard')" label="Volver al dashboard" />
        <h2 class="display text-3xl sm:text-4xl">Tu perfil de intereses</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <x-flash-success :message="session('status')" />
            @endif

            @if (! $profile)
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm text-center">
                    <p class="text-gray-600 dark:text-slate-400 mb-4">Aún no has completado el cuestionario de intereses.</p>
                    <a href="{{ route('questionnaire.show') }}" class="inline-flex items-center px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">
                        Hacer el cuestionario
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div class="space-y-4">
                        @foreach ($profile->scores as $key => $score)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-gray-700 dark:text-slate-300">{{ $labels[$key] ?? $key }}</span>
                                    <span class="text-gray-500 dark:text-slate-400">{{ $score }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-3">
                                    <div class="bg-emerald-500 dark:bg-emerald-400 h-3 rounded-full" style="width: {{ $score }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p class="text-gray-700 dark:text-slate-300 mt-6 border-t border-gray-100 dark:border-slate-700 pt-4">{{ $explanation }}</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('questionnaire.show') }}" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline">Volver a responder el cuestionario</a>
                </div>

                @if ($relatedCareers->isNotEmpty())
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-1">Carreras para explorar</h3>
                        <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">Estas carreras comparten varias áreas de interés con tu perfil. Explóralas, compáralas y decide con calma — la decisión es tuya.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($relatedCareers as $career)
                                <a href="{{ route('careers.show', $career) }}" class="block p-4 rounded-lg border border-gray-100 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-700 hover:bg-emerald-50 dark:hover:bg-slate-700/50 transition">
                                    <div class="font-medium text-gray-900 dark:text-slate-100">{{ $career->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-slate-400">{{ $career->academicArea?->name }}</div>
                                    <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-1">{{ $career->affinity_score }}% de afinidad</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
