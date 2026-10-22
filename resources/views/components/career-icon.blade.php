{{-- Icono (emoji) que representa la carrera, en un recuadro tintado. --}}
@props(['career', 'size' => 'h-11 w-11 text-2xl'])

<div {{ $attributes->merge(['class' => "flex shrink-0 items-center justify-center rounded-xl bg-emerald-50 ring-1 ring-emerald-100 dark:bg-emerald-950/40 dark:ring-emerald-900 $size"]) }} aria-hidden="true">{{ $career->icon }}</div>
