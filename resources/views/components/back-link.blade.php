@props(['href', 'label' => 'Volver'])

<a href="{{ $href }}" data-animate="hero"
    class="group inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-emerald-700 transition-colors mb-4">
    <span class="inline-block transition-transform group-hover:-translate-x-1">←</span>
    {{ $label }}
</a>
