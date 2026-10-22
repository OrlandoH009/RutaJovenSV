<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.questions.index')" label="Volver a preguntas" />
        <h2 class="display text-3xl sm:text-4xl">{{ $question->exists ? 'Editar pregunta' : 'Nueva pregunta' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <x-flash-success :message="session('status')" />
            @endif

            <form method="POST" action="{{ $question->exists ? route('admin.questions.update', $question) : route('admin.questions.store') }}" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf
                @if ($question->exists) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Texto de la pregunta</label>
                    <input type="text" name="text" value="{{ old('text', $question->text) }}" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    @error('text') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Orden</label>
                    <input type="number" name="order" value="{{ old('order', $question->order ?? 0) }}" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('admin.questions.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-200">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
                </div>
            </form>

            @if ($question->exists)
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">Opciones de respuesta</h3>

                    @forelse ($question->options as $option)
                        <div class="flex flex-wrap items-center justify-between gap-2 py-2 border-b last:border-0 border-gray-50 dark:border-slate-700">
                            <div>
                                <span class="text-gray-800 dark:text-slate-100">{{ $option->text }}</span>
                                <span class="text-xs text-gray-400 dark:text-slate-500 ml-2">
                                    {{ collect($option->interest_weights)->map(fn ($w, $k) => "$k: $w")->implode(', ') }}
                                </span>
                            </div>
                            <form method="POST" action="{{ route('admin.questions.options.remove', [$question, $option]) }}" data-confirm="¿Eliminar esta opción?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Eliminar</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-slate-400">Aún no hay opciones para esta pregunta.</p>
                    @endforelse

                    <form method="POST" action="{{ route('admin.questions.options.add', $question) }}" class="mt-4 space-y-3 border-t border-gray-100 dark:border-slate-700 pt-4">
                        @csrf
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Texto de la opción</label>
                            <input type="text" name="text" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Orden</label>
                            <input type="number" name="order" value="0" class="w-full sm:w-32 rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-2">Pesos por eje de interés (0-10 sugerido)</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach (config('interests.labels') as $key => $label)
                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-slate-400 mb-1">{{ $label }}</label>
                                        <input type="number" min="0" max="10" name="weights[{{ $key }}]" value="0" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Agregar opción</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
