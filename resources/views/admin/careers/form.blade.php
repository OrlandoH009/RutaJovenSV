<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">{{ $career->exists ? 'Editar carrera' : 'Nueva carrera' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ $career->exists ? route('admin.careers.update', $career) : route('admin.careers.store') }}" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf
                @if ($career->exists) @method('PUT') @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $career->name) }}" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        @error('name') <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Área académica</label>
                        <select name="academic_area_id" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" @selected(old('academic_area_id', $career->academic_area_id) == $area->id)>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $career->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Duración (texto)</label>
                        <input type="text" name="duration_text" value="{{ old('duration_text', $career->duration_text) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Duración (meses)</label>
                        <input type="number" name="duration_months" value="{{ old('duration_months', $career->duration_months) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Habilidades relacionadas</label>
                    <input type="text" name="skills" value="{{ old('skills', $career->skills) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Actividades típicas</label>
                    <input type="text" name="typical_activities" value="{{ old('typical_activities', $career->typical_activities) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Posibles áreas profesionales</label>
                    <input type="text" name="professional_fields" value="{{ old('professional_fields', $career->professional_fields) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div class="border-t border-gray-100 dark:border-slate-700 pt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Pesos de interés (0-100)</label>
                    <p class="text-xs text-gray-500 dark:text-slate-400 mb-3">Define qué tan relacionada está esta carrera con cada eje de interés. Déjalo en 0 si no aplica.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($interestKeys as $key => $label)
                            <div>
                                <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">{{ $label }}</label>
                                <input type="number" min="0" max="100" name="weights[{{ $key }}]" value="{{ old('weights.'.$key, $currentWeights[$key] ?? 0) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('admin.careers.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-200">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
