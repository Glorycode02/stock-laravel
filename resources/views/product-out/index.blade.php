@extends('layouts.app')

@section('title', 'Product Out List')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Product Out - Stock Out List</h1>
        <a href="{{ route('product-out.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Stock Out
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 text-center rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Loader -->
    <div id="loader" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="loader border-t-4 border-blue-500 w-12 h-12 rounded-full animate-spin"></div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">Product Code</th>
                    <th class="py-3 px-4 text-left font-medium">Product Name</th>
                    <th class="py-3 px-4 text-left font-medium">Date</th>
                    <th class="py-3 px-4 text-right font-medium">Quantity</th>
                    <th class="py-3 px-4 text-right font-medium">Unit Price</th>
                    <th class="py-3 px-4 text-right font-medium">Total Price</th>
                    <th class="py-3 px-4 text-center font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if ($productOuts->count())
                    @foreach ($productOuts as $productOut)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="py-3 px-4 text-gray-800">{{ $productOut->ProductCode }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('product-in.show', $productOut->id) }}" class="text-blue-600 hover:underline">
                                {{ $productOut->product->ProductName }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-gray-600">{{ $productOut->DateTime }}</td>
                        <td class="py-3 px-4 text-right text-gray-800">{{ $productOut->Quantity }}</td>
                        <td class="py-3 px-4 text-right text-gray-800">${{ number_format($productOut->UnitPrice, 2) }}</td>
                        <td class="py-3 px-4 text-right text-gray-800">${{ number_format($productOut->TotalPrice, 2) }}</td>
                        <td class="py-3 px-4 flex justify-center space-x-4">
                            <a href="{{ route('product-out.edit', $productOut->id) }}" class="text-indigo-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('product-out.destroy', $productOut->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7" class="py-6 text-center text-gray-600">
                        No stocked-out products yet? 
                        <a href="{{ route('product-out.create') }}" class="text-blue-600 hover:underline">Add one</a>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
