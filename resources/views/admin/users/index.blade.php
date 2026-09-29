<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuarios</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.subnav')

            @if (session('status'))
                <div class="p-4 bg-emerald-50 text-emerald-800 rounded-lg text-sm mb-4">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="p-4 bg-red-50 text-red-700 rounded-lg text-sm mb-4">{{ $errors->first() }}</div>
            @endif

            <form method="GET" class="mb-4">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre o correo..." class="w-full max-w-sm rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            </form>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-gray-500">
                            <th class="p-4">Nombre</th>
                            <th class="p-4">Correo</th>
                            <th class="p-4">Rol</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b last:border-0 border-gray-50">
                                <td class="p-4 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4 capitalize">{{ $user->roles->pluck('name')->implode(', ') ?: 'Sin rol' }}</td>
                                <td class="p-4 text-right">
                                    <form method="POST" action="{{ route('admin.users.role.update', $user) }}" class="inline-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="rounded-md border-gray-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            <option value="student" @selected($user->hasRole('student'))>Estudiante</option>
                                            <option value="admin" @selected($user->hasRole('admin'))>Administrador</option>
                                        </select>
                                        <button type="submit" class="text-emerald-700 hover:underline text-sm">Guardar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>
