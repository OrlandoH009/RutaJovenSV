<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.areas.index')" label="Volver a áreas" />
        <h2 class="display text-3xl sm:text-4xl">{{ $area->exists ? 'Editar área académica' : 'Nueva área académica' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ $area->exists ? route('admin.areas.update', $area) : route('admin.areas.store') }}" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf
                @if ($area->exists) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $area->name) }}" required class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    @error('name') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $area->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Ícono (opcional)</label>
                    <input type="text" name="icon" value="{{ old('icon', $area->icon) }}" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('admin.areas.index') }}" class="text-sm text-gray-500 dark:text-slate-400 hover:text-gray-700 dark:hover:text-slate-200">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
