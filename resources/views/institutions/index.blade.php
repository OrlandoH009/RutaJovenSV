<x-app-layout>
    <x-slot name="header">
        <h2 data-animate="hero" class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">Instituciones educativas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" data-animate="hero" data-animate-delay="0.1" class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm mb-6 flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px] w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Buscar</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nombre de la institución..." class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 dark:placeholder:text-slate-500 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>
                <div class="min-w-[180px] w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Departamento</label>
                    <select name="department" class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Todos</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department }}" @selected(request('department') == $department)>{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="min-w-[180px] w-full sm:w-auto">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Modalidad</label>
                    <select name="modality" class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Todas</option>
                        <option value="presencial" @selected(request('modality') == 'presencial')>Presencial</option>
                        <option value="virtual" @selected(request('modality') == 'virtual')>Virtual</option>
                        <option value="mixta" @selected(request('modality') == 'mixta')>Mixta</option>
                    </select>
                </div>
                <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Filtrar</button>
                @if (request('q') || request('department') || request('modality'))
                    <a href="{{ route('institutions.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-300">Limpiar filtros</a>
                @endif
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($institutions as $institution)
                    <a href="{{ route('institutions.show', $institution) }}" data-animate="up" data-animate-group="institutions"
                        class="card-hover block p-5 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm hover:border-emerald-200 dark:hover:border-emerald-700 transition">
                        <div class="font-semibold text-gray-900 dark:text-slate-100">{{ $institution->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">{{ $institution->institution_type }} · {{ $institution->department }}</div>
                        <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-3">{{ $institution->careers_count }} carreras registradas</div>
                    </a>
                @empty
                    <p class="text-gray-500 dark:text-slate-400 col-span-full">No se encontraron instituciones con esos filtros.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $institutions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
