{{-- Check de éxito animado (círculo con rebote + trazo que se dibuja). Tokens --t-check-* en app.css --}}
<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" {{ $attributes->merge(['class' => 'h-5 w-5 shrink-0']) }}>
    <circle class="t-check-circle fill-emerald-500" cx="12" cy="12" r="11"/>
    <path class="t-check-mark" pathLength="1" d="M7 12.5l3.2 3.2L17 8.8" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
