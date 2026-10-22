<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-red-600 text-white hover:bg-red-500 hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
