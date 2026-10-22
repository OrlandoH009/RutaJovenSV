{{-- Se abre con $dispatch('open-modal', 'login-prompt'). Para invitados que intentan guardar algo. --}}
@props(['text' => 'Crea una cuenta gratis o inicia sesión para guardar tus favoritos y armar tu ruta académica.'])

<x-modal name="login-prompt" maxWidth="md">
    <div class="p-6 text-center sm:p-8">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-xl text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400">★</div>
        <h3 class="display mt-4 text-2xl">Guarda lo que te interesa</h3>
        <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">{{ $text }}</p>
        <div class="mt-6 flex flex-col gap-2 sm:flex-row sm:justify-center">
            <a href="{{ route('register') }}" class="btn-primary">Crear mi cuenta</a>
            <a href="{{ route('login') }}" class="btn-secondary">Iniciar sesión</a>
        </div>
    </div>
</x-modal>
