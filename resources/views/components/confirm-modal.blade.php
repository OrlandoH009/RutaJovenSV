{{-- Modal global de confirmación. Cualquier <form data-confirm="mensaje"> lo abre (ver app.js). --}}
<x-modal name="confirm-action" maxWidth="md">
    <div
        x-data="{ form: null, message: '' }"
        x-on:confirm-action.window="form = $event.detail.form; message = $event.detail.message; $dispatch('open-modal', 'confirm-action')"
        class="p-6 text-center sm:p-8"
    >
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-950/40 dark:text-red-400">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
        </div>
        <h3 class="display mt-4 text-2xl">¿Confirmas esta acción?</h3>
        <p class="mt-2 text-sm text-gray-500 dark:text-slate-400" x-text="message"></p>
        <div class="mt-6 flex flex-col-reverse justify-center gap-2 sm:flex-row">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-action')">Cancelar</x-secondary-button>
            <x-danger-button type="button" x-on:click="form.dataset.confirmed = '1'; form.requestSubmit()">Sí, continuar</x-danger-button>
        </div>
    </div>
</x-modal>
