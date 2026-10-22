<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('dashboard')" label="Volver al dashboard" />
        <h2 data-animate="words" class="display text-3xl sm:text-4xl">Simulador de costos</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <p data-animate="hero" data-animate-delay="0.1" class="text-sm text-gray-500 dark:text-slate-400">
                Esta es una estimación aproximada para ayudarte a planificar. Los costos
                reales dependen de cada institución y pueden cambiar según el período
                académico — siempre confirma la información directamente con ellas.
            </p>

            <form method="POST" action="{{ route('cost-simulator.calculate') }}" data-animate="hero" data-animate-delay="0.2" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Presupuesto mensual disponible (US$)</label>
                        <input type="number" step="0.01" min="0" name="monthly_budget" value="{{ old('monthly_budget', $input['monthly_budget'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Matrícula inicial (US$)</label>
                        <input type="number" step="0.01" min="0" name="tuition" value="{{ old('tuition', $input['tuition'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Mensualidad (US$)</label>
                        <input type="number" step="0.01" min="0" name="monthly_fee" value="{{ old('monthly_fee', $input['monthly_fee'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Transporte mensual (US$)</label>
                        <input type="number" step="0.01" min="0" name="transport" value="{{ old('transport', $input['transport'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Materiales mensuales (US$)</label>
                        <input type="number" step="0.01" min="0" name="materials" value="{{ old('materials', $input['materials'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div x-data="{ months: {{ old('months', $input['months'] ?? 48) }} }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Duración a simular</label>
                        <div class="flex flex-wrap gap-1.5 mb-2">
                            <template x-for="years in [1, 2, 3, 4, 5, 6, 7]" :key="years">
                                <button type="button" @click="months = years * 12"
                                    :class="months === years * 12 ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-slate-400 border-gray-200 dark:border-slate-600 hover:border-emerald-300 dark:hover:border-emerald-600'"
                                    class="px-2.5 py-1 rounded-full text-xs border transition"
                                    x-text="years === 1 ? '1 año' : `${years} años`"></button>
                            </template>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="number" min="1" max="120" name="months" x-model.number="months" required
                                class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <span class="text-xs text-gray-400 dark:text-slate-500 whitespace-nowrap" x-text="`≈ ${(months / 12).toFixed(1)} años`"></span>
                        </div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">La mayoría de las carreras duran entre 2 y 5 años, pero puedes simular hasta 10 (120 meses) — por ejemplo, carreras como Medicina.</p>
                    </div>
                </div>

                <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Calcular</button>
            </form>

            @if ($result)
                <div data-animate="up" class="bg-emerald-50 dark:bg-emerald-950/30 p-6 rounded-xl border border-emerald-100 dark:border-emerald-900 space-y-3">
                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-600 dark:text-slate-400">Gasto mensual estimado</span>
                        <span class="font-semibold text-gray-900 dark:text-slate-100">US$ {{ number_format($result['monthly_total'], 2) }}</span>
                    </div>
                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-600 dark:text-slate-400">Balance mensual (presupuesto - gasto)</span>
                        <span class="font-semibold {{ $result['monthly_balance'] < 0 ? 'text-red-600 dark:text-red-400' : 'text-emerald-700 dark:text-emerald-400' }}">
                            US$ {{ number_format($result['monthly_balance'], 2) }}
                        </span>
                    </div>
                    <div class="flex justify-between gap-4 text-sm border-t border-emerald-100 dark:border-emerald-900 pt-3">
                        <span class="text-gray-600 dark:text-slate-400">Total estimado en {{ $result['months'] }} meses (≈ {{ number_format($result['months'] / 12, 1) }} años, incluye matrícula)</span>
                        <span class="font-semibold text-gray-900 dark:text-slate-100 whitespace-nowrap">US$ {{ number_format($result['period_total'], 2) }}</span>
                    </div>
                    @if ($result['monthly_balance'] < 0)
                        <p class="text-sm text-red-600 dark:text-red-400">Tu gasto mensual estimado supera tu presupuesto disponible.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
