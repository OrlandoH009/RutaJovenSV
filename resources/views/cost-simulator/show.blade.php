<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('dashboard')" label="Volver al dashboard" />
        <h2 data-animate="words" class="display text-3xl sm:text-4xl">Simulador de costos</h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4" x-data="{
            result: @js($result), shown: { monthly_total: 0, monthly_balance: 0, period_total: 0 }, loading: false, error: '',
            // Cuenta de 0 al valor final (ease-out) para que los números "entren" animados.
            animate() {
                const target = { ...this.result }, start = performance.now(), duration = 800;
                const tick = (now) => {
                    const t = Math.min(1, (now - start) / duration), e = 1 - Math.pow(1 - t, 3);
                    for (const k of ['monthly_total', 'monthly_balance', 'period_total']) this.shown[k] = target[k] * e;
                    if (t < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
            },
            clear(form) {
                form.reset();
                this.result = null; this.error = '';
                this.shown = { monthly_total: 0, monthly_balance: 0, period_total: 0 };
                window.dispatchEvent(new CustomEvent('reset-simulator'));
                form.querySelector('input')?.focus();
            },
            money(n) { return 'US$ ' + Number(n).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); },
            async calculate(form) {
                this.loading = true; this.error = '';
                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                        body: new FormData(form),
                    });
                    const data = await res.json();
                    if (!res.ok) { this.error = Object.values(data.errors ?? {})[0]?.[0] ?? 'No se pudo calcular. Revisa los datos.'; return; }
                    this.result = data; this.animate();
                    this.$nextTick(() => this.$refs.result?.scrollIntoView({ behavior: 'smooth', block: 'nearest' }));
                } catch (e) { this.error = 'No se pudo calcular. Intenta de nuevo.'; } finally { this.loading = false; }
            },
        }">
            <p data-animate="hero" data-animate-delay="0.1" class="text-sm text-gray-500 dark:text-slate-400">
                Esta es una estimación aproximada para ayudarte a planificar. Los costos
                reales dependen de cada institución y pueden cambiar según el período
                académico — siempre confirma la información directamente con ellas.
            </p>

            <form method="POST" action="{{ route('cost-simulator.calculate') }}" @submit.prevent="calculate($el)" data-animate="hero" data-animate-delay="0.2" class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-3">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-3 gap-y-2.5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Presupuesto mensual disponible (US$)</label>
                        <input type="number" step="0.01" min="0" name="monthly_budget" value="{{ old('monthly_budget', $input['monthly_budget'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 py-1.5 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Matrícula inicial (US$)</label>
                        <input type="number" step="0.01" min="0" name="tuition" value="{{ old('tuition', $input['tuition'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 py-1.5 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Mensualidad (US$)</label>
                        <input type="number" step="0.01" min="0" name="monthly_fee" value="{{ old('monthly_fee', $input['monthly_fee'] ?? '') }}" required
                            class="w-full rounded-md border-gray-300 py-1.5 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Transporte mensual (US$)</label>
                        <input type="number" step="0.01" min="0" name="transport" value="{{ old('transport', $input['transport'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 py-1.5 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Materiales mensuales (US$)</label>
                        <input type="number" step="0.01" min="0" name="materials" value="{{ old('materials', $input['materials'] ?? '') }}"
                            class="w-full rounded-md border-gray-300 py-1.5 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div x-data="{ months: {{ old('months', $input['months'] ?? 48) }} }" @reset-simulator.window="months = 48" class="sm:col-span-3">
                        <label class="block text-xs font-medium text-gray-700 dark:text-slate-300 mb-1">Duración a simular <span class="font-normal text-gray-400 dark:text-slate-500">(hasta 120 meses; la mayoría de carreras dura de 2 a 5 años)</span></label>
                        <div class="flex flex-wrap items-center gap-1.5">
                            <template x-for="years in [1, 2, 3, 4, 5, 6, 7]" :key="years">
                                <button type="button" @click="months = years * 12"
                                    :class="months === years * 12 ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-slate-400 border-gray-200 dark:border-slate-600 hover:border-emerald-300 dark:hover:border-emerald-600'"
                                    class="px-2.5 py-1 rounded-full text-xs border transition"
                                    x-text="years === 1 ? '1 año' : `${years} años`"></button>
                            </template>
                            <input type="number" min="1" max="120" name="months" x-model.number="months" required aria-label="Meses a simular"
                                class="ms-auto w-20 rounded-md border-gray-300 py-1 text-sm dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            <span class="text-xs text-gray-400 dark:text-slate-500 whitespace-nowrap" x-text="`meses ≈ ${(months / 12).toFixed(1)} años`"></span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit" class="w-full sm:w-auto px-5 py-1.5 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700 disabled:opacity-60" :disabled="loading" x-text="loading ? 'Calculando…' : 'Calcular'">Calcular</button>
                    <button type="button" @click="clear($el.closest('form'))" x-show="result || error" x-cloak x-transition title="Borrar datos y empezar de nuevo" aria-label="Borrar datos y empezar de nuevo"
                        class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-gray-200 text-gray-500 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600 dark:border-slate-600 dark:text-slate-400 dark:hover:border-red-800 dark:hover:bg-red-950/30 dark:hover:text-red-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.35 9m-4.78 0L9.26 9m9.97-3.21c.34.05.68.11 1.02.17m-1.02-.17L18.16 19.67a2.25 2.25 0 01-2.24 2.08H8.08a2.25 2.25 0 01-2.24-2.08L4.77 5.79m14.46 0a48.1 48.1 0 00-3.48-.4m-12 .56c.34-.06.68-.12 1.02-.17m0 0a48.11 48.11 0 013.48-.4m7.5 0v-.92c0-1.18-.91-2.16-2.09-2.2a51.96 51.96 0 00-3.32 0c-1.18.04-2.09 1.02-2.09 2.2v.92m7.5 0a48.67 48.67 0 00-7.5 0"/></svg>
                    </button>
                </div>
                <p x-show="error" x-cloak x-text="error" class="text-sm text-red-600 dark:text-red-400"></p>
            </form>

            <div x-show="result" x-cloak x-ref="result" x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 scale-95" class="bg-emerald-50 dark:bg-emerald-950/30 p-4 rounded-xl border border-emerald-100 dark:border-emerald-900 space-y-2">
                <div class="flex justify-between gap-4 text-sm">
                    <span class="text-gray-600 dark:text-slate-400">Gasto mensual estimado</span>
                    <span class="font-semibold text-gray-900 dark:text-slate-100" x-text="money(shown.monthly_total)"></span>
                </div>
                <div class="flex justify-between gap-4 text-sm">
                    <span class="text-gray-600 dark:text-slate-400">Balance mensual (presupuesto - gasto)</span>
                    <span class="font-semibold" :class="result?.monthly_balance < 0 ? 'text-red-600 dark:text-red-400' : 'text-emerald-700 dark:text-emerald-400'" x-text="money(shown.monthly_balance)"></span>
                </div>
                <div class="flex justify-between gap-4 text-sm border-t border-emerald-100 dark:border-emerald-900 pt-3">
                    <span class="text-gray-600 dark:text-slate-400" x-text="`Total estimado en ${result?.months} meses (≈ ${(result?.months / 12).toFixed(1)} años, incluye matrícula)`"></span>
                    <span class="font-semibold text-gray-900 dark:text-slate-100 whitespace-nowrap" x-text="money(shown.period_total)"></span>
                </div>
                <p x-show="result?.monthly_balance < 0" class="text-sm text-red-600 dark:text-red-400">Tu gasto mensual estimado supera tu presupuesto disponible.</p>
            </div>
        </div>
    </div>
</x-app-layout>
