<section x-data="{
        departments: @js(array_keys(config('el_salvador.departments'))),
        municipalitiesByDept: @js(config('el_salvador.departments')),
        department: @js(old('department', $user->department)),
        municipality: @js(old('municipality', $user->municipality)),
        get municipalities() {
            return this.municipalitiesByDept[this.department] ?? [];
        },
    }">
    <header class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center text-xl font-bold shrink-0">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Información del perfil') }}
            </h2>
            <p class="text-sm text-gray-500">
                {{ __('Actualiza tu información personal y de contacto.') }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <x-input-label for="name" value="👤 Nombre" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="✉️ Correo electrónico" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t border-gray-100 pt-5">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600 mb-4">📍 Ubicación</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="department" value="Departamento" />
                    <select id="department" name="department" x-model="department" @change="municipality = ''"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Selecciona un departamento</option>
                        <template x-for="dept in departments" :key="dept">
                            <option :value="dept" x-text="dept" :selected="dept === department"></option>
                        </template>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('department')" />
                </div>

                <div>
                    <x-input-label for="municipality" value="Municipio" />
                    <select id="municipality" name="municipality" x-model="municipality" :disabled="! department"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 disabled:bg-gray-50 disabled:text-gray-400">
                        <option value="">{{ __('Selecciona primero un departamento') }}</option>
                        <template x-for="m in municipalities" :key="m">
                            <option :value="m" x-text="m" :selected="m === municipality"></option>
                        </template>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('municipality')" />
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-5">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600 mb-4">🎓 Formación académica</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <x-input-label for="academic_level" value="Nivel académico" />
                    <select id="academic_level" name="academic_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Selecciona una opción</option>
                        @foreach (['Cursando bachillerato', 'Bachillerato terminado', 'Estudios técnicos', 'Estudios universitarios'] as $level)
                            <option value="{{ $level }}" @selected(old('academic_level', $user->academic_level) === $level)>{{ $level }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('academic_level')" />
                </div>

                <div>
                    <x-input-label for="bachillerato_type" value="Tipo de bachillerato" />
                    <select id="bachillerato_type" name="bachillerato_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Selecciona una opción</option>
                        @foreach (['General', 'Técnico Vocacional Comercial', 'Técnico Vocacional Industrial', 'Técnico Vocacional Agropecuario', 'Técnico Vocacional en Salud', 'Técnico Vocacional en Informática', 'Bachillerato Nocturno', 'Otro'] as $type)
                            <option value="{{ $type }}" @selected(old('bachillerato_type', $user->bachillerato_type) === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('bachillerato_type')" />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 border-t border-gray-100 pt-5">
            <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700 hover:-translate-y-0.5 transition-all shadow-sm">
                {{ __('Guardar cambios') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-700 font-medium"
                >✓ {{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
