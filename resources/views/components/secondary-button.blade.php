<button {{ $attributes->merge(['type' => $attributes->get('type', 'button'), 'class' => 'btn btn-secondary']) }}>
    {{ $slot }}
</button>
