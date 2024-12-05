@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-8">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Record Stock In</h1>
            <a href="{{ route('product-in.index') }}" class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                <span>Back to Stock In List</span>
            </a>
        </div>

        <!-- Success/Error Alerts -->
        @if(Session::has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ Session::get('success') }}
        </div>
        @endif

        @if(Session::has('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ Session::get('error') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('product-in.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Product Selection -->
            <div>
                <label for="ProductCode" class="block text-sm font-medium text-gray-700">Select Product</label>
                <select name="ProductCode" id="ProductCode" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">Choose a product...</option>
                    @foreach($products as $product)
                    <option value="{{ $product->ProductCode }}" {{ old('ProductCode') == $product->ProductCode ? 'selected' : '' }}>
                        {{ $product->ProductName }} ({{ $product->ProductCode }})
                    </option>
                    @endforeach
                </select>
                @error('ProductCode')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date and Time -->
            <div>
                <label for="DateTime" class="block text-sm font-medium text-gray-700">Date & Time</label>
                <input type="datetime-local" name="DateTime" id="DateTime" 
                       class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                       value="{{ old('DateTime', now()->format('Y-m-d\TH:i')) }}" 
                       required>
                @error('DateTime')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity and Unit Price -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="Quantity" id="Quantity" 
                           class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                           value="{{ old('Quantity') }}" 
                           min="1"
                           placeholder="Enter quantity"
                           required>
                    @error('Quantity')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="UnitPrice" class="block text-sm font-medium text-gray-700">Unit Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" name="UnitPrice" id="UnitPrice" 
                               class="mt-2 block w-full pl-7 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                               value="{{ old('UnitPrice') }}" 
                               min="0.01" 
                               step="0.01"
                               placeholder="0.00"
                               required>
                    </div>
                    @error('UnitPrice')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Total Price -->
            <div>
                <label for="TotalPrice" class="block text-sm font-medium text-gray-700">Total Price</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500">$</span>
                    </div>
                    <input type="number" name="TotalPrice" id="TotalPrice" 
                           class="mt-2 block w-full pl-7 bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" 
                           readonly>
                </div>
                <p class="text-sm text-gray-500 mt-2">This will be calculated automatically.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4">
                <button type="reset" class="px-6 py-2 text-gray-600 bg-gray-100 rounded shadow-sm hover:bg-gray-200 transition">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded shadow-sm hover:bg-indigo-700 transition">
                    Record Stock In
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Calculate total price automatically
    function calculateTotal() {
        const quantity = document.getElementById('Quantity').value || 0;
        const unitPrice = document.getElementById('UnitPrice').value || 0;
        const total = (quantity * unitPrice).toFixed(2);
        document.getElementById('TotalPrice').value = total;
    }

    document.getElementById('Quantity').addEventListener('input', calculateTotal);
    document.getElementById('UnitPrice').addEventListener('input', calculateTotal);

    // Calculate initial total
    calculateTotal();
</script>
@endpush
@endsection
