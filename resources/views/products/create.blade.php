@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 px-6">
        <!-- Card Container -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Add New Product</h1>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <!-- Success and Error Messages -->
            @if (Session::has('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-800 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ Session::get('error') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="ProductCode" class="block text-gray-700 font-medium">Product Code</label>
                    <input type="text" name="ProductCode" id="ProductCode"
                        class="w-full mt-1 p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('ProductCode') }}" placeholder="Enter product code" required>
                    @error('ProductCode')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">A unique identifier for the product</p>
                </div>

                <div class="mb-6">
                    <label for="ProductName" class="block text-gray-700 font-medium">Product Name</label>
                    <input type="text" name="ProductName" id="ProductName"
                        class="w-full mt-1 p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('ProductName') }}" placeholder="Enter product name" required>
                    @error('ProductName')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-500 mt-1">The display name of the product</p>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <button type="reset"
                        class="inline-flex items-center bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Form
                    </button>
                    <button type="submit"
                        class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
