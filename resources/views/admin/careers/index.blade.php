<x-app-layout>
    <x-slot name="header">
        <x-back-link :href="route('admin.dashboard')" label="Volver al panel" />
        <h2 class="display text-3xl sm:text-4xl">Carreras</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            @if (session('status'))
                <x-flash-success :message="session('status')" class="mb-4" />
            @endif

            <div class="flex justify-between items-center mb-4 gap-4 flex-wrap">
                <form method="GET" class="flex-1 min-w-[200px]">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar carrera..." class="w-full max-w-sm rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </form>
                <a href="{{ route('admin.careers.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Nueva carrera</a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-slate-700 text-left text-gray-500 dark:text-slate-400">
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Área</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($careers as $career)
                            <tr class="border-b last:border-0 border-gray-50 dark:border-slate-700">
                                <td class="p-4 font-medium text-gray-900 dark:text-slate-100">{{ $career->name }}</td>
                                <td class="p-4">{{ $career->academicArea?->name }}</td>
                                <td class="p-4 text-right whitespace-nowrap space-x-3">
                                    <a href="{{ route('admin.careers.edit', $career) }}" class="text-emerald-700 dark:text-emerald-400 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" class="inline" data-confirm="¿Eliminar esta carrera?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $careers->links() }}</div>
        </div>
    </div>
</x-app-layout>
