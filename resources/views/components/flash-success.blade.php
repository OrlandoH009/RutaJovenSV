@props(['message'])

<div role="status" {{ $attributes->merge(['class' => 'flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/30 dark:text-emerald-300']) }}>
    <x-success-check class="h-6 w-6 shrink-0" />
    <span>{{ $message }}</span>
</div>
