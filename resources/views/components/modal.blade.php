@props(['name' => null, 'show' => false, 'focusable' => false])
<div {{ $attributes->merge(['class' => 'modal-backdrop show']) }}>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
