{{-- Logo PNG de la institución en un recuadro blanco (se ve bien con PNG transparentes en modo oscuro). Sin archivo: sigla. --}}
@props(['institution', 'size' => 'h-14 w-14'])

@php
    $acronym = \Illuminate\Support\Str::limit(explode(' · ', $institution->short_name)[0], 7, '');
    $big = str_contains($size, 'h-20');
    // Más letras → letra más chica para que la sigla siempre quepa en el recuadro.
    $textSize = match (true) {
        mb_strlen($acronym) <= 3 => $big ? 'text-3xl' : 'text-xl',
        mb_strlen($acronym) === 4 => $big ? 'text-2xl' : 'text-lg',
        default => $big ? 'text-xl' : 'text-sm',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white p-1.5 ring-1 ring-gray-200 dark:ring-slate-600 $size"]) }}>
    @if ($institution->logo_url)
        <img src="{{ $institution->logo_url }}" alt="Logo de {{ $institution->name }}" class="h-full w-full object-contain" loading="lazy">
    @else
        <span class="text-center font-extrabold leading-none tracking-tight text-emerald-700 {{ $textSize }}">{{ $acronym }}</span>
    @endif
</div>
