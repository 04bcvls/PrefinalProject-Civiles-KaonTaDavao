@props(['eatery'])

@php
    $peso = match ($eatery->price_range) {
        'budget' => '₱',
        'mid' => '₱₱',
        'splurge' => '₱₱₱',
        default => '₱',
    };
@endphp

<article class="flex flex-col justify-between rounded-xl border border-stone-200 bg-white p-5 shadow-sm">
    <div>
        <div class="flex items-start justify-between gap-2">
            <h3 class="text-lg font-bold text-stone-900">
                <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-red-700">
                    {{ $eatery->name }}
                </a>
            </h3>
            @if (! $eatery->is_open)
                <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-700">
                    Closed
                </span>
            @endif
        </div>

        <div class="mt-1 flex items-center gap-2 text-sm text-stone-600">
            <a href="{{ route('districts.show', $eatery->district) }}" class="font-medium text-red-700 hover:underline">
                {{ $eatery->district->name }}
            </a>
            <span>•</span>
            <span class="font-semibold text-stone-800">{{ $peso }}</span>
        </div>

        @if ($eatery->specialty)
            <p class="mt-2 text-sm text-stone-700">
                Specialty: <span class="font-medium">{{ $eatery->specialty }}</span>
            </p>
        @endif

        <div class="mt-3 flex flex-wrap gap-1.5">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="rounded-md bg-stone-100 px-2 py-0.5 text-xs font-medium text-stone-700 hover:bg-red-100 hover:text-red-800">
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-4 flex items-center gap-2 border-t border-stone-100 pt-3 text-sm">
        @if ($eatery->reviews_count > 0)
            <x-rating :rating="$eatery->reviews_avg_rating" />
            <span class="font-semibold text-stone-800">
                {{ number_format($eatery->reviews_avg_rating, 1) }}
                ({{ $eatery->reviews_count }} {{ \Illuminate\Support\Str::plural('review', $eatery->reviews_count) }})
            </span>
        @else
            <span class="text-stone-500">No reviews yet</span>
        @endif
    </div>
</article>