<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.dashboard')" label="Volver al panel" />
        <h2 class="display text-3xl sm:text-4xl">Calendario</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            @if (session('status'))
                <x-flash-success :message="session('status')" class="mb-4" />
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.calendar.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Nueva fecha</a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-slate-700 text-left text-gray-500 dark:text-slate-400">
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Título</th>
                            <th class="p-4">Tipo</th>
                            <th class="p-4">Institución</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr class="border-b last:border-0 border-gray-50 dark:border-slate-700">
                                <td class="p-4 whitespace-nowrap">{{ $event->starts_on->format('d/m/Y') }}@if ($event->ends_on) – {{ $event->ends_on->format('d/m/Y') }}@endif</td>
                                <td class="p-4 font-medium text-gray-900 dark:text-slate-100">{{ $event->title }}</td>
                                <td class="p-4">{{ \App\Models\CalendarEvent::TYPES[$event->type] ?? $event->type }}</td>
                                <td class="p-4">{{ $event->institution?->short_name ?? 'General' }}</td>
                                <td class="p-4 text-right whitespace-nowrap space-x-3">
                                    <a href="{{ route('admin.calendar.edit', $event) }}" class="text-emerald-700 dark:text-emerald-400 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('admin.calendar.destroy', $event) }}" class="inline" data-confirm="¿Eliminar esta fecha?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-6 text-center text-gray-400 dark:text-slate-500">Aún no hay fechas. Agrega la primera con "+ Nueva fecha".</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $events->links() }}</div>
        </div>
    </div>
</x-app-layout>
