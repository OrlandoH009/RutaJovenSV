{{-- Botón "me gusta" (corazón con pop + ráfaga). Con $action guarda por AJAX (la ruta responde JSON);
     con `guest` abre el modal login-prompt. Tokens --t-like-* en app.css --}}
@props(['action' => null, 'liked' => false, 'text' => false, 'guest' => false])

<form method="POST" action="{{ $action }}"
    x-data="{
        liked: @js((bool) $liked), burst: false,
        async toggle() {
            @if ($guest)
                return $dispatch('open-modal', 'login-prompt');
            @endif
            this.liked = !this.liked;
            if (this.liked) { this.burst = true; setTimeout(() => this.burst = false, 800); }
            try {
                const res = await fetch($el.action, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Accept': 'application/json' } });
                if (!res.ok) throw new Error();
                this.liked = (await res.json()).saved;
            } catch (e) { this.liked = !this.liked; }
        }
    }"
    @submit.prevent="toggle()"
    {{ $attributes->only(['class', 'data-animate', 'data-animate-delay']) }}
>
    @csrf
    <button type="submit" :aria-pressed="liked.toString()" :aria-label="liked ? 'Quitar de favoritos' : 'Guardar en favoritos'"
        :class="{ 'is-liked': liked, 'is-burst': burst }"
        class="t-like group relative inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50/90 text-sm font-medium text-gray-600 backdrop-blur cursor-pointer transition duration-200 hover:scale-110 hover:border-rose-300 hover:bg-rose-50 hover:text-rose-500 hover:shadow-md active:scale-95 dark:hover:border-rose-700 dark:hover:bg-rose-950/30 dark:border-slate-700 dark:bg-slate-800/90 dark:text-slate-300 {{ $text ? 'px-4 py-2' : 'h-9 w-9 justify-center' }}">
        <span class="relative block h-5 w-5">
            <svg class="t-like-icon h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 20.5s-7.5-4.6-9.2-9.4C1.6 7.7 3.7 4.5 7 4.5c2 0 3.4 1 5 3 1.6-2 3-3 5-3 3.3 0 5.4 3.2 4.2 6.6-1.7 4.8-9.2 9.4-9.2 9.4z"/>
            </svg>
            @foreach ([0, 60, 120, 180, 240, 300] as $angle)
                <i class="t-like-dot" style="--a: {{ $angle }}deg"></i>
            @endforeach
        </span>
        @if ($text)
            <span x-text="liked ? 'Guardada' : 'Guardar'">{{ $liked ? 'Guardada' : 'Guardar' }}</span>
        @endif
    </button>
</form>
