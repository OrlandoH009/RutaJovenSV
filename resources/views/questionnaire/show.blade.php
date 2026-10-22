<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('dashboard')" label="Volver al dashboard" />
        <h2 class="display text-3xl sm:text-4xl">Cuestionario de intereses</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-gray-600 dark:text-slate-400 mb-6">
                Responde con la opción que más se acerque a lo que disfrutarías. No hay
                respuestas correctas o incorrectas: esto solo nos ayuda a mostrarte un
                perfil de intereses, no un diagnóstico.
            </p>

            <form method="POST" action="{{ route('questionnaire.store') }}"
                x-data="{
                    step: 1,
                    total: {{ $questions->count() }},
                    answers: @json($answeredIds),
                    error: false,
                    goTo(target, questionId) {
                        if (target > this.step && !this.answers[questionId]) {
                            this.error = true;
                            return;
                        }
                        this.error = false;
                        this.step = Math.min(this.total, Math.max(1, target));
                    },
                }"
                @submit="if (Object.keys(answers).length < total) { $event.preventDefault(); error = true; }">
                @csrf

                <!-- Barra de progreso -->
                <div class="mb-6">
                    <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2">
                        <div class="bg-emerald-600 dark:bg-emerald-400 h-2 rounded-full transition-all" :style="`width: ${(step / total) * 100}%`"></div>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-slate-400 mt-2">Pregunta <span x-text="step"></span> de <span x-text="total"></span></div>
                </div>

                @foreach ($questions as $index => $question)
                    <div x-show="step === {{ $index + 1 }}" x-cloak class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">{{ $question->text }}</h3>

                        <div class="space-y-2">
                            @foreach ($question->options as $option)
                                <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-slate-600 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-600 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-950/30">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                        x-model="answers[{{ $question->id }}]"
                                        @change="error = false"
                                        @checked($answeredIds->get($question->id) === $option->id)
                                        class="text-emerald-600 focus:ring-emerald-500" required>
                                    <span class="text-gray-800 dark:text-slate-200">{{ $option->text }}</span>
                                </label>
                            @endforeach
                        </div>

                        <p x-show="error && !answers[{{ $question->id }}]" x-cloak class="mt-3 text-sm text-red-600 dark:text-red-400">
                            Selecciona una opción antes de continuar. No puedes saltarte preguntas.
                        </p>

                        <div class="flex justify-between mt-6">
                            <button type="button" @click="goTo(step - 1, {{ $question->id }})" x-show="step > 1"
                                class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-slate-400 hover:text-gray-900 dark:hover:text-slate-100">
                                ← Anterior
                            </button>
                            <span x-show="step === 1"></span>

                            @if (! $loop->last)
                                <button type="button" @click="goTo(step + 1, {{ $question->id }})"
                                    class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">
                                    Siguiente →
                                </button>
                            @else
                                <button type="submit" @click="if (!answers[{{ $question->id }}]) { $event.preventDefault(); error = true; }"
                                    class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">
                                    Ver mi perfil de intereses
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
</x-app-layout>
