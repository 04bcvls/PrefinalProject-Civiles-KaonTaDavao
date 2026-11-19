@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl rounded-xl border border-stone-200 bg-white p-6">
        <h1 class="mb-6 text-2xl font-bold text-stone-900">Edit {{ $eatery->name }}</h1>

        <form method="POST" action="{{ route('eateries.update', $eatery) }}">
            @csrf
            @method('PUT')
            @include('eateries._form')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700">
                    Update Eatery
                </button>
                <a href="{{ route('eateries.show', $eatery) }}" class="text-sm text-stone-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection