@extends('layouts.app')

@section('content')
    @php
        $peso = match ($eatery->price_range) {
            'budget' => '₱',
            'mid' => '₱₱',
            'splurge' => '₱₱₱',
            default => '₱',
        };
    @endphp

    <div class="rounded-xl border border-stone-200 bg-white p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-stone-900">{{ $eatery->name }}</h1>
                    @if (! $eatery->is_open)
                        <span class="rounded-full bg-red-100 px-3 py-0.5 text-xs font-semibold text-red-700">Closed</span>
                    @endif
                </div>
                <p class="mt-1 text-sm text-stone-600">
                    <a href="{{ route('districts.show', $eatery->district) }}" class="font-semibold text-red-700 hover:underline">
                        {{ $eatery->district->name }}
                    </a>
                    • {{ $eatery->address }} • <span class="font-semibold">{{ $peso }}</span>
                </p>
                @if ($eatery->specialty)
                    <p class="mt-2 text-sm text-stone-700">Specialty: <strong>{{ $eatery->specialty }}</strong></p>
                @endif
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}"
                   class="rounded-lg border border-stone-300 px-4 py-2 text-sm font-semibold text-stone-700 hover:bg-stone-100">
                    Edit
                </a>
                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                   class="rounded-md bg-stone-100 px-2.5 py-1 text-xs font-medium text-stone-700 hover:bg-red-100">
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>

        @if ($eatery->permit)
            <div class="mt-6 rounded-lg border border-stone-200 bg-stone-50 p-4 text-sm">
                <p class="font-semibold text-stone-800">Business Permit: {{ $eatery->permit->permit_no }}</p>
                <p class="mt-0.5 text-stone-600">
                    Expires on: {{ $eatery->permit->expires_on->format('F j, Y') }}
                    @if ($eatery->permit->expires_on->lt(today()))
                        <span class="ml-2 font-bold text-red-600">Permit expired</span>
                    @endif
                </p>
            </div>
        @endif
    </div>

    <section class="mt-8 rounded-xl border border-stone-200 bg-white p-6">
        <h2 class="mb-4 text-xl font-bold text-stone-900">Menu &amp; Dishes</h2>
        @if ($eatery->dishes->isEmpty())
            <p class="text-sm text-stone-500">No dishes listed yet.</p>
        @else
            <ul class="divide-y divide-stone-100">
                @foreach ($eatery->dishes as $dish)
                    <li class="flex items-center justify-between py-3 text-sm">
                        <div>
                            <span class="font-medium text-stone-900">{{ $dish->name }}</span>
                            @if ($dish->is_bestseller)
                                <span class="ml-2 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800">
                                    Bestseller
                                </span>
                            @endif
                        </div>
                        <span class="font-semibold text-stone-800">₱{{ number_format($dish->price, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <section class="mt-8 rounded-xl border border-stone-200 bg-white p-6">
        <h2 class="mb-4 text-xl font-bold text-stone-900">Write a Review</h2>

        @if (! $eatery->is_open)
            <p class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm font-medium text-amber-800">
                This eatery is closed. Reviews are paused.
            </p>
        @else
            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-stone-700">Reviewer</label>
                        <select id="user_id" name="user_id" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                            <option value="">Select reviewer</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rating" class="block text-sm font-semibold text-stone-700">Rating (1–5)</label>
                        <select id="rating" name="rating" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                            @for ($r = 5; $r >= 1; $r--)
                                <option value="{{ $r }}" @selected(old('rating', 5) == $r)>{{ $r }} {{ \Illuminate\Support\Str::plural('Star', $r) }}</option>
                            @endfor
                        </select>
                        @error('rating')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="body" class="block text-sm font-semibold text-stone-700">Review</label>
                    <textarea id="body" name="body" rows="3" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                    Post Review
                </button>
            </form>
        @endif
    </section>

    <section class="mt-8 rounded-xl border border-stone-200 bg-white p-6">
        <h2 class="mb-4 text-xl font-bold text-stone-900">Reviews ({{ $eatery->reviews->count() }})</h2>
        @forelse ($eatery->reviews as $review)
            <div class="border-b border-stone-100 py-4 last:border-b-0">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <a href="{{ route('reviewers.show', $review->user) }}" class="font-semibold text-red-700 hover:underline">
                            {{ $review->user->name }}
                        </a>
                        <span class="ml-2"><x-rating :rating="$review->rating" /></span>
                        <span class="ml-2 text-xs text-stone-500">{{ $review->created_at->format('M j, Y') }}</span>
                    </div>

                    <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
                <p class="mt-2 text-sm text-stone-700">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-sm text-stone-500">No reviews yet.</p>
        @endforelse
    </section>
@endsection