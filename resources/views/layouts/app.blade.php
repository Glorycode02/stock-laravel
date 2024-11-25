<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white">

    <header class="">
        <div class="container mx-auto">
            @include("layouts.navigation")
        </div>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

    <footer class="bg-slate-600 text-slate-900 py-4 mt-12 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} XYShop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
