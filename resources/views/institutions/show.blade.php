<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('institutions.index')" label="Volver a instituciones" />
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div data-animate="hero" data-animate-delay="0.1">
                <div class="text-xs uppercase tracking-wide text-emerald-600 dark:text-emerald-400 font-semibold">{{ $institution->institution_type }}</div>
                <h2 class="display text-3xl sm:text-4xl">{{ $institution->name }}</h2>
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="font-medium text-gray-500 dark:text-slate-400">Ubicación</dt>
                        <dd class="text-gray-900 dark:text-slate-100">{{ $institution->municipality }}, {{ $institution->department }}</dd>
                    </div>
                    @if ($institution->website)
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-slate-400">Sitio web</dt>
                            <dd><a href="{{ $institution->website }}" target="_blank" rel="noopener" class="text-emerald-700 dark:text-emerald-400 hover:underline break-all">{{ $institution->website }}</a></dd>
                        </div>
                    @endif
                </dl>

                @if ($institution->latitude && $institution->longitude)
                    <div class="mt-5">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <span class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-slate-400">📍 Ubicación en el mapa</span>
                            <a href="https://www.openstreetmap.org/?mlat={{ $institution->latitude }}&mlon={{ $institution->longitude }}#map=16/{{ $institution->latitude }}/{{ $institution->longitude }}"
                                target="_blank" rel="noopener" class="text-xs font-medium text-emerald-700 dark:text-emerald-400 hover:underline">
                                Abrir mapa completo ↗
                            </a>
                        </div>
                        <div id="institution-map" class="w-full h-56 sm:h-64 rounded-lg border border-gray-100 dark:border-slate-700"></div>
                    </div>

                    @once
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" crossorigin="">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js" crossorigin=""></script>
                    @endonce
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var mapEl = document.getElementById('institution-map');
                            if (! mapEl || typeof L === 'undefined') return;

                            var map = L.map(mapEl, { scrollWheelZoom: false }).setView([{{ $institution->latitude }}, {{ $institution->longitude }}], 15);

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

                            L.marker([{{ $institution->latitude }}, {{ $institution->longitude }}], { icon: icon }).addTo(map);
                        });
                    </script>
                @endif
            </div>

            <div data-animate="up" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                <h3 class="font-semibold text-gray-900 dark:text-slate-100 mb-4">Carreras que ofrece</h3>
                @forelse ($institution->careers as $career)
                    <div data-animate="up" data-animate-group="careers" class="flex items-center justify-between gap-3 py-3 border-b last:border-0 border-gray-100 dark:border-slate-700">
                        <div>
                            <a href="{{ route('careers.show', $career) }}" class="font-medium text-emerald-700 dark:text-emerald-400 hover:underline">{{ $career->name }}</a>
                            <div class="text-sm text-gray-500 dark:text-slate-400">{{ $career->academicArea?->name }}</div>
                        </div>
                        <span class="shrink-0 text-xs px-2 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 capitalize">{{ $career->pivot->modality }}</span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-slate-400 text-sm">Aún no hay carreras registradas para esta institución.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
