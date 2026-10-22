@props(['class' => ''])

{{-- Alterna claro/oscuro con un "reveal" circular desde el botón (View Transitions API).
     Sin soporte o con movimiento reducido: cambio directo / fundido de colores. --}}
<button
    type="button"
    @click="
        const apply = () => {
            dark = !dark;
            document.documentElement.classList.toggle('dark', dark);
            localStorage.setItem('theme', dark ? 'dark' : 'light');
        };
        const root = document.documentElement;
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return apply();

        if (!document.startViewTransition) {
            root.classList.add('theme-fade');
            apply();
            setTimeout(() => root.classList.remove('theme-fade'), 500);
            return;
        }

        const box = $el.getBoundingClientRect();
        const x = box.left + box.width / 2, y = box.top + box.height / 2;
        root.style.setProperty('--t-theme-x', x + 'px');
        root.style.setProperty('--t-theme-y', y + 'px');
        root.style.setProperty('--t-theme-r', Math.hypot(Math.max(x, innerWidth - x), Math.max(y, innerHeight - y)) + 'px');
        document.startViewTransition(apply);
    "
    {{ $attributes->merge(['class' => 'group relative inline-flex h-9 w-9 items-center justify-center rounded-xl text-gray-500 transition duration-200 ease-out hover:bg-gray-200/60 hover:text-gray-800 active:scale-90 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 ' . $class]) }}
    :aria-label="dark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
>
    <span x-cloak class="relative block h-5 w-5 transition-transform duration-500 ease-out group-hover:rotate-12">
        <svg class="absolute inset-0 h-5 w-5 transition duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
            :class="dark ? 'rotate-90 scale-50 opacity-0' : 'rotate-0 scale-100 opacity-100'"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <svg class="absolute inset-0 h-5 w-5 transition duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
            :class="dark ? 'rotate-0 scale-100 opacity-100' : '-rotate-90 scale-50 opacity-0'"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 1020.354 15.354z" />
        </svg>
    </span>
</button>
