{{-- Vista rápida de carreras. Recibe $careers (id => datos) y escucha el evento "quick-view" con el id. --}}
@props(['careers'])

<x-modal name="quick-view" maxWidth="lg">
    <div x-data="{ c: null, all: @js($careers) }" x-on:quick-view.window="c = all[$event.detail]; $dispatch('open-modal', 'quick-view')" class="p-6 sm:p-8">
        <template x-if="c">
            <div>
                <div class="text-xs font-semibold uppercase tracking-wide text-emerald-600" x-text="c.area"></div>
                <h3 class="display mt-1 text-3xl" x-text="c.name"></h3>
                <p class="mt-4 text-sm leading-relaxed text-gray-600 dark:text-slate-300" x-text="c.description"></p>
                <div x-show="c.duration" class="mt-4 inline-flex rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-500 dark:border-slate-700 dark:text-slate-400">
                    Duración: <span class="ms-1" x-text="c.duration"></span>
                </div>
                <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'quick-view')">Cerrar</x-secondary-button>
                    <a :href="c.url" class="btn-primary">Ver detalle completo →</a>
                </div>
            </div>
        </template>
    </div>
</x-modal>
