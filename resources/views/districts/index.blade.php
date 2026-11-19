@extends('layouts.app')

@section('content')
    <h1 class="mb-6 text-2xl font-bold text-stone-900">Davao City Districts</h1>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}"
               class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm hover:border-red-300">
                <h2 class="text-lg font-bold text-stone-900">{{ $district->name }}</h2>
                <p class="mt-1 text-sm text-stone-600">
                    {{ $district->eateries_count }} {{ \Illuminate\Support\Str::plural('eatery', $district->eateries_count) }}
                </p>
            </a>
        @endforeach
    </div>
@endsection