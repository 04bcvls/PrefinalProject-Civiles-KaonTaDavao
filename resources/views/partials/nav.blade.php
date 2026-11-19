<nav class="flex flex-wrap items-center gap-4 text-sm font-medium">
    <a href="{{ route('home') }}" class="text-stone-700 hover:text-red-700">Home</a>
    <a href="{{ route('eateries.index') }}" class="text-stone-700 hover:text-red-700">Eateries</a>
    <a href="{{ route('districts.index') }}" class="text-stone-700 hover:text-red-700">Districts</a>
    <a href="{{ route('eateries.create') }}" class="rounded-lg bg-red-600 px-3 py-1.5 text-white hover:bg-red-700">
        Add Eatery
    </a>
</nav>