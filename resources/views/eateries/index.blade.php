@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-2xl font-bold text-stone-900">All Eateries</h1>
    </div>

    <form method="GET" action="{{ route('eateries.index') }}" class="mb-8 grid grid-cols-1 gap-4 rounded-xl border border-stone-200 bg-white p-4 md:grid-cols-4">
        <div>
            <label for="q" class="block text-xs font-semibold uppercase text-stone-600">Search</label>
            <input type="text" id="q" name="q" value="{{ request('q') }}" placeholder="Name or specialty..."
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>

        <div>
            <label for="district" class="block text-xs font-semibold uppercase text-stone-600">District</label>
            <select id="district" name="district" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="">All Districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="feature" class="block text-xs font-semibold uppercase text-stone-600">Feature</label>
            <select id="feature" name="feature" class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                <option value="">All Features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') === $feature->name)>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                Filter
            </button>
            <a href="{{ route('eateries.index') }}" class="rounded-lg border border-stone-300 px-3 py-2 text-sm text-stone-700 hover:bg-stone-100">
                Reset
            </a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <div class="rounded-xl border border-stone-200 bg-white p-8 text-center text-stone-600">
            No eateries match your filters.
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection