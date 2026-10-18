<x-app-layout>
    {{-- HERO --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-slate-900 dark:via-slate-900 dark:to-emerald-950/20">
        <div class="blob w-80 h-80 bg-emerald-300/40 dark:bg-emerald-500/10 -top-24 -left-24" data-float></div>
        <div class="blob w-96 h-96 bg-teal-300/30 dark:bg-teal-500/10 top-1/3 -right-32" data-float></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28">
            <div class="max-w-2xl">
                <span data-animate="hero" data-animate-delay="0"
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300 text-sm font-medium mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Orientación académica para jóvenes de El Salvador
                </span>

                <h1 data-animate="hero" data-animate-delay="0.1" class="text-4xl sm:text-6xl font-bold text-gray-900 dark:text-slate-100 leading-[1.1]">
                    Explora tu futuro académico,
                    <span class="text-gradient">a tu ritmo</span>
                </h1>

                <p data-animate="hero" data-animate-delay="0.25" class="mt-6 text-lg text-gray-600 dark:text-slate-400 max-w-xl">
                    RutaJoven SV te ayuda a descubrir tus intereses, comparar carreras e
                    instituciones de El Salvador, y armar tu propia ruta académica. Sin
                    presión, sin decisiones tomadas por otros: la decisión siempre es tuya.
                </p>

                <div data-animate="hero" data-animate-delay="0.4" class="mt-8 flex flex-wrap gap-4">
                    @auth
                        <a href="{{ route('questionnaire.show') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all">
                            Hacer el cuestionario de intereses
                            <span class="transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white font-semibold rounded-lg shadow-lg shadow-emerald-600/20 hover:bg-emerald-700 hover:shadow-emerald-600/30 hover:-translate-y-0.5 transition-all">
                            Crear mi cuenta gratis
                            <span class="transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    @endauth
                    <a href="{{ route('careers.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur text-emerald-700 font-semibold rounded-lg shadow border border-emerald-200 hover:bg-white dark:bg-slate-800/80 dark:text-emerald-400 dark:border-emerald-800 dark:hover:bg-slate-800 hover:-translate-y-0.5 transition-all">
                        Explorar carreras
                    </a>
                </div>

                <div data-animate="hero" data-animate-delay="0.55" class="mt-10 flex items-center gap-6 text-sm text-gray-500 dark:text-slate-400">
                    <div class="flex -space-x-2">
                        @foreach (['bg-emerald-400','bg-teal-400','bg-emerald-500','bg-teal-500'] as $c)
                            <div class="w-8 h-8 rounded-full {{ $c }} border-2 border-white dark:border-slate-900"></div>
                        @endforeach
                    </div>
                    <span>Exploración, no imposición. La decisión siempre es tuya.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl shadow-gray-200/60 dark:shadow-none border border-gray-100 dark:border-slate-700 p-6 sm:p-8">
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-bold text-emerald-600 dark:text-emerald-400"><span data-counter="{{ $careersCount }}">0</span></div>
                <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">Carreras registradas</div>
            </div>
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-bold text-emerald-600 dark:text-emerald-400"><span data-counter="{{ $institutionsCount }}">0</span></div>
                <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">Instituciones</div>
            </div>
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-bold text-emerald-600 dark:text-emerald-400"><span data-counter="{{ $areas->count() }}">0</span></div>
                <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">Áreas académicas</div>
            </div>
            <div class="text-center">
                <div class="text-3xl sm:text-4xl font-bold text-emerald-600 dark:text-emerald-400"><span data-counter="100" data-counter-suffix="%">0%</span></div>
                <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">Exploración, no imposición</div>
            </div>
        </div>
    </div>

    {{-- CÓMO FUNCIONA --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-slate-100">¿Cómo funciona?</h2>
            <p class="text-gray-500 dark:text-slate-400 mt-3">Tres pasos simples para empezar a explorar tus opciones académicas.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach ([
                ['icon' => '🧭', 'title' => 'Responde el cuestionario', 'text' => 'Cuéntanos qué disfrutas hacer. Sin respuestas correctas o incorrectas.'],
                ['icon' => '📊', 'title' => 'Descubre tu perfil', 'text' => 'Visualiza tus áreas de mayor afinidad e identifica carreras para explorar.'],
                ['icon' => '🗺️', 'title' => 'Arma tu ruta', 'text' => 'Compara, guarda favoritos y construye tu propio plan académico.'],
            ] as $step)
                <div data-animate="up" data-animate-group="how" class="card-hover bg-white dark:bg-slate-800 p-6 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-2xl mb-4">{{ $step['icon'] }}</div>
                    <h3 class="font-semibold text-gray-900 dark:text-slate-100">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-2">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ÁREAS ACADÉMICAS --}}
    <div class="bg-gray-50 dark:bg-slate-800/40 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-slate-100">Áreas académicas</h2>
                <a href="{{ route('careers.index') }}" class="text-sm font-medium text-emerald-700 dark:text-emerald-400 hover:underline hidden sm:block">Ver todas →</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($areas as $area)
                    <a href="{{ route('careers.index', ['area' => $area->id]) }}" data-animate="up" data-animate-group="areas"
                        class="card-hover group block p-5 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm hover:border-emerald-200 dark:hover:border-emerald-700">
                        <div class="flex items-center justify-between">
                            <div class="font-semibold text-gray-900 dark:text-slate-100">{{ $area->name }}</div>
                            <span class="text-emerald-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 group-hover:translate-x-1 transition-all">→</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-slate-400 mt-1">{{ $area->careers_count }} {{ $area->careers_count === 1 ? 'carrera' : 'carreras' }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CARRERAS DESTACADAS --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex items-end justify-between mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-slate-100">Carreras destacadas</h2>
            <a href="{{ route('careers.index') }}" class="text-sm font-medium text-emerald-700 dark:text-emerald-400 hover:underline hidden sm:block">Ver todas →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($featuredCareers as $career)
                <a href="{{ route('careers.show', $career) }}" data-animate="up" data-animate-group="featured"
                    class="card-hover group relative block p-5 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-sm hover:border-emerald-200 dark:hover:border-emerald-700 overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full bg-emerald-50 dark:bg-emerald-950/30 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="text-xs uppercase tracking-wide text-emerald-600 dark:text-emerald-400 font-semibold">{{ $career->academicArea?->name }}</div>
                        <div class="font-semibold text-gray-900 dark:text-slate-100 mt-1">{{ $career->name }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- CTA FINAL --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div data-animate="up" class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-600 px-8 py-14 sm:py-16 text-center">
            <div class="blob w-72 h-72 bg-white/10 -bottom-16 -right-10" data-float></div>
            <div class="relative">
                <h2 class="text-2xl sm:text-3xl font-bold text-white">¿Listo para explorar tus opciones?</h2>
                <p class="text-emerald-50 mt-3 max-w-xl mx-auto">Crea tu cuenta gratis, responde el cuestionario y descubre qué carreras se alinean con tus intereses.</p>
                <div class="mt-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white text-emerald-700 font-semibold rounded-lg shadow hover:-translate-y-0.5 transition-all">Ir a mi dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-white text-emerald-700 font-semibold rounded-lg shadow hover:-translate-y-0.5 transition-all">Crear mi cuenta gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
