<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $area->exists ? 'Editar área académica' : 'Nueva área académica' }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ $area->exists ? route('admin.areas.update', $area) : route('admin.areas.store') }}" class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm space-y-4">
                @csrf
                @if ($area->exists) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $area->name) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $area->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ícono (opcional)</label>
                    <input type="text" name="icon" value="{{ old('icon', $area->icon) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('admin.areas.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancelar</a>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
