@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500/30 rounded-xl shadow-sm transition dark:bg-slate-800 dark:border-slate-600 dark:text-slate-100 dark:placeholder-slate-500']) }}>
