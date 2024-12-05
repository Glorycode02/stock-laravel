<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'XYShop - Inventory Management' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #eef2ff;
            --success: #059669;
            --success-light: #d1fae5;
            --danger: #dc2626;
            --danger-light: #fee2e2;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray-100);
            color: var(--gray-800);
        }

        @media print {
            table, th, td {
                border: 1px solid var(--gray-300);
            }
            .nav, #print-btn, .footer {
                display: none;
            }
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrap {
            flex: 1;
            padding-bottom: 5rem;
        }

        .footer {
            margin-top: auto;
        }

        .card {
            @apply bg-white rounded-xl shadow-sm border border-gray-200 p-8;
        }

        /* Form Styles */
        .form-group {
            @apply space-y-1.5;
        }

        .form-label {
            @apply block text-sm font-medium text-gray-700;
        }

        .form-input {
            @apply block w-full rounded-lg border-gray-300 shadow-sm 
                   focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-20 
                   transition duration-150 ease-in-out;
        }

        .form-input:disabled, .form-input[readonly] {
            @apply bg-gray-50 cursor-not-allowed;
        }

        .form-error {
            @apply mt-1 text-sm text-red-600;
        }

        .form-hint {
            @apply mt-1 text-sm text-gray-500;
        }

        /* Button Styles */
        .btn {
            @apply inline-flex items-center justify-center px-4 py-2 border border-transparent 
                   rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 
                   transition duration-150 ease-in-out;
        }

        .btn-primary {
            @apply bg-primary text-white hover:bg-primary-dark focus:ring-primary;
        }

        .btn-secondary {
            @apply bg-white text-gray-700 border-gray-300 hover:bg-gray-50 focus:ring-primary;
        }

        .btn-danger {
            @apply bg-danger text-white hover:bg-red-700 focus:ring-red-500;
        }

        /* Alert Styles */
        .alert {
            @apply p-4 rounded-lg border mb-6;
        }

        .alert-success {
            @apply bg-success-light border-success text-success;
        }

        .alert-error {
            @apply bg-danger-light border-danger text-danger;
        }

        /* Table Styles */
        .table-container {
            @apply bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden;
        }

        table {
            @apply w-full divide-y divide-gray-200;
        }

        thead {
            @apply bg-gray-50;
        }

        th {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
        }

        tbody {
            @apply bg-white divide-y divide-gray-200;
        }

        td {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900;
        }

        tr:hover {
            @apply bg-gray-50;
        }

        /* Badge Styles */
        .badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }

        .badge-success {
            @apply bg-success-light text-success;
        }

        .badge-danger {
            @apply bg-danger-light text-danger;
        }

        /* Select Styles */
        select.form-input {
            @apply pr-10;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Page Title Styles */
        .page-title {
            @apply text-2xl font-bold text-gray-900;
        }

        /* Section Styles */
        .section {
            @apply space-y-6;
        }

        .section-header {
            @apply flex justify-between items-center;
        }

        /* Grid Styles */
        .form-grid {
            @apply grid grid-cols-1 md:grid-cols-2 gap-6;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="page-container">
        <div class="content-wrap">
            @if (session()->exists('loginId'))
                <header>
                    @include("layouts.navigation")
                </header>

                <main class="container mx-auto px-4 py-8">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            @else
                <main class="container mx-auto px-4 py-8">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            @endif
        </div>

        <footer class="footer bg-white border-t border-gray-200 py-6">
            <div class="container mx-auto px-4 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} XYShop. All rights reserved.</p>
            </div>
        </footer>
    </div>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
