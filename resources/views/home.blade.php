<x-app-layout>
    {{-- HERO --}}
    <section class="relative overflow-hidden">
        <div class="relative mx-auto max-w-5xl px-4 pt-16 pb-10 text-center sm:px-6 sm:pt-24">
            <span data-animate="hero" class="eyebrow">
                <span class="live-dot h-2 w-2 rounded-full bg-emerald-500"></span>
                Orientación académica para jóvenes de El Salvador
            </span>

            <h1 data-animate="words" data-animate-delay="0.1" class="display mt-6 text-5xl sm:text-7xl">
                Tu futuro académico, <span class="text-gradient">a tu ritmo.</span><br class="hidden sm:block">
                Una decisión que sí es tuya.
            </h1>

            <p data-animate="hero" data-animate-delay="0.5" class="mx-auto mt-6 max-w-xl text-base text-gray-500 dark:text-slate-400 sm:text-lg">
                Descubre tus intereses, compara carreras e instituciones de El Salvador y arma tu propia ruta académica. Sin presión, sin decisiones tomadas por otros.
            </p>

            <div data-animate="hero" data-animate-delay="0.65" class="mt-8 flex flex-wrap items-center justify-center gap-3">
                @auth
                    <a href="{{ route('questionnaire.show') }}" class="btn-primary">Hacer el cuestionario <span>→</span></a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">Crear mi cuenta gratis <span>→</span></a>
                @endauth
                <a href="{{ route('careers.index') }}" class="btn-secondary">Explorar carreras</a>
            </div>
        </div>

        {{-- Escena del hero: panel ancho con tarjetas flotantes --}}
        <div data-animate="up" class="relative mx-auto max-w-6xl px-4 sm:px-6">
            <div class="relative overflow-hidden rounded-3xl border border-gray-200 bg-gradient-to-br from-emerald-100 via-gray-100 to-teal-100 p-6 dark:border-slate-700 dark:from-emerald-950/60 dark:via-slate-800 dark:to-teal-950/50 sm:p-12">
                <div class="blob -left-10 top-10 h-64 w-64 bg-emerald-300/50 dark:bg-emerald-500/20" data-float></div>
                <div class="blob -right-10 bottom-0 h-72 w-72 bg-teal-300/50 dark:bg-teal-500/20" data-float></div>

                <svg class="absolute inset-0 h-full w-full text-emerald-600/30" viewBox="0 0 1000 400" preserveAspectRatio="none" fill="none" aria-hidden="true">
                    <path data-draw d="M-20 340 C 200 340, 220 120, 440 160 S 700 300, 1020 60" stroke="currentColor" stroke-width="3" stroke-dasharray="2 10" stroke-linecap="round"/>
                </svg>

                <div class="relative grid items-center gap-6 sm:grid-cols-5">
                    @auth
                        @if ($profile)
                            {{-- Con sesión y cuestionario hecho: su perfil real y la carrera que más concuerda --}}
                            <div class="surface p-5 sm:col-span-2" data-float>
                                <div class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Tu perfil de intereses</div>
                                @foreach ($topInterests as $label => $pct)
                                    <div class="mt-4">
                                        <div class="mb-1 flex justify-between text-sm text-gray-700 dark:text-slate-300"><span>{{ $label }}</span><span>{{ $pct }}%</span></div>
                                        <div class="h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-slate-700"><div data-bar="{{ $pct }}" class="h-full rounded-full bg-emerald-500"></div></div>
                                    </div>
                                @endforeach
                                <a href="{{ route('interest-profile.show') }}" class="mt-4 inline-flex text-sm font-medium text-emerald-600 hover:underline">Ver perfil completo →</a>
                            </div>

                            <div class="hidden sm:col-span-1 sm:block"></div>

                            <div class="surface p-5 sm:col-span-2" data-float>
                                <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">La carrera que más concuerda contigo</div>
                                @if ($bestCareer)
                                    <div class="mt-2 flex items-center gap-3">
                                        <x-career-icon :career="$bestCareer" size="h-12 w-12 text-2xl" />
                                        <div class="min-w-0">
                                            <div class="font-display text-2xl text-gray-900 dark:text-slate-100">{{ $bestCareer->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-slate-400">{{ $bestCareer->academicArea?->name }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-sm text-emerald-700 dark:text-emerald-400">{{ $bestCareer->affinity_score }}% de afinidad con tu perfil</div>
                                    <a href="{{ route('careers.show', $bestCareer) }}" class="mt-3 inline-flex text-sm font-medium text-emerald-600 hover:underline">Ver detalle →</a>
                                @else
                                    <div class="mt-2 font-display text-2xl text-gray-900 dark:text-slate-100">Aún sin coincidencias</div>
                                    <a href="{{ route('careers.index') }}" class="mt-4 inline-flex text-sm font-medium text-emerald-600 hover:underline">Explorar carreras →</a>
                                @endif
                            </div>
                        @else
                            {{-- Con sesión pero sin cuestionario: invitar a hacerlo --}}
                            <div class="surface p-5 sm:col-span-2" data-float>
                                <div class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Tu perfil de intereses</div>
                                <div class="mt-3 font-display text-2xl text-gray-900 dark:text-slate-100">Aún no lo tienes</div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Responde unas preguntas rápidas y verás qué áreas te interesan más.</p>
                            </div>

                            <div class="hidden sm:col-span-1 sm:block"></div>

                            <div class="surface p-5 sm:col-span-2" data-float>
                                <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">Primer paso</div>
                                <div class="mt-2 font-display text-2xl text-gray-900 dark:text-slate-100">Haz el cuestionario</div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Con tus respuestas te mostramos las carreras que más concuerdan contigo.</p>
                                <a href="{{ route('questionnaire.show') }}" class="btn-primary mt-4">Empezar cuestionario →</a>
                            </div>
                        @endif
                    @else
                    <div class="surface p-5 sm:col-span-2" data-float>
                        <div class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-slate-400">Tu perfil de intereses</div>
                        @foreach ([['Tecnología', 86], ['Ciencias', 64], ['Arte y diseño', 42]] as [$label, $pct])
                            <div class="mt-4">
                                <div class="mb-1 flex justify-between text-sm text-gray-700 dark:text-slate-300"><span>{{ $label }}</span><span>{{ $pct }}%</span></div>
                                <div class="h-2 overflow-hidden rounded-full bg-gray-200 dark:bg-slate-700"><div data-bar="{{ $pct }}" class="h-full rounded-full bg-emerald-500"></div></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="hidden sm:col-span-1 sm:block"></div>

                    <div class="surface p-5 sm:col-span-2" data-float>
                        <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">Carrera sugerida</div>
                        <div class="mt-2 font-display text-2xl text-gray-900 dark:text-slate-100">{{ $featuredCareers->first()?->name ?? 'Tu próxima carrera' }}</div>
                        <div class="mt-1 text-sm text-gray-500 dark:text-slate-400">{{ $featuredCareers->first()?->academicArea?->name }}</div>
                        <a href="{{ $featuredCareers->first() ? route('careers.show', $featuredCareers->first()) : route('careers.index') }}" class="mt-4 inline-flex text-sm font-medium text-emerald-600 hover:underline">Ver detalle →</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- MÉTRICAS --}}
    <section class="mx-auto max-w-5xl px-4 pt-24 text-center sm:px-6">
        <h2 data-animate="words" class="display text-3xl sm:text-5xl">Todo lo que necesitas para decidir, en un solo lugar.</h2>
        <div data-animate="up" class="mt-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-3 text-sm text-gray-500 dark:text-slate-400">
            <div><span class="text-2xl font-medium text-gray-900 dark:text-slate-100" data-counter="{{ $careersCount }}">0</span> carreras</div>
            <div><span class="text-2xl font-medium text-gray-900 dark:text-slate-100" data-counter="{{ $institutionsCount }}">0</span> instituciones</div>
            <div><span class="text-2xl font-medium text-gray-900 dark:text-slate-100" data-counter="{{ $areas->count() }}">0</span> áreas académicas</div>
        </div>
    </section>

    {{-- MARQUEE DE INSTITUCIONES --}}
    @if ($institutionNames->isNotEmpty())
        <div class="marquee-pause mt-12 overflow-hidden [mask-image:linear-gradient(to_right,transparent,#000_12%,#000_88%,transparent)]">
            <div class="animate-marquee flex w-max gap-4">
                @foreach ($institutionNames->concat($institutionNames) as $name)
                    <div class="surface whitespace-nowrap px-6 py-3 text-sm font-medium text-gray-700 dark:text-slate-300">{{ $name }}</div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ÁREAS (BENTO) --}}
    <section class="mx-auto max-w-6xl px-4 pt-24 sm:px-6">
        <div class="mb-8 flex items-end justify-between">
            <h2 data-animate="words" class="display text-3xl sm:text-4xl">Áreas académicas</h2>
            <a href="{{ route('careers.index') }}" class="hidden text-sm font-medium text-emerald-600 hover:underline sm:block">Ver todas →</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($areas as $area)
                <a href="{{ route('careers.index', ['area' => $area->id]) }}" data-animate="up" data-animate-group="areas"
                    class="surface card-hover group block p-6 hover:border-emerald-300 dark:hover:border-emerald-700">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl text-gray-900 dark:text-slate-100">{{ $area->name }}</div>
                        <span class="text-emerald-500 transition-transform group-hover:translate-x-1">→</span>
                    </div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-slate-400">{{ $area->careers_count }} {{ $area->careers_count === 1 ? 'carrera' : 'carreras' }}</div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- SHOWCASE --}}
    <section class="mx-auto max-w-6xl space-y-6 px-4 pt-24 sm:px-6">
        <div class="mx-auto mb-10 max-w-2xl text-center">
            <h2 data-animate="words" class="display text-3xl sm:text-5xl">Tres pasos para empezar a explorar.</h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            {{-- 1. Cuestionario → matching --}}
            <div data-animate="up" class="surface p-6 sm:p-8">
                <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">1 · Cuestionario</div>
                <h3 data-animate="words" class="display mt-2 text-2xl sm:text-3xl">Responde sin respuestas correctas.</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Cuéntanos qué disfrutas hacer y calculamos tu afinidad con cada área.</p>
                <div data-match class="mt-6 space-y-2">
                    @foreach (['Analizando tus respuestas', 'Calculando afinidad por área', 'Buscando carreras compatibles'] as $step)
                        <div class="match-row flex items-center gap-3 rounded-xl border border-gray-200 bg-gray-100/70 px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-900/40">
                            <span class="status"><svg class="hidden h-3 w-3 [.is-passed_&]:block" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2"><path d="M2.5 6.5l2.5 2.5 4.5-5"/></svg></span>
                            {{ $step }}
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 2. Ruta académica --}}
            <div data-animate="up" class="surface p-6 sm:p-8">
                <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">2 · Tu perfil y tu ruta</div>
                <h3 data-animate="words" class="display mt-2 text-2xl sm:text-3xl">Arma tu propio camino.</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Compara, guarda favoritos y construye tu plan académico paso a paso.</p>
                <svg class="mt-6 h-32 w-full text-emerald-500" viewBox="0 0 400 120" fill="none" aria-hidden="true">
                    <path data-draw d="M20 90 C 100 90, 110 30, 200 50 S 320 100, 380 30" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                    @foreach ([[20, 90], [200, 50], [380, 30]] as [$x, $y])
                        <circle cx="{{ $x }}" cy="{{ $y }}" r="7" class="fill-emerald-500"/>
                    @endforeach
                </svg>
                <div class="mt-2 flex justify-between text-xs text-gray-500 dark:text-slate-400"><span>Bachillerato</span><span>Carrera</span><span>Meta</span></div>
            </div>
        </div>

        {{-- 3. Simulador --}}
        <div data-animate="up" class="surface grid items-center gap-8 p-6 sm:p-8 lg:grid-cols-2">
            <div>
                <div class="text-xs font-medium uppercase tracking-wide text-emerald-600">3 · Simulador de costos</div>
                <h3 data-animate="words" class="display mt-2 text-2xl sm:text-3xl">Conoce cuánto cuesta antes de decidir.</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Estima matrícula y cuotas de cada institución y compáralas con claridad.</p>
            </div>
            <div class="space-y-4">
                @foreach ([['Universidad pública', 30], ['Universidad privada', 78]] as [$label, $pct])
                    <div>
                        <div class="mb-1 flex justify-between text-sm text-gray-700 dark:text-slate-300"><span>{{ $label }}</span></div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-gray-200 dark:bg-slate-700"><div data-bar="{{ $pct }}" class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-400"></div></div>
                    </div>
                @endforeach
                <p class="text-xs text-gray-400">Ilustrativo: los valores reales los calcula el simulador.</p>
            </div>
        </div>
    </section>

    {{-- BANDA OSCURA --}}
    <section class="mt-24 bg-[#1A1E23] py-20 text-gray-200">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-2">
            <div>
                <h2 data-animate="words" class="display !text-white text-3xl sm:text-5xl">Tu perfil explica cada recomendación.</h2>
                <p data-animate="up" class="mt-4 max-w-md text-gray-400">Sin cajas negras: ves por qué una carrera aparece en tus resultados y cuánto pesa cada interés.</p>
                <a href="{{ auth()->check() ? route('questionnaire.show') : route('register') }}" class="btn-primary mt-6">Descubrir mi perfil →</a>
            </div>
            <div data-type class="rounded-2xl border border-white/10 bg-black/30 p-5 font-mono text-sm leading-7 text-emerald-300 shadow-2xl">
                <div class="mb-3 flex gap-1.5"><span class="h-3 w-3 rounded-full bg-red-400/70"></span><span class="h-3 w-3 rounded-full bg-yellow-400/70"></span><span class="h-3 w-3 rounded-full bg-emerald-400/70"></span></div>
                <div data-type-line>$ rutajoven perfil --analizar</div>
                <div data-type-line class="text-gray-400">› Respuestas procesadas: 24</div>
                <div data-type-line class="text-gray-400">› Afinidad más alta: Tecnología (86%)</div>
                <div data-type-line class="text-gray-400">› Carreras compatibles encontradas</div>
                <div data-type-line>✓ Perfil listo</div>
            </div>
        </div>
    </section>

    {{-- CARRERAS DESTACADAS --}}
    <section class="mx-auto max-w-6xl px-4 pt-24 sm:px-6">
        <div class="mb-8 flex items-end justify-between">
            <h2 data-animate="words" class="display text-3xl sm:text-4xl">Carreras destacadas</h2>
            <a href="{{ route('careers.index') }}" class="hidden text-sm font-medium text-emerald-600 hover:underline sm:block">Ver todas →</a>
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featuredCareers as $career)
                <a href="{{ route('careers.show', $career) }}" data-animate="up" data-animate-group="featured"
                    class="surface card-hover group relative block overflow-hidden p-5 hover:border-emerald-300 dark:hover:border-emerald-700">
                    <div class="absolute -right-6 -top-6 h-20 w-20 rounded-full bg-emerald-100 transition-transform duration-500 group-hover:scale-150 dark:bg-emerald-950/40"></div>
                    <div class="relative">
                        <div class="text-xs font-semibold uppercase tracking-wide text-emerald-600">{{ $career->academicArea?->name }}</div>
                        <div class="mt-1 font-display text-xl text-gray-900 dark:text-slate-100">{{ $career->name }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="mx-auto max-w-6xl px-4 pt-24 sm:px-6">
        <div data-animate="up" class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-600 px-8 py-16 text-center">
            <div class="blob -bottom-16 -right-10 h-72 w-72 bg-white/10" data-float></div>
            <div class="relative">
                <h2 data-animate="words" class="display !text-white text-3xl sm:text-5xl">¿Listo para explorar tus opciones?</h2>
                <p class="mx-auto mt-4 max-w-xl text-emerald-50">Crea tu cuenta gratis, responde el cuestionario y descubre qué carreras se alinean con tus intereses.</p>
                <div class="mt-8">
                    <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="btn bg-white text-emerald-700 hover:-translate-y-0.5">{{ auth()->check() ? 'Ir a mi dashboard' : 'Crear mi cuenta gratis' }}</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
