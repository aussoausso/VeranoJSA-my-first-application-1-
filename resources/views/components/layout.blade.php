<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel App') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-purple-50 text-gray-900 font-sans">

    <!-- Navbar -->
    <nav class="bg-purple-700 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">{{ config('app.name', 'Laravel App') }}</h1>
<ul class="flex space-x-6">
    <li>
        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
    </li>
    <li>
        <x-nav-link href="/jobs" :active="request()->is('jobs*')">Jobs</x-nav-link>
    </li>
</ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex items-center justify-center h-[80vh]">
        <div class="text-center">
            <!-- Dynamic Heading -->
            <h2 class="text-4xl font-extrabold text-purple-800 mb-4">{{ $heading }}</h2>

            <!-- Dynamic Content -->
            <div class="text-lg text-gray-700 mb-6">
                {{ $slot }}
            </div>
        </div>
    </main>

</body>
</html>
