<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('careers.index')" label="Volver a carreras" />
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div data-animate="hero" data-animate-delay="0.1">
                <div class="text-xs uppercase tracking-wide text-emerald-600 font-semibold">{{ $career->academicArea?->name }}</div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $career->name }}</h2>
            </div>
            @auth
                <div class="flex gap-2">
                    <form method="POST" action="{{ route('favorites.careers.toggle', $career) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium border {{ $isSaved ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-emerald-700 border-emerald-200 hover:bg-emerald-50' }}">
                            {{ $isSaved ? '★ Guardada' : '☆ Guardar' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('my-route.items.add') }}">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ $career->id }}">
                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium border bg-white text-gray-700 border-gray-200 hover:bg-gray-50">
                            + Agregar a Mi Ruta
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div data-animate="up" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                <p class="text-gray-700">{{ $career->description }}</p>

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 text-sm">
                    @if ($career->duration_text)
                        <div>
                            <dt class="font-medium text-gray-500">Duración aproximada</dt>
                            <dd class="text-gray-900">{{ $career->duration_text }}</dd>
                        </div>
                    @endif
                    @if ($career->skills)
                        <div>
                            <dt class="font-medium text-gray-500">Habilidades relacionadas</dt>
                            <dd class="text-gray-900">{{ $career->skills }}</dd>
                        </div>
                    @endif
                    @if ($career->typical_activities)
                        <div>
                            <dt class="font-medium text-gray-500">Actividades típicas</dt>
                            <dd class="text-gray-900">{{ $career->typical_activities }}</dd>
                        </div>
                    @endif
                    @if ($career->professional_fields)
                        <div>
                            <dt class="font-medium text-gray-500">Posibles áreas profesionales</dt>
                            <dd class="text-gray-900">{{ $career->professional_fields }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div data-animate="up" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                <h3 class="font-semibold text-gray-900 mb-4">¿Dónde puedo estudiar {{ $career->name }}?</h3>
                @forelse ($career->institutions as $institution)
                    <div data-animate="up" data-animate-group="institutions" class="flex items-center justify-between py-3 border-b last:border-0 border-gray-100">
                        <div>
                            <a href="{{ route('institutions.show', $institution) }}" class="font-medium text-emerald-700 hover:underline">{{ $institution->name }}</a>
                            <div class="text-sm text-gray-500">{{ $institution->department }}</div>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 capitalize">{{ $institution->pivot->modality }}</span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Aún no hay instituciones registradas para esta carrera.</p>
                @endforelse
            </div>

            @auth
                @if ($relatedCareers->isNotEmpty())
                    <div data-animate="up" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <h3 class="font-semibold text-gray-900 mb-1">Carreras relacionadas con tu perfil</h3>
                        <p class="text-sm text-gray-500 mb-4">Estas carreras comparten varias áreas de interés con tu perfil. Son opciones para explorar, no una recomendación única.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($relatedCareers as $related)
                                <a href="{{ route('careers.show', $related) }}" data-animate="up" data-animate-group="related"
                                    class="card-hover block p-4 rounded-lg border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50 transition">
                                    <div class="font-medium text-gray-900">{{ $related->name }}</div>
                                    <div class="text-xs text-emerald-600 mt-1">{{ $related->affinity_score }}% de afinidad</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div data-animate="up" class="bg-emerald-50 p-6 rounded-xl border border-emerald-100 text-sm text-emerald-800">
                    <a href="{{ route('register') }}" class="font-semibold underline">Crea una cuenta</a> y haz el cuestionario de intereses para ver qué tan afín es esta carrera a tu perfil.
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
