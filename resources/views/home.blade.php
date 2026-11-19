@extends('layouts.app')

@section('content')
    <section class="mb-8">
        <h1 class="text-2xl font-bold text-stone-900">Discover Davao's Best Carinderias</h1>
        <p class="mt-1 text-sm text-stone-600">Community-reviewed local eateries across Davao City.</p>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Eateries Listed</p>
                <p class="mt-1 text-3xl font-bold text-stone-900">{{ $counts['eateries'] }}</p>
            </div>
            <div class="rounded-xl border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Districts Covered</p>
                <p class="mt-1 text-3xl font-bold text-stone-900">{{ $counts['districts'] }}</p>
            </div>
            <div class="rounded-xl border border-stone-200 bg-white p-5">
                <p class="text-sm text-stone-500">Resident Reviews</p>
                <p class="mt-1 text-3xl font-bold text-stone-900">{{ $counts['reviews'] }}</p>
            </div>
        </div>
    </section>

    <section>
        <h2 class="mb-4 text-xl font-bold text-stone-900">Top Rated</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($topRated as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
    </section>
@endsection