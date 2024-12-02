<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <style>
        @media print {
            table, th, td {
                border: 1px solid black;
            }
            .nav,#print-btn{
                display: none;
            }
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="bg-white overflow-ellipsis">
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

    <footer class=" text-slate-900 py-4 mt-12 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} XYShop. All rights reserved.</p>
        </div>
    </footer>
    @vite('resources/js/app.js')
</body>
</html>
