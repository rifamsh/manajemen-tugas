<button {{ $attributes->merge(['type' => $attributes->get('type', 'submit'), 'class' => 'btn btn-primary']) }}>
    {{ $slot }}
</button>
