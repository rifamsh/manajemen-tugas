@props(['user', 'size' => 50, 'name', 'avatar'])

@php
    $name = $name ?? ($user->name ?? 'User');
    $avatar = $avatar ?? ($user->avatar ?? null);
    $size = $size ?? 50;

    if ($avatar) {
        // If avatar is a full URL, use it; if it's already a storage URL, use it; otherwise build a storage URL that works with current host
        if (str_starts_with($avatar, 'http')) {
            $src = $avatar;
        } elseif (str_starts_with($avatar, '/storage') || str_starts_with($avatar, 'storage')) {
            $src = (str_starts_with($avatar, '/') ? $avatar : '/' . $avatar);
        } else {
            $src = asset('storage/' . ltrim($avatar, '/'));
        }
    } else {
        $src = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0D6EFD&color=fff&rounded=true&size=' . $size;
    }
@endphp

<img src="{{ $src }}" alt="{{ $name }}" class="rounded-circle" style="object-fit:cover; width: {{ $size }}px; height: {{ $size }}px; display:block; object-position:center;"> 
