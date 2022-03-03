<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button-main']) }}>
    {{ $slot }}
</button>
