<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.institutions.index')" label="Volver a instituciones" />
        <h2 class="display text-3xl sm:text-4xl">{{ $institution->exists ? 'Editar institución' : 'Nueva institución' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <x-flash-success :message="session('status')" />
            @endif

            <form method="POST" action="{{ $institution->exists ? route('admin.institutions.update', $institution) : route('admin.institutions.store') }}" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf
                @if ($institution->exists) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $institution->name) }}" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    @error('name') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Departamento</label>
                        <input type="text" name="department" value="{{ old('department', $institution->department) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Municipio</label>
                        <input type="text" name="municipality" value="{{ old('municipality', $institution->municipality) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Campus de (opcional)</label>
                    <select name="parent_id" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">— Es una universidad principal —</option>
                        @foreach (\App\Models\Institution::whereNull('parent_id')->where('id', '!=', $institution->id ?? 0)->orderBy('name')->get() as $parentOption)
                            <option value="{{ $parentOption->id }}" @selected(old('parent_id', $institution->parent_id) == $parentOption->id)>{{ $parentOption->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Tipo de institución</label>
                        <input type="text" name="institution_type" value="{{ old('institution_type', $institution->institution_type) }}" placeholder="Ej. Universidad pública" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Sitio web</label>
                        <input type="url" name="website" value="{{ old('website', $institution->website) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Coordenadas (para el mapa)</label>
                    <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">Opcional. En Google Maps o OpenStreetMap, clic derecho sobre el punto exacto → copiar las coordenadas.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="number" step="0.0000001" name="latitude" value="{{ old('latitude', $institution->latitude) }}" placeholder="Latitud, ej. 13.6929"
                            class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <input type="number" step="0.0000001" name="longitude" value="{{ old('longitude', $institution->longitude) }}" placeholder="Longitud, ej. -89.2182"
                            class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    @error('latitude') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                    @error('longitude') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('admin.institutions.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-200">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
                </div>
            </form>

            @if ($institution->exists)
                <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">Carreras vinculadas</h3>

                    @forelse ($institution->careers as $career)
                        <div class="flex flex-wrap items-center justify-between gap-2 py-2 border-b last:border-0 border-gray-50 dark:border-slate-700">
                            <div>
                                <span class="text-gray-800 dark:text-slate-100">{{ $career->name }}</span>
                                <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 ml-2 capitalize">{{ $career->pivot->modality }}</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.institutions.curriculum.edit', [$institution, $career->pivot->id]) }}" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline">Ver pensum</a>
                                <form method="POST" action="{{ route('admin.institutions.careers.remove', [$institution, $career]) }}" data-confirm="¿Quitar esta carrera de la institución?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Quitar</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-slate-400">Aún no hay carreras vinculadas.</p>
                    @endforelse

                    <form method="POST" action="{{ route('admin.institutions.careers.add', $institution) }}" class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 items-end border-t border-gray-100 dark:border-slate-700 pt-4">
                        @csrf
                        <div class="sm:col-span-2">
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Carrera</label>
                            <select name="career_id" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @foreach ($availableCareers as $career)
                                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Modalidad</label>
                            <select name="modality" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="presencial">Presencial</option>
                                <option value="virtual">Virtual</option>
                                <option value="mixta">Mixta</option>
                            </select>
                        </div>
                        <div class="sm:col-span-3">
                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Vincular carrera</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
