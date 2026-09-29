<x-app-layout>
    <x-slot name="header">
        <h2 data-animate="hero" class="font-semibold text-xl text-gray-800 leading-tight">Buscar</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" data-animate="hero" data-animate-delay="0.1" class="mb-8">
                <input type="text" name="q" value="{{ $query }}" placeholder="Buscar carreras o instituciones..." autofocus
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-lg py-3">
            </form>

            @if ($query !== '')
                <div class="space-y-8">
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Carreras</h3>
                        @forelse ($careers as $career)
                            <a href="{{ route('careers.show', $career) }}" data-animate="up" data-animate-group="career-results"
                                class="card-hover block p-4 bg-white rounded-lg border border-gray-100 mb-2 hover:border-emerald-200">
                                <div class="font-medium text-gray-900">{{ $career->name }}</div>
                                <div class="text-sm text-gray-500">{{ $career->academicArea?->name }}</div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Sin resultados en carreras.</p>
                        @endforelse
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Instituciones</h3>
                        @forelse ($institutions as $institution)
                            <a href="{{ route('institutions.show', $institution) }}" data-animate="up" data-animate-group="institution-results"
                                class="card-hover block p-4 bg-white rounded-lg border border-gray-100 mb-2 hover:border-emerald-200">
                                <div class="font-medium text-gray-900">{{ $institution->name }}</div>
                                <div class="text-sm text-gray-500">{{ $institution->department }}</div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Sin resultados en instituciones.</p>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
