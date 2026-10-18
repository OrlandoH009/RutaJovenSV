<x-app-layout>
    <x-slot name="header">
        <h2 data-animate="hero" class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">Explorar carreras</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" data-animate="hero" data-animate-delay="0.1" class="bg-white dark:bg-slate-800 dark:border-slate-700 p-4 rounded-xl border border-gray-100 shadow-sm mb-6 flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Buscar</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nombre de la carrera..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-slate-900 dark:border-slate-600 dark:text-slate-100">
                </div>
                <div class="min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Área académica</label>
                    <select name="area" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-slate-900 dark:border-slate-600 dark:text-slate-100">
                        <option value="">Todas</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" @selected(request('area') == $area->id)>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Filtrar</button>
                @if (request('q') || request('area'))
                    <a href="{{ route('careers.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-200">Limpiar filtros</a>
                @endif
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($careers as $career)
                    <a href="{{ route('careers.show', $career) }}" data-animate="up" data-animate-group="careers"
                        class="card-hover block p-5 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm hover:border-emerald-200 dark:hover:border-emerald-700 transition">
                        <div class="text-xs uppercase tracking-wide text-emerald-600 dark:text-emerald-400 font-semibold">{{ $career->academicArea?->name }}</div>
                        <div class="font-semibold text-gray-900 dark:text-slate-100 mt-1">{{ $career->name }}</div>
                        <p class="text-sm text-gray-500 dark:text-slate-400 mt-2 line-clamp-2">{{ $career->description }}</p>
                        @if ($career->duration_text)
                            <div class="text-xs text-gray-400 dark:text-slate-500 mt-3">Duración: {{ $career->duration_text }}</div>
                        @endif
                    </a>
                @empty
                    <p class="text-gray-500 dark:text-slate-400 col-span-full">No se encontraron carreras con esos filtros.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $careers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
