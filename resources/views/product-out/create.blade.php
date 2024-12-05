@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Record Stock Out</h1>
            <a href="{{ route('product-out.index') }}"
                class="inline-flex items-center bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Stock Out List
            </a>
        </div>

        @if (Session::has('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('product-out.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="ProductCode" class="block text-sm font-medium text-gray-700">Select Product</label>
                <select name="ProductCode" id="ProductCode"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required>
                    <option value="">Choose a product...</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->ProductCode }}"
                            {{ old('ProductCode') == $product->ProductCode ? 'selected' : '' }}>
                            {{ $product->ProductName }} ({{ $product->ProductCode }})
                        </option>
                    @endforeach
                </select>
                @error('ProductCode')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="DateTime" class="block text-sm font-medium text-gray-700">Date & Time</label>
                <input type="datetime-local" name="DateTime" id="DateTime"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    value="{{ old('DateTime', now()->format('Y-m-d\TH:i')) }}" required>
                @error('DateTime')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="Quantity" id="Quantity"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('Quantity') }}" min="1" required>
                    @error('Quantity')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="UnitPrice" class="block text-sm font-medium text-gray-700">Unit Price</label>
                    <input type="number" name="UnitPrice" id="UnitPrice"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('UnitPrice') }}" min="0.01" step="0.01" required>
                    @error('UnitPrice')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="TotalPrice" class="block text-sm font-medium text-gray-700">Total Price</label>
                <input type="number" name="TotalPrice" id="TotalPrice"
                    class="mt-1 block w-full bg-gray-100 rounded-md border-gray-300 shadow-sm focus:ring-0" readonly>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Reset
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    Record Stock Out
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function calculateTotal() {
                const quantity = document.getElementById('Quantity').value || 0;
                const unitPrice = document.getElementById('UnitPrice').value || 0;
                const total = (quantity * unitPrice).toFixed(2);
                document.getElementById('TotalPrice').value = total;
            }

            document.getElementById('Quantity').addEventListener('input', calculateTotal);
            document.getElementById('UnitPrice').addEventListener('input', calculateTotal);

            calculateTotal();
        </script>
    @endpush
@endsection
