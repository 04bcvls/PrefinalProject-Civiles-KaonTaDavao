@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-stone-900">{{ $user->name }}</h1>
        <p class="mt-1 text-sm font-medium text-stone-600">
            {{ $user->reviews->count() }} {{ \Illuminate\Support\Str::plural('review', $user->reviews->count()) }} written
        </p>
    </div>

    <div class="space-y-4">
        @forelse ($user->reviews as $review)
            <div class="rounded-xl border border-stone-200 bg-white p-5">
                <div class="flex items-center justify-between">
                    <a href="{{ route('eateries.show', $review->eatery) }}" class="font-bold text-red-700 hover:underline">
                        {{ $review->eatery->name }}
                    </a>
                    <x-rating :rating="$review->rating" />
                </div>
                <p class="mt-2 text-sm text-stone-700">{{ $review->body }}</p>
            </div>
        @empty
            <p class="text-sm text-stone-500">No reviews written yet.</p>
        @endforelse
    </div>
@endsection