@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-4">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Product
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-800 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('error'))
            <script>
                alert('Cannot delete stocked product');
            </script>
        @endif

        <!-- Loader -->
        <div id="loader" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="loader border-t-4 border-blue-500 w-12 h-12 rounded-full animate-spin"></div>
        </div>

        <!-- Product Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left font-medium">Product Code</th>
                        <th class="py-3 px-4 text-left font-medium">Product Name</th>
                        <th class="py-3 px-4 text-center font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if ($products->count())
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="py-3 px-4 text-gray-800">{{ $product->ProductCode }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('products.show', $product->ProductCode) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $product->ProductName }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 flex justify-center space-x-4">
                                    <a href="{{ route('products.edit', $product->ProductCode) }}"
                                        class="text-indigo-600 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->ProductCode) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="py-6 text-center text-gray-600">
                                No products available yet?
                                <a href="{{ route('products.create') }}" class="text-blue-600 hover:underline">Add one</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
