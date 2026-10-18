<x-app-layout>
    <x-slot name="header">
        <h2 data-animate="hero" class="font-semibold text-xl text-gray-800 dark:text-slate-100 leading-tight">Mi Ruta</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <p data-animate="hero" data-animate-delay="0.1" class="text-sm text-gray-500 dark:text-slate-400 mb-6">
                Tu ruta es tu plan personal: define qué estás explorando, junta las opciones
                que te interesan y anota tus próximos pasos. Puedes volver a editarla cuando
                quieras — nada aquí es definitivo.
            </p>

            @if (session('status'))
                <div data-animate="hero" class="p-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-800 dark:text-emerald-300 rounded-lg text-sm mb-6">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div data-animate="hero" class="p-4 bg-red-50 dark:bg-red-950/30 text-red-700 dark:text-red-400 rounded-lg text-sm mb-6">
                    No se pudo guardar tu ruta. {{ $errors->first() }}
                </div>
            @endif

            <div class="relative">
                {{-- Línea del recorrido --}}
                <div class="hidden sm:block absolute left-5 top-10 bottom-10 w-0.5 bg-gradient-to-b from-emerald-300 via-emerald-200 to-transparent"></div>

                <div class="space-y-8">
                    {{-- Paso 1: Objetivo --}}
                    <div data-animate="up" class="relative sm:pl-14">
                        <div class="hidden sm:flex absolute left-0 top-0 w-10 h-10 rounded-full bg-emerald-600 text-white items-center justify-center font-bold shadow-lg shadow-emerald-600/30">1</div>
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="sm:hidden text-lg">🎯</span>
                                <h3 class="font-semibold text-gray-900 dark:text-slate-100">Mi objetivo</h3>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-4">¿Qué estás tratando de decidir en este momento?</p>

                            <form method="POST" action="{{ route('my-route.update') }}" x-data="{ steps: @js($route->next_steps ?: ['']) }">
                                @csrf
                                @method('PUT')

                                <textarea name="goal_text" rows="2" class="w-full rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 dark:placeholder:text-slate-500 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                    placeholder="Ej. Explorar carreras relacionadas con tecnología">{{ $route->goal_text }}</textarea>

                                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mt-5 mb-1">Próximos pasos</label>
                                <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">Cosas concretas que necesitas averiguar o hacer.</p>
                                <template x-for="(step, index) in steps" :key="index">
                                    <div class="flex gap-2 mb-2">
                                        <input type="text" :name="`next_steps[${index}]`" x-model="steps[index]"
                                            class="flex-1 min-w-0 rounded-md border-gray-300 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 dark:placeholder:text-slate-500 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                            placeholder="Ej. Investigar requisitos de admisión">
                                        <button type="button" @click="steps.splice(index, 1)" class="px-3 text-gray-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 transition">✕</button>
                                    </div>
                                </template>
                                <button type="button" @click="steps.push('')" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline mb-4">+ Agregar paso</button>

                                <div>
                                    <button type="submit" class="w-full sm:w-auto px-5 py-2 bg-emerald-600 text-white rounded-md font-medium hover:bg-emerald-700 hover:-translate-y-0.5 transition-all shadow-sm">Guardar ruta</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Paso 2: Opciones --}}
                    <div data-animate="up" class="relative sm:pl-14">
                        <div class="hidden sm:flex absolute left-0 top-0 w-10 h-10 rounded-full bg-emerald-600 text-white items-center justify-center font-bold shadow-lg shadow-emerald-600/30">2</div>
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="sm:hidden text-lg">📋</span>
                                <h3 class="font-semibold text-gray-900 dark:text-slate-100">Opciones que estoy considerando</h3>
                            </div>
                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-4">Las carreras e instituciones que quieres seguir de cerca.</p>

                            @if ($route->exists && $route->items->isNotEmpty())
                                <ul class="space-y-2 mb-6">
                                    @foreach ($route->items as $item)
                                        <li data-animate="up" data-animate-group="route-items"
                                            class="card-hover flex items-center justify-between gap-3 p-3 rounded-lg border-l-4 {{ $item->career ? 'border-emerald-400 bg-emerald-50/40 dark:bg-emerald-950/30' : 'border-teal-400 bg-teal-50/40 dark:bg-teal-950/30' }} border border-gray-100 dark:border-slate-700">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <span class="text-xl">{{ $item->career ? '🎓' : '🏫' }}</span>
                                                <div class="min-w-0">
                                                    <span class="font-medium text-gray-900 dark:text-slate-100">{{ $item->career->name ?? $item->institution->name }}</span>
                                                    <div class="text-xs text-gray-500 dark:text-slate-400">{{ $item->career ? 'Carrera' : 'Institución' }}</div>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('my-route.items.remove', $item) }}" class="shrink-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-gray-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 transition">Quitar</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-6 mb-6 rounded-lg border-2 border-dashed border-gray-200 dark:border-slate-700">
                                    <div class="text-2xl mb-1">🧐</div>
                                    <p class="text-sm text-gray-500 dark:text-slate-400">Aún no has agregado carreras ni instituciones a tu ruta.</p>
                                    <a href="{{ route('careers.index') }}" class="text-sm text-emerald-700 dark:text-emerald-400 hover:underline font-medium">Empieza explorando carreras →</a>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t border-gray-100 dark:border-slate-700 pt-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Carreras guardadas</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($savedCareers as $saved)
                                            <form method="POST" action="{{ route('my-route.items.add') }}">
                                                @csrf
                                                <input type="hidden" name="career_id" value="{{ $saved->career_id }}">
                                                <button type="submit"
                                                    class="group inline-flex items-center gap-1.5 pl-3 pr-2.5 py-1.5 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition">
                                                    🎓 {{ $saved->career->name }}
                                                    <span class="text-emerald-400 group-hover:text-white transition">+</span>
                                                </button>
                                            </form>
                                        @empty
                                            <p class="text-sm text-gray-400 dark:text-slate-500">No tienes carreras guardadas.</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Instituciones guardadas</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($savedInstitutions as $saved)
                                            <form method="POST" action="{{ route('my-route.items.add') }}">
                                                @csrf
                                                <input type="hidden" name="institution_id" value="{{ $saved->institution_id }}">
                                                <button type="submit"
                                                    class="group inline-flex items-center gap-1.5 pl-3 pr-2.5 py-1.5 rounded-full text-xs font-medium bg-teal-50 dark:bg-teal-950/30 text-teal-700 dark:text-teal-400 border border-teal-100 dark:border-teal-900 hover:bg-teal-600 hover:text-white hover:border-teal-600 transition">
                                                    🏫 {{ $saved->institution->name }}
                                                    <span class="text-teal-400 group-hover:text-white transition">+</span>
                                                </button>
                                            </form>
                                        @empty
                                            <p class="text-sm text-gray-400 dark:text-slate-500">No tienes instituciones guardadas.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Paso 3: Seguir explorando --}}
                    <div data-animate="up" class="relative sm:pl-14">
                        <div class="hidden sm:flex absolute left-0 top-0 w-10 h-10 rounded-full bg-emerald-600 text-white items-center justify-center font-bold shadow-lg shadow-emerald-600/30">3</div>
                        <div class="bg-gradient-to-br from-emerald-600 to-teal-600 p-6 rounded-xl shadow-sm text-white">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-lg">🧭</span>
                                <h3 class="font-semibold">Seguir explorando</h3>
                            </div>
                            <p class="text-sm text-emerald-50 mb-4">Cuantas más opciones conozcas, con más calma podrás decidir.</p>
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('careers.index') }}" class="px-4 py-2 bg-white text-emerald-700 rounded-md text-sm font-semibold hover:-translate-y-0.5 transition-all">Explorar carreras</a>
                                <a href="{{ route('institutions.index') }}" class="px-4 py-2 bg-white/15 text-white border border-white/30 rounded-md text-sm font-semibold hover:bg-white/25 hover:-translate-y-0.5 transition-all">Ver instituciones</a>
                                <a href="{{ route('compare.index') }}" class="px-4 py-2 bg-white/15 text-white border border-white/30 rounded-md text-sm font-semibold hover:bg-white/25 hover:-translate-y-0.5 transition-all">Comparar carreras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
