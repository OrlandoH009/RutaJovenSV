<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('dashboard')" label="Volver al dashboard" />
        <h2 data-animate="words" class="display text-3xl sm:text-4xl">Mis favoritos</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8">
            <section>
                <h3 class="mb-4 text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Carreras guardadas ({{ $careers->count() }})</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($careers as $career)
                        <div data-animate="up" data-animate-group="fav-careers" class="surface card-hover relative">
                            <a href="{{ route('careers.show', $career) }}" class="block h-full p-5 pr-14">
                                <div class="flex items-center gap-3">
                                    <x-career-icon :career="$career" />
                                    <div class="min-w-0">
                                        <div class="text-xs font-semibold uppercase tracking-wide text-emerald-600">{{ $career->academicArea?->name }}</div>
                                        <div class="mt-0.5 font-display text-xl text-gray-900 dark:text-slate-100">{{ $career->name }}</div>
                                    </div>
                                </div>
                            </a>
                            <x-like-button :action="route('favorites.careers.toggle', $career)" :liked="true" class="absolute right-3 top-3" />
                        </div>
                    @empty
                        <p class="col-span-full text-gray-500 dark:text-slate-400">Aún no guardas carreras. Toca el ♥ en cualquier carrera para tenerla aquí. <a href="{{ route('careers.index') }}" class="text-emerald-600 hover:underline">Explorar carreras →</a></p>
                    @endforelse
                </div>
            </section>

            <section>
                <h3 class="mb-4 text-sm font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Instituciones guardadas ({{ $institutions->count() }})</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($institutions as $institution)
                        <div data-animate="up" data-animate-group="fav-institutions" class="surface card-hover relative">
                            <a href="{{ route('institutions.show', $institution) }}" class="block h-full p-5 pr-14">
                                <div class="flex items-center gap-3">
                                    <x-institution-logo :institution="$institution" />
                                    <div class="min-w-0">
                                        <div class="text-xs font-semibold uppercase tracking-wide text-emerald-600">{{ $institution->institution_type }}</div>
                                        <div class="mt-0.5 font-display text-xl text-gray-900 dark:text-slate-100" title="{{ $institution->name }}">{{ $institution->short_name }}</div>
                                    </div>
                                </div>
                            </a>
                            <x-like-button :action="route('favorites.institutions.toggle', $institution)" :liked="true" class="absolute right-3 top-3" />
                        </div>
                    @empty
                        <p class="col-span-full text-gray-500 dark:text-slate-400">Aún no guardas instituciones. <a href="{{ route('institutions.index') }}" class="text-emerald-600 hover:underline">Ver instituciones →</a></p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
