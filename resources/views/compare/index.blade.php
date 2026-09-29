<x-app-layout>
    <x-slot name="header">
        <h2 data-animate="hero" class="font-semibold text-xl text-gray-800 leading-tight">Comparador de carreras</h2>
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
                class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Elige hasta 3 carreras para comparar</label>
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($availableCareers as $career)
                        <button type="button" @click="toggle({{ $career->id }})"
                            :class="selected.includes({{ $career->id }}) ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-gray-700 border-gray-200 hover:border-emerald-300'"
                            class="px-3 py-1.5 rounded-full text-sm border transition">
                            {{ $career->name }}
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="careers" value="{{ $selectedIds->implode(',') }}">
                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Comparar</button>
            </form>

            @if ($careers->isNotEmpty())
                <div data-animate="up" class="overflow-x-auto bg-white rounded-xl border border-gray-100 shadow-sm">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="text-left p-4 font-medium text-gray-500">Característica</th>
                                @foreach ($careers as $career)
                                    <th class="text-left p-4 font-semibold text-gray-900">{{ $career->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-50">
                                <td class="p-4 text-gray-500">Área académica</td>
                                @foreach ($careers as $career)
                                    <td class="p-4">{{ $career->academicArea?->name }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="p-4 text-gray-500">Duración</td>
                                @foreach ($careers as $career)
                                    <td class="p-4">{{ $career->duration_text ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="p-4 text-gray-500">Habilidades relacionadas</td>
                                @foreach ($careers as $career)
                                    <td class="p-4">{{ $career->skills ?? '—' }}</td>
                                @endforeach
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="p-4 text-gray-500">Instituciones que la ofrecen</td>
                                @foreach ($careers as $career)
                                    <td class="p-4">{{ $career->institutions->count() }}</td>
                                @endforeach
                            </tr>
                            @foreach (config('interests.labels') as $key => $label)
                                <tr class="border-b border-gray-50 last:border-0">
                                    <td class="p-4 text-gray-500">{{ $label }}</td>
                                    @foreach ($careers as $career)
                                        <td class="p-4">{{ $career->interestWeights->firstWhere('interest_key', $key)?->weight ?? '—' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">Selecciona al menos una carrera para comenzar a comparar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
