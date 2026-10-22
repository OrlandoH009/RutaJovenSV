@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-900 bg-gray-200/70 dark:text-slate-100 dark:bg-slate-800 focus:outline-none transition duration-150'
            : 'inline-flex items-center rounded-lg px-3 py-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-200/50 dark:text-slate-400 dark:hover:text-slate-100 dark:hover:bg-slate-800/70 focus:outline-none transition duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
