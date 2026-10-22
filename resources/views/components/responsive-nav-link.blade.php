@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-lg px-3 py-2 text-start text-base font-medium text-emerald-700 bg-emerald-50 dark:text-emerald-300 dark:bg-emerald-950/40 focus:outline-none transition duration-150'
            : 'block w-full rounded-lg px-3 py-2 text-start text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200/60 dark:text-slate-400 dark:hover:text-slate-100 dark:hover:bg-slate-800 focus:outline-none transition duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
