<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Preguntas del cuestionario</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            @if (session('status'))
                <div class="p-4 bg-emerald-50 text-emerald-800 rounded-lg text-sm mb-4">{{ session('status') }}</div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.questions.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700">+ Nueva pregunta</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-gray-500">
                            <th class="p-4">Orden</th>
                            <th class="p-4">Pregunta</th>
                            <th class="p-4">Opciones</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr class="border-b last:border-0 border-gray-50">
                                <td class="p-4">{{ $question->order }}</td>
                                <td class="p-4 font-medium text-gray-900">{{ $question->text }}</td>
                                <td class="p-4">{{ $question->options_count }}</td>
                                <td class="p-4 text-right space-x-3">
                                    <a href="{{ route('admin.questions.edit', $question) }}" class="text-emerald-700 hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" class="inline" onsubmit="return confirm('¿Eliminar esta pregunta?');">
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

            <div class="mt-6">{{ $questions->links() }}</div>
        </div>
    </div>
</x-app-layout>
