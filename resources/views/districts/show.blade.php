@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-stone-900">{{ $district->name }}</h1>
        <p class="mt-1 text-sm font-medium text-stone-600">
            {{ $reviewCount }} {{ \Illuminate\Support\Str::plural('review', $reviewCount) }} in {{ $district->name }}
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endsection