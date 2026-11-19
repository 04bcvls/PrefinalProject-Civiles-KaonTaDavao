<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaon Ta! - Davao Civiles's Food Guide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900">
    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="text-xl font-bold text-red-700">
                Kaon Ta! - Davao Civiles's Food Guide
            </a>
            @include('partials.nav')
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @include('partials.flash')
        @yield('content')
    </main>
</body>
</html>