@props(['rating' => 0])

@php
    $filled = (int) round($rating);
@endphp

<span class="inline-flex items-center text-amber-500" aria-label="{{ $rating }} out of 5 stars">
    @for ($i = 1; $i <= 5; $i++)
        <span>{{ $i <= $filled ? '★' : '☆' }}</span>
    @endfor
</span>