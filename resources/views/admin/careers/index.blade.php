<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Carreras</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            @if (session('status'))
                <div class="p-4 bg-emerald-50 text-emerald-800 rounded-lg text-sm mb-4">{{ session('status') }}</div>
            @endif

            <div class="flex justify-between items-center mb-4 gap-4 flex-wrap">
                <form method="GET" class="flex-1 min-w-[200px]">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar carrera..." class="w-full max-w-sm rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                </form>
                <a href="{{ route('admin.careers.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Nueva carrera</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-gray-500">
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Área</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($careers as $career)
                            <tr class="border-b last:border-0 border-gray-50">
                                <td class="p-4 font-medium text-gray-900">{{ $career->name }}</td>
                                <td class="p-4">{{ $career->academicArea?->name }}</td>
                                <td class="p-4 text-right space-x-3">
                                    <a href="{{ route('admin.careers.edit', $career) }}" class="text-emerald-700 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" class="inline" onsubmit="return confirm('¿Eliminar esta carrera?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
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
