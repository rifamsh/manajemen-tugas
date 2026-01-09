@props(['active' => false])

<a {{ $attributes->merge([
    'class' => $active
        ? 'font-bold text-blue-600'
        : 'text-gray-700'
]) }}>
    {{ $slot }}
</a>
