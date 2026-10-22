<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('careers.index')" label="Volver a carreras" />
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div data-animate="hero" data-animate-delay="0.1">
                <div class="text-xs uppercase tracking-wide text-emerald-600 font-semibold">{{ $career->academicArea?->name }}</div>
                <h2 class="display text-3xl sm:text-4xl">{{ $career->name }}</h2>
            </div>
            @auth
                <div class="flex gap-2">
                    <x-like-button :action="route('favorites.careers.toggle', $career)" :liked="$isSaved" text />
                    <form method="POST" action="{{ route('my-route.items.add') }}">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ $career->id }}">
                        <button type="submit" class="px-4 py-2 rounded-md text-sm font-medium border bg-white text-gray-700 border-gray-200 hover:bg-gray-50 dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700">
                            + Agregar a Mi Ruta
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <x-like-button guest text />

                <x-login-prompt-modal />

            @endguest
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <div class="flex items-start gap-4">
                    <x-career-icon :career="$career" size="h-14 w-14 text-3xl" />
                    <div class="min-w-0">
                        <p class="text-gray-700 dark:text-slate-300">{{ $career->description }}</p>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            @if ($career->academicArea)
                                <span class="rounded-full bg-emerald-50 px-3 py-1 font-medium text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400">🏷️ {{ $career->academicArea->name }}</span>
                            @endif
                            @if ($career->duration_text)
                                <span class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-600 dark:bg-slate-700 dark:text-slate-300">⏱️ {{ $career->duration_text }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                @if ($career->activities_list)
                    <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="mb-3 flex items-center gap-2 font-semibold text-gray-900 dark:text-slate-100"><span aria-hidden="true">🛠️</span> Lo que harías en el día a día</h3>
                        <ul class="space-y-2 text-sm text-gray-700 dark:text-slate-300">
                            @foreach ($career->activities_list as $item)
                                <li class="flex gap-2"><span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-emerald-500"></span><span>{{ $item }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($career->fields_list)
                    <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="mb-3 flex items-center gap-2 font-semibold text-gray-900 dark:text-slate-100"><span aria-hidden="true">💼</span> Dónde podrías trabajar</h3>
                        <ul class="space-y-2 text-sm text-gray-700 dark:text-slate-300">
                            @foreach ($career->fields_list as $item)
                                <li class="flex gap-2"><span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-teal-500"></span><span>{{ $item }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            @if ($career->skills_list)
                <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <h3 class="mb-3 flex items-center gap-2 font-semibold text-gray-900 dark:text-slate-100"><span aria-hidden="true">⭐</span> Habilidades que te ayudan</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($career->skills_list as $item)
                            <span class="rounded-full border border-emerald-100 bg-emerald-50 px-3 py-1 text-sm text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950/30 dark:text-emerald-400">{{ $item }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
            <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">¿Dónde puedo estudiar {{ $career->name }}?</h3>
                @forelse ($career->institutions as $institution)
                    @php $pensum = $curriculumByPivotId->get($institution->pivot->id); @endphp
                    <div data-animate="up" data-animate-group="institutions" class="py-3 border-b last:border-0 border-gray-100 dark:border-slate-700" x-data="{ open: false }">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <div class="flex items-center gap-3">
                                <x-institution-logo :institution="$institution" size="h-12 w-12" />
                                <div>
                                    <a href="{{ route('institutions.show', [$institution, 'career' => $career->slug]) }}" class="font-medium text-emerald-700 dark:text-emerald-400 hover:underline" title="{{ $institution->name }}">{{ $institution->short_name }}</a>
                                    <div class="text-sm text-gray-500 dark:text-slate-400">{{ $institution->department }}</div>
                                    @if ($institution->pivot->official_career_name)
                                        <div class="text-xs text-gray-400 dark:text-slate-500 italic">Nombre oficial: {{ $institution->pivot->official_career_name }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 capitalize">{{ $institution->pivot->modality }}</span>
                                @if ($pensum)
                                    <button type="button" @click="open = ! open" class="text-xs font-medium text-emerald-700 dark:text-emerald-400 hover:underline">
                                        <span x-text="open ? 'Ocultar pensum' : 'Ver pensum'"></span>
                                    </button>
                                @endif
                            </div>
                        </div>

                        @if ($pensum)
                            @php
                                $cycles = $pensum->groupBy('cycle_label');
                                $totalUv = $pensum->sum('credits');
                            @endphp
                            <div x-show="open" x-cloak class="mt-4">
                                <div class="mb-4 flex flex-wrap gap-2 text-xs">
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 font-medium text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400">{{ $cycles->count() }} ciclos</span>
                                    <span class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-600 dark:bg-slate-700 dark:text-slate-300">{{ $pensum->count() }} materias</span>
                                    @if ($totalUv)
                                        <span class="rounded-full bg-gray-100 px-3 py-1 font-medium text-gray-600 dark:bg-slate-700 dark:text-slate-300">{{ $totalUv }} UV</span>
                                    @endif
                                </div>

                                {{-- Ruta por ciclos: scroll horizontal con línea que conecta cada ciclo --}}
                                <div class="-mx-2 flex snap-x gap-4 overflow-x-auto px-2 pb-3">
                                    @foreach ($cycles as $cycleLabel => $items)
                                        <div class="w-56 shrink-0 snap-start">
                                            <div class="relative mb-3 flex items-center">
                                                <span class="z-10 flex h-8 w-8 items-center justify-center rounded-full bg-emerald-600 text-sm font-bold text-white shadow-sm">{{ $loop->iteration }}</span>
                                                @unless ($loop->last)
                                                    <span class="absolute left-8 right-[-1rem] h-0.5 bg-gradient-to-r from-emerald-500 to-emerald-200 dark:to-emerald-900"></span>
                                                @endunless
                                            </div>
                                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-3 dark:border-slate-700 dark:bg-slate-900/40">
                                                <div class="mb-2 flex items-baseline justify-between gap-2">
                                                    <h4 class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">{{ $cycleLabel }}</h4>
                                                    @if ($items->sum('credits'))
                                                        <span class="text-[11px] text-gray-400 dark:text-slate-500">{{ $items->sum('credits') }} UV</span>
                                                    @endif
                                                </div>
                                                <ul class="space-y-1.5">
                                                    @foreach ($items as $item)
                                                        <li class="rounded-lg border border-gray-100 bg-white px-2.5 py-1.5 text-sm text-gray-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                                            <div class="leading-snug">{{ $item->subject_name }}</div>
                                                            @if ($item->credits)
                                                                <div class="mt-1 flex items-center gap-1.5">
                                                                    <span class="h-1 flex-1 overflow-hidden rounded-full bg-gray-100 dark:bg-slate-700"><span class="block h-full rounded-full bg-emerald-500" style="width: {{ min(100, $item->credits * 12.5) }}%"></span></span>
                                                                    <span class="shrink-0 text-[11px] text-gray-400 dark:text-slate-500">{{ $item->credits }} UV</span>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-slate-400 text-sm">Aún no hay instituciones registradas para esta carrera.</p>
                @endforelse
            </div>

            @auth
                @if ($relatedCareers->isNotEmpty())
                    <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-1">Carreras relacionadas con tu perfil</h3>
                        <p class="text-sm text-gray-500 dark:text-slate-400 mb-4">Estas carreras comparten varias áreas de interés con tu perfil. Son opciones para explorar, no una recomendación única.</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($relatedCareers as $related)
                                <a href="{{ route('careers.show', $related) }}" data-animate="up" data-animate-group="related"
                                    class="card-hover block p-4 rounded-lg border border-gray-100 dark:border-slate-700 hover:border-emerald-200 dark:hover:border-emerald-700 hover:bg-emerald-50 dark:hover:bg-slate-700/50 transition">
                                    <div class="font-medium text-gray-900 dark:text-slate-100">{{ $related->name }}</div>
                                    <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-1">{{ $related->affinity_score }}% de afinidad</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div data-animate="up" class="bg-emerald-50 p-6 rounded-xl border border-emerald-100 text-sm text-emerald-800 dark:bg-emerald-950/30 dark:border-emerald-900 dark:text-emerald-300">
                    <a href="{{ route('register') }}" class="font-semibold underline">Crea una cuenta</a> y haz el cuestionario de intereses para ver qué tan afín es esta carrera a tu perfil.
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>
