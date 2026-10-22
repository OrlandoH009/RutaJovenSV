<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.institutions.edit', $institution)" label="Volver a {{ $institution->name }}" />
        <h2 class="display text-3xl sm:text-4xl">
            Pensum · {{ $institutionCareer->career->name }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">{{ $institution->name }} · <span class="capitalize">{{ $institutionCareer->modality }}</span></p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <x-flash-success :message="session('status')" />
            @endif

            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-1">Nombre oficial de la carrera en esta institución</h3>
                <p class="text-xs text-gray-500 dark:text-slate-400 mb-3">Opcional. Úsalo cuando la universidad llama a esta carrera de forma distinta al nombre genérico del catálogo (ej. "Ingeniería en Sistemas" en el catálogo, pero la universidad la llama "Ingeniería de Sistemas Informáticos").</p>
                <form method="POST" action="{{ route('admin.institutions.curriculum.update-name', [$institution, $institutionCareer]) }}" class="flex flex-wrap gap-2">
                    @csrf
                    @method('PUT')
                    <input type="text" name="official_career_name" value="{{ $institutionCareer->official_career_name }}" placeholder="Ej. Ingeniería de Sistemas Informáticos" class="flex-1 min-w-[200px] rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">Guardar</button>
                </form>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">Materias del pensum</h3>

                @forelse ($institutionCareer->curriculumItems->groupBy('cycle_label') as $cycleLabel => $items)
                    <div class="mb-4 last:mb-0">
                        <h4 class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-slate-500 mb-2">{{ $cycleLabel }}</h4>
                        @foreach ($items as $item)
                            <div class="flex flex-wrap items-center justify-between gap-2 py-2 border-b last:border-0 border-gray-50 dark:border-slate-700">
                                <div>
                                    <span class="text-gray-800 dark:text-slate-100">{{ $item->subject_name }}</span>
                                    @if ($item->subject_code)
                                        <span class="text-xs text-gray-400 dark:text-slate-500 ml-2">{{ $item->subject_code }}</span>
                                    @endif
                                    @if ($item->credits)
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 ml-2">{{ $item->credits }} UV</span>
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('admin.institutions.curriculum.items.destroy', [$institution, $institutionCareer, $item]) }}" data-confirm="¿Eliminar esta materia del pensum?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Eliminar</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-slate-400">Aún no hay materias registradas para este pensum.</p>
                @endforelse

                <form method="POST" action="{{ route('admin.institutions.curriculum.items.store', [$institution, $institutionCareer]) }}" class="mt-4 space-y-3 border-t border-gray-100 dark:border-slate-700 pt-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Ciclo / Año</label>
                            <input type="text" name="cycle_label" placeholder="Ej. Ciclo I" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Número de ciclo (para ordenar)</label>
                            <input type="number" name="cycle_number" min="0" max="20" placeholder="Ej. 1" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Materia</label>
                        <input type="text" name="subject_name" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Código (opcional)</label>
                            <input type="text" name="subject_code" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 dark:text-slate-400 mb-1">Unidades valorativas (opcional)</label>
                            <input type="number" name="credits" min="0" max="99" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Agregar materia</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
