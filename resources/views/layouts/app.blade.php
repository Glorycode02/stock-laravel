<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body class="bg-white">
    @if (session()->exists('loginId'))
    <header class="">
        <div class="container mx-auto">
            @include("layouts.navigation")
        </div>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
    @else
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
    @endif

    <footer class="bg-slate-600 text-slate-900 py-4 mt-12 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} XYShop. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
