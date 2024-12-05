@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 px-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Edit Product</h1>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Products List
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-800 rounded-md">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('products.update', $product->ProductCode) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Product Code -->
                <div>
                    <label for="ProductCode" class="block text-gray-700 font-medium">Product Code</label>
                    <input type="text" id="ProductCode" name="ProductCode"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-500 cursor-not-allowed"
                        value="{{ old('ProductCode', $product->ProductCode) }}" readonly>
                </div>

                <!-- Product Name -->
                <div>
                    <label for="ProductName" class="block text-gray-700 font-medium">Product Name</label>
                    <input type="text" id="ProductName" name="ProductName"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('ProductName', $product->ProductName) }}" required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition">
                    Update Product
                </button>
            </form>
        </div>
    </div>
@endsection
