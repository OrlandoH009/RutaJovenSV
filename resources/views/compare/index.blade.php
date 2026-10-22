<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('home')" label="Volver al inicio" />
        <h2 data-animate="words" class="display text-3xl sm:text-4xl">Comparador de carreras</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" data-animate="hero" data-animate-delay="0.1" x-data="{
                    selected: @js($selectedIds),
                    toggle(id) {
                        id = parseInt(id);
                        if (this.selected.includes(id)) {
                            this.selected = this.selected.filter(i => i !== id);
                        } else if (this.selected.length < 3) {
                            this.selected.push(id);
                        }
                    },
                }" @submit="$event.target.querySelector('[name=careers]').value = selected.join(',')"
                class="bg-white dark:bg-slate-800 dark:border-slate-700 p-4 sm:p-5 rounded-xl border border-gray-100 shadow-sm mb-6">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">Elige hasta 3 carreras para comparar</label>
                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300" x-text="selected.length + ' / 3 seleccionadas'"></span>
                </div>

                <div class="space-y-4 max-h-80 overflow-y-auto pr-1 -mr-1">
                    @foreach ($availableCareers as $areaName => $areaCareers)
                        <div>
                            <h4 class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-slate-500 mb-2">{{ $areaName }}</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2">
                                @foreach ($areaCareers as $career)
                                    <button type="button" @click="toggle({{ $career->id }})"
                                        :class="(selected.includes({{ $career->id }}) ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-gray-700 border-gray-200 hover:border-emerald-300 dark:bg-slate-900 dark:text-slate-300 dark:border-slate-600 dark:hover:border-emerald-600') + (! selected.includes({{ $career->id }}) && selected.length >= 3 ? ' opacity-40 cursor-not-allowed' : '')"
                                        :disabled="! selected.includes({{ $career->id }}) && selected.length >= 3"
                                        class="px-3 py-1.5 rounded-lg text-sm border transition truncate text-left" title="{{ $career->name }}">
                                        {{ $career->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="careers" value="{{ $selectedIds->implode(',') }}">
                <button type="submit" class="w-full sm:w-auto mt-4 px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="selected.length === 0">Comparar</button>
            </form>

            @if ($careers->isNotEmpty())
                <div data-animate="up" class="overflow-x-auto bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-slate-700">
                                <th class="text-left p-4 font-medium text-gray-500 dark:text-slate-400">Característica</th>
                                @foreach ($careers as $career)
                                    <th class="text-left p-4 font-semibold text-gray-900 dark:text-slate-100">{{ $career->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-50 dark:border-slate-700/60">
                                <td class="p-4 text-gray-500 dark:text-slate-400">Área académica</td>
                                @foreach ($careers as $career)
                                    <td class="p-4 text-gray-900 dark:text-slate-200">{{ $career->academicArea?->name }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50 dark:border-slate-700/60">
                                <td class="p-4 text-gray-500 dark:text-slate-400">Duración</td>
                                @foreach ($careers as $career)
                                    <td class="p-4 text-gray-900 dark:text-slate-200">{{ $career->duration_text ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50 dark:border-slate-700/60">
                                <td class="p-4 text-gray-500 dark:text-slate-400">Habilidades relacionadas</td>
                                @foreach ($careers as $career)
                                    <td class="p-4 text-gray-900 dark:text-slate-200">{{ $career->skills ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50 dark:border-slate-700/60">
                                <td class="p-4 text-gray-500 dark:text-slate-400">Instituciones que la ofrecen</td>
                                @foreach ($careers as $career)
                                    <td class="p-4 text-gray-900 dark:text-slate-200">{{ $career->institutions->count() }}</td>
                                @endforeach
                            </tr>
                            @foreach (config('interests.labels') as $key => $label)
                                <tr class="border-b border-gray-50 dark:border-slate-700/60 last:border-0">
                                    <td class="p-4 text-gray-500 dark:text-slate-400">{{ $label }}</td>
                                    @foreach ($careers as $career)
                                        @php $weight = $career->interestWeights->firstWhere('interest_key', $key)?->weight; @endphp
                                        <td class="p-4 min-w-[140px]">
                                            @if ($weight !== null)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-16 bg-gray-100 dark:bg-slate-700 rounded-full h-2">
                                                        <div class="bg-emerald-500 dark:bg-emerald-400 h-2 rounded-full" style="width: {{ $weight }}%"></div>
                                                    </div>
                                                    <span class="text-gray-700 dark:text-slate-300 text-xs">{{ $weight }}%</span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 dark:text-slate-500">—</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 dark:text-slate-400">Selecciona al menos una carrera para comenzar a comparar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
