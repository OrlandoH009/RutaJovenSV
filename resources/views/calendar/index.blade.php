<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('home')" label="Volver al inicio" />
        <h2 data-animate="words" class="display text-3xl sm:text-4xl">Calendario de admisión</h2>
    </x-slot>

    <div class="py-6">
        <div
            class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8"
            x-data="{
                events: @js($events),
                types: @js($types),
                typeStyle: {
                    inscripcion: { dot: 'bg-emerald-500', chip: 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' },
                    admision: { dot: 'bg-sky-500', chip: 'bg-sky-50 text-sky-700 dark:bg-sky-950/40 dark:text-sky-400' },
                    beca: { dot: 'bg-amber-500', chip: 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' },
                    otro: { dot: 'bg-slate-400', chip: 'bg-gray-100 text-gray-600 dark:bg-slate-700 dark:text-slate-300' },
                },
                institution: '',
                type: '',
                cursor: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
                selected: null,
                weekdays: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                ymd(d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0'); },
                get today() { return this.ymd(new Date()); },
                get monthLabel() { return this.cursor.toLocaleDateString('es-SV', { month: 'long', year: 'numeric' }); },
                get filtered() {
                    return this.events.filter(e => (!this.institution || e.institution_id == this.institution) && (!this.type || e.type === this.type));
                },
                // 6 semanas desde el lunes anterior al día 1 (los días fuera del mes se atenúan).
                get cells() {
                    const first = new Date(this.cursor.getFullYear(), this.cursor.getMonth(), 1);
                    const start = new Date(first); start.setDate(1 - ((first.getDay() + 6) % 7));
                    return Array.from({ length: 42 }, (_, i) => {
                        const d = new Date(start); d.setDate(start.getDate() + i);
                        return { date: this.ymd(d), day: d.getDate(), inMonth: d.getMonth() === this.cursor.getMonth() };
                    });
                },
                eventsOn(date) { return this.filtered.filter(e => e.start <= date && date <= e.end); },
                get upcoming() { return this.filtered.filter(e => e.end >= this.today).slice(0, 8); },
                get selectedEvents() { return this.selected ? this.eventsOn(this.selected) : []; },
                move(n) { this.cursor = new Date(this.cursor.getFullYear(), this.cursor.getMonth() + n, 1); this.selected = null; },
                goToday() { this.cursor = new Date(new Date().getFullYear(), new Date().getMonth(), 1); this.selected = this.today; },
                fmt(date) { return new Date(date + 'T00:00:00').toLocaleDateString('es-SV', { day: 'numeric', month: 'short' }); },
                range(e) { return e.start === e.end ? this.fmt(e.start) : this.fmt(e.start) + ' – ' + this.fmt(e.end); },
            }"
        >
            <p data-animate="hero" data-animate-delay="0.1" class="mb-4 text-sm text-gray-500 dark:text-slate-400">
                Fechas de inscripción, pruebas de admisión y becas. Pueden cambiar: confirma siempre con cada institución.
            </p>

            {{-- Filtros --}}
            <div class="mb-4 flex flex-wrap items-end gap-3">
                <div class="min-w-[200px] flex-1 sm:flex-none">
                    <label class="mb-1 block text-xs font-medium text-gray-700 dark:text-slate-300">Institución</label>
                    <select x-model="institution" class="w-full rounded-md border-gray-300 py-1.5 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                        <option value="">Todas</option>
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">{{ $institution->short_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <button type="button" @click="type = ''" :class="type === '' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-slate-400 border-gray-200 dark:border-slate-600'" class="rounded-full border px-3 py-1 text-xs font-medium transition">Todo</button>
                    @foreach ($types as $key => $label)
                        <button type="button" @click="type = '{{ $key }}'" :class="type === '{{ $key }}' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-slate-400 border-gray-200 dark:border-slate-600'" class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-medium transition">
                            <span class="h-2 w-2 rounded-full" :class="typeStyle['{{ $key }}'].dot"></span>{{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                {{-- Mes --}}
                <div data-animate="up" class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800 lg:col-span-2">
                    <div class="mb-3 flex items-center justify-between gap-2">
                        <h3 class="font-display text-xl capitalize text-gray-900 dark:text-slate-100" x-text="monthLabel"></h3>
                        <div class="flex items-center gap-1">
                            <button type="button" @click="goToday()" class="rounded-md px-3 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-slate-700">Hoy</button>
                            <button type="button" @click="move(-1)" aria-label="Mes anterior" class="flex h-8 w-8 items-center justify-center rounded-md text-gray-500 hover:bg-gray-100 dark:text-slate-400 dark:hover:bg-slate-700">←</button>
                            <button type="button" @click="move(1)" aria-label="Mes siguiente" class="flex h-8 w-8 items-center justify-center rounded-md text-gray-500 hover:bg-gray-100 dark:text-slate-400 dark:hover:bg-slate-700">→</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 text-center text-[11px] font-medium uppercase tracking-wide text-gray-400 dark:text-slate-500">
                        <template x-for="w in weekdays" :key="w"><div class="py-1" x-text="w"></div></template>
                    </div>
                    <div class="mt-1 grid grid-cols-7 gap-1">
                        <template x-for="c in cells" :key="c.date">
                            <button type="button" @click="selected = c.date"
                                :class="[
                                    c.inMonth ? 'text-gray-800 dark:text-slate-200' : 'text-gray-300 dark:text-slate-600',
                                    selected === c.date ? 'bg-emerald-600 !text-white' : (c.date === today ? 'ring-1 ring-emerald-500' : 'hover:bg-gray-100 dark:hover:bg-slate-700'),
                                ]"
                                class="flex aspect-square flex-col items-center justify-center gap-1 rounded-lg text-sm transition sm:aspect-[4/3]">
                                <span x-text="c.day"></span>
                                <span class="flex h-1.5 gap-0.5">
                                    <template x-for="e in eventsOn(c.date).slice(0, 3)" :key="e.id">
                                        <span class="h-1.5 w-1.5 rounded-full" :class="selected === c.date ? 'bg-white' : typeStyle[e.type].dot"></span>
                                    </template>
                                </span>
                            </button>
                        </template>
                    </div>

                    {{-- Día elegido --}}
                    <div x-show="selected" x-cloak x-transition class="mt-4 border-t border-gray-100 pt-4 dark:border-slate-700">
                        <div class="mb-2 text-sm font-medium text-gray-700 dark:text-slate-300" x-text="selected ? fmt(selected) : ''"></div>
                        <p x-show="selectedEvents.length === 0" class="text-sm text-gray-400 dark:text-slate-500">No hay fechas registradas este día.</p>
                        <ul class="space-y-2">
                            <template x-for="e in selectedEvents" :key="e.id">
                                <li class="rounded-lg border border-gray-100 p-3 dark:border-slate-700">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="rounded-full px-2 py-0.5 text-[11px] font-medium" :class="typeStyle[e.type].chip" x-text="types[e.type]"></span>
                                        <span class="text-xs text-gray-400 dark:text-slate-500" x-text="range(e)"></span>
                                    </div>
                                    <div class="mt-1 font-medium text-gray-900 dark:text-slate-100" x-text="e.title"></div>
                                    <div x-show="e.institution" class="text-xs text-gray-500 dark:text-slate-400" x-text="e.institution"></div>
                                    <p x-show="e.description" class="mt-1 text-sm text-gray-600 dark:text-slate-300" x-text="e.description"></p>
                                    <a x-show="e.url" :href="e.url" target="_blank" rel="noopener" class="mt-1 inline-block text-sm text-emerald-700 hover:underline dark:text-emerald-400">Más información ↗</a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                {{-- Próximas fechas --}}
                <div data-animate="up" class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-800">
                    <h3 class="mb-3 font-semibold text-gray-900 dark:text-slate-100">Próximas fechas</h3>
                    <p x-show="upcoming.length === 0" class="text-sm text-gray-400 dark:text-slate-500">No hay fechas próximas con estos filtros.</p>
                    <ul class="space-y-3">
                        <template x-for="e in upcoming" :key="e.id">
                            <li>
                                <button type="button" @click="cursor = new Date(e.start + 'T00:00:00'); cursor.setDate(1); selected = e.start" class="flex w-full gap-3 rounded-lg p-2 text-left transition hover:bg-gray-50 dark:hover:bg-slate-700/50">
                                    <span class="mt-1.5 h-2.5 w-2.5 shrink-0 rounded-full" :class="typeStyle[e.type].dot"></span>
                                    <span class="min-w-0">
                                        <span class="block text-xs text-gray-400 dark:text-slate-500" x-text="range(e)"></span>
                                        <span class="block text-sm font-medium text-gray-900 dark:text-slate-100" x-text="e.title"></span>
                                        <span class="block text-xs text-gray-500 dark:text-slate-400" x-text="e.institution ?? ''"></span>
                                    </span>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
