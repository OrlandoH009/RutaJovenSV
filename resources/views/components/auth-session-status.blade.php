@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2 font-medium text-sm text-green-600 dark:text-green-400']) }}>
        <x-success-check class="h-4 w-4" />
        {{ $status }}
    </div>
@endif
