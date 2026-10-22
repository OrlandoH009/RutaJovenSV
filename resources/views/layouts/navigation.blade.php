<div class="sticky top-0 z-40 px-3 pt-3 sm:px-4">
<nav
    x-data="{ open: false, scrolled: false, dark: document.documentElement.classList.contains('dark') }"
    @scroll.window="scrolled = window.scrollY > 24"
    :class="scrolled ? 'shadow-soft' : ''"
    class="mx-auto max-w-6xl rounded-2xl border border-gray-200 bg-gray-50/80 backdrop-blur-xl transition-shadow duration-300 dark:border-slate-700 dark:bg-slate-900/80"
>
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-5">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-8" />
                        <span class="font-display text-xl text-gray-900 hidden sm:inline dark:text-slate-100">RutaJoven SV</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden items-center gap-0.5 sm:ms-6 sm:flex">
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                    <x-nav-link :href="route('careers.index')" :active="request()->routeIs('careers.*')">
                        {{ __('Explorar carreras') }}
                    </x-nav-link>
                    <x-nav-link :href="route('institutions.index')" :active="request()->routeIs('institutions.*')">
                        {{ __('Instituciones') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('my-route.show')" :active="request()->routeIs('my-route.*')">
                            {{ __('Mi Ruta') }}
                        </x-nav-link>
                    @endauth
                    <x-nav-link :href="route('compare.index')" :active="request()->routeIs('compare.*')">
                        {{ __('Comparador') }}
                    </x-nav-link>
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.*')">
                        {{ __('Buscar') }}
                    </x-nav-link>
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                                {{ __('Administrador') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-4 sm:gap-1">
                <x-theme-toggle />

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-xl text-gray-600 hover:bg-gray-200/60 hover:text-gray-900 focus:outline-none transition duration-150 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100">
                                <div class="max-w-[8rem] truncate">{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('favorites.index')">

                                {{ __('Mis favoritos') }}

                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Mi perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-2 text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-slate-400 dark:hover:text-slate-100">{{ __('Iniciar sesión') }}</a>
                        <a href="{{ route('register') }}" class="btn-primary !py-2">{{ __('Crear cuenta') }}</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center gap-1 sm:hidden">
                <x-theme-toggle />

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-200/60 focus:outline-none transition duration-150 ease-in-out dark:text-slate-400 dark:hover:text-slate-200 dark:hover:bg-slate-800 dark:focus:bg-slate-800">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden px-2 pb-2">
        <div class="pt-1 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('careers.index')" :active="request()->routeIs('careers.*')">
                {{ __('Explorar carreras') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('institutions.index')" :active="request()->routeIs('institutions.*')">
                {{ __('Instituciones') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('my-route.show')" :active="request()->routeIs('my-route.*')">
                    {{ __('Mi Ruta') }}
                </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('compare.index')" :active="request()->routeIs('compare.*')">
                {{ __('Comparador') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('search.index')" :active="request()->routeIs('search.*')">
                {{ __('Buscar') }}
            </x-responsive-nav-link>
            @auth
                @if (auth()->user()->hasRole('admin'))
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                        {{ __('Administrador') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-700">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('favorites.index')">

                        {{ __('Mis favoritos') }}

                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Mi perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">{{ __('Iniciar sesión') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">{{ __('Crear cuenta') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
</div>
