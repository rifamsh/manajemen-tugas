@props(['align' => 'right', 'width' => '48'])

@php
$alignmentClasses = $align === 'left'
    ? 'origin-top-left left-0'
    : 'origin-top-right right-0';
@endphp

<div class="relative">
    <div>
        {{ $trigger }}
    </div>

    <div class="absolute z-50 mt-2 w-{{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white">
            {{ $content ?? $slot }}
        </div>
    </div>
</div>
