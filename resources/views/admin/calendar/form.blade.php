<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.calendar.index')" label="Volver al calendario" />
        <h2 class="display text-3xl sm:text-4xl">{{ $event->exists ? 'Editar fecha' : 'Nueva fecha' }}</h2>
    </x-slot>

    @php
        $input = 'w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500';
        $label = 'block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1';
    @endphp

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ $event->exists ? route('admin.calendar.update', $event) : route('admin.calendar.store') }}" class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm space-y-4">
                @csrf
                @if ($event->exists) @method('PUT') @endif

                <div>
                    <label class="{{ $label }}">Título</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required placeholder="Ej. Inscripción a nuevo ingreso 2027" class="{{ $input }}">
                    @error('title') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="{{ $label }}">Tipo</label>
                        <select name="type" class="{{ $input }}">
                            @foreach ($types as $key => $text)
                                <option value="{{ $key }}" @selected(old('type', $event->type) === $key)>{{ $text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="{{ $label }}">Institución (opcional)</label>
                        <select name="institution_id" class="{{ $input }}">
                            <option value="">— General —</option>
                            @foreach ($institutions as $institution)
                                <option value="{{ $institution->id }}" @selected(old('institution_id', $event->institution_id) == $institution->id)>{{ $institution->short_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="{{ $label }}">Fecha de inicio</label>
                        <input type="date" name="starts_on" value="{{ old('starts_on', $event->starts_on?->toDateString()) }}" required class="{{ $input }}">
                        @error('starts_on') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="{{ $label }}">Fecha final (opcional)</label>
                        <input type="date" name="ends_on" value="{{ old('ends_on', $event->ends_on?->toDateString()) }}" class="{{ $input }}">
                        @error('ends_on') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="{{ $label }}">Descripción (opcional)</label>
                    <textarea name="description" rows="3" class="{{ $input }}">{{ old('description', $event->description) }}</textarea>
                </div>

                <div>
                    <label class="{{ $label }}">Enlace con más información (opcional)</label>
                    <input type="url" name="url" value="{{ old('url', $event->url) }}" placeholder="https://" class="{{ $input }}">
                    @error('url') <p data-error class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
