@extends('layouts.app')

@section('title', 'Edit Product Out')

@section('content')
    <div class="max-w-4xl mx-auto mt-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Product Out</h1>
            <a href="{{ route('product-out.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Product Out List
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white shadow-md rounded-lg p-8">
            <form id="productOutForm" action="{{ route('product-out.update', $productOut->id) }}" method="POST"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Product Code -->
                <div>
                    <label for="ProductCode" class="block text-sm font-medium text-gray-700">Product Code</label>
                    <input type="text" name="ProductCode" id="ProductCode"
                        value="{{ old('ProductCode', $productOut->ProductCode) }}" readonly
                        class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Date -->
                <div>
                    <label for="DateTime" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="datetime-local" name="DateTime" id="DateTime"
                        value="{{ old('DateTime', $productOut->DateTime) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Quantity -->
                <div>
                    <label for="Quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="Quantity" id="Quantity"
                        value="{{ old('Quantity', $productOut->Quantity) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Unit Price -->
                <div>
                    <label for="UnitPrice" class="block text-sm font-medium text-gray-700">Unit Price</label>
                    <input type="number" step="0.01" name="UnitPrice" id="UnitPrice"
                        value="{{ old('UnitPrice', $productOut->UnitPrice) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-semibold px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        Update Product Out
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
