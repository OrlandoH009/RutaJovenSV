<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('institutions.index')" label="Volver a instituciones" />
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div data-animate="hero" data-animate-delay="0.1" class="flex items-center gap-4">
                <x-institution-logo :institution="$institution" size="h-20 w-20" />
                <div>
                    <div class="text-xs uppercase tracking-wide text-emerald-600 dark:text-emerald-400 font-semibold">{{ $institution->institution_type }}</div>
                    <h2 class="display text-3xl sm:text-4xl">{{ $institution->name }}</h2>
                </div>
            </div>
            @auth
                <x-like-button :action="route('favorites.institutions.toggle', $institution)" :liked="$isSaved" text data-animate="hero" data-animate-delay="0.2" />
            @endauth

            @guest
                <x-like-button guest text />

                <x-login-prompt-modal />

            @endguest
        </div>
    </x-slot>

    <div class="py-8">
        <div
            x-data="{ campus: {{ $selectedCampusId }}, campuses: @js($campuses->map(fn ($c) => ['id' => $c->id, 'lat' => $c->latitude, 'lng' => $c->longitude])->values()) }"
            x-init="$nextTick(() => window.initInstitutionMap?.($data)); $watch('campus', () => window.focusInstitutionMap?.($data))"
            class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6"
        >
            @if ($focusCareer)
                <div data-animate="up" class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 dark:border-emerald-900 dark:bg-emerald-950/30">
                    <div class="flex items-center gap-3">
                        <x-career-icon :career="$focusCareer" />
                        <div class="text-sm text-gray-700 dark:text-slate-300">Mostrando solo <a href="{{ route('careers.show', $focusCareer) }}" class="font-semibold text-emerald-700 hover:underline dark:text-emerald-400">{{ $focusCareer->name }}</a> en esta universidad</div>
                    </div>
                    <a href="{{ route('institutions.show', $institution) }}" class="text-sm font-medium text-emerald-700 hover:underline dark:text-emerald-400">Ver todas las carreras →</a>
                </div>
            @endif

            @if ($campuses->count() > 1)
                <div data-animate="up" class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Elige un campus</div>
                    <div class="flex flex-wrap gap-2" role="tablist">
                        @foreach ($campuses as $c)
                            <button type="button" role="tab" @click="campus = {{ $c->id }}" :aria-selected="(campus === {{ $c->id }}).toString()"
                                :class="campus === {{ $c->id }} ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-slate-300 border-gray-200 dark:border-slate-600 hover:border-emerald-300 dark:hover:border-emerald-600'"
                                class="inline-flex items-center gap-1.5 rounded-full border px-4 py-1.5 text-sm font-medium transition">
                                <span aria-hidden="true">📍</span>{{ $c->campus_label }}
                                @if ($c->id === $institution->id)<span class="text-[11px] opacity-70">· Sede principal</span>@endif
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            @foreach ($campuses as $c)
                <div x-show="campus === {{ $c->id }}" @unless ($c->id === $selectedCampusId) x-cloak @endunless class="space-y-6">
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            @if ($campuses->count() > 1)
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-slate-400">Campus</dt>
                                    <dd class="text-gray-900 dark:text-slate-100">{{ $c->name }}</dd>
                                </div>
                            @endif
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-slate-400">Ubicación</dt>
                                <dd class="text-gray-900 dark:text-slate-100">{{ $c->municipality }}, {{ $c->department }}</dd>
                            </div>
                            @if ($c->website ?? $institution->website)
                                <div>
                                    <dt class="font-medium text-gray-500 dark:text-slate-400">Sitio web</dt>
                                    <dd><a href="{{ $c->website ?? $institution->website }}" target="_blank" rel="noopener" class="text-emerald-700 dark:text-emerald-400 hover:underline break-all">{{ $c->website ?? $institution->website }}</a></dd>
                                </div>
                            @endif
                            @if ($c->latitude && $c->longitude)
                                <div class="sm:col-span-2">
                                    <a href="https://www.openstreetmap.org/?mlat={{ $c->latitude }}&mlon={{ $c->longitude }}#map=16/{{ $c->latitude }}/{{ $c->longitude }}" target="_blank" rel="noopener" class="text-xs font-medium text-emerald-700 dark:text-emerald-400 hover:underline">Abrir mapa completo ↗</a>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                        <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">{{ $focusCareer ? 'Carrera disponible' : 'Carreras que ofrece' }}{{ $campuses->count() > 1 ? ' en '.$c->campus_label : '' }}</h3>
                        @forelse ($c->careers as $career)
                            <div class="flex items-center justify-between gap-3 py-3 border-b last:border-0 border-gray-100 dark:border-slate-700">
                                <div class="flex items-center gap-3">
                                    <x-career-icon :career="$career" size="h-10 w-10 text-xl" />
                                    <div>
                                        <a href="{{ route('careers.show', $career) }}" class="font-medium text-emerald-700 dark:text-emerald-400 hover:underline">{{ $career->name }}</a>
                                        <div class="text-sm text-gray-500 dark:text-slate-400">{{ $career->academicArea?->name }}</div>
                                    </div>
                                </div>
                                <span class="shrink-0 text-xs px-2 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 capitalize">{{ $career->pivot->modality }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-slate-400 text-sm">Aún no hay carreras registradas para este campus.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach

            {{-- Un solo mapa: se centra en el campus elegido --}}
            @if ($campuses->contains(fn ($c) => $c->latitude && $c->longitude))
                <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div class="mb-2 flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-slate-400">📍 Ubicación en el mapa</div>
                    <div id="institution-map" class="w-full h-56 sm:h-64 rounded-lg border border-gray-100 dark:border-slate-700"></div>
                </div>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" crossorigin="">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" crossorigin=""></script>
                <script>
                    (function () {
                        var map, markers = {};

                        window.initInstitutionMap = function (state) {
                            var el = document.getElementById('institution-map');
                            if (! el || typeof L === 'undefined') return;

                            map = L.map(el, { scrollWheelZoom: false });
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
                                maxZoom: 19,
                            }).addTo(map);

                            var icon = L.divIcon({
                                className: '',
                                html: '<div style="background:#059669;width:18px;height:18px;border-radius:50%;border:3px solid white;box-shadow:0 1px 6px rgba(0,0,0,.4)"></div>',
                                iconSize: [18, 18],
                                iconAnchor: [9, 9],
                            });

                            state.campuses.forEach(function (c) {
                                if (c.lat && c.lng) markers[c.id] = L.marker([c.lat, c.lng], { icon: icon }).addTo(map);
                            });

                            window.focusInstitutionMap(state, false);
                        };

                        window.focusInstitutionMap = function (state, animate) {
                            var m = markers[state.campus];
                            if (! map || ! m) return;
                            map.invalidateSize();
                            if (animate === false) map.setView(m.getLatLng(), 15);
                            else map.flyTo(m.getLatLng(), 15);
                        };
                    })();
                </script>
            @endif
        </div>
    </div>
</x-app-layout>
