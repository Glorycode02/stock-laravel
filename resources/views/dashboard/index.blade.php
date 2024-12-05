@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Stock In Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <h3 class="text-gray-600 text-sm font-medium mb-2">Total Stock In</h3>
            <p class="text-xl font-semibold text-gray-800">{{ number_format($totalStockStats['totalProductsIn']) }}</p>
            <p class="text-sm text-gray-500 mt-2">Total Value: ${{ number_format($totalStockStats['totalStockValueIn'], 2) }}</p>
        </div>

        <!-- Total Stock Out Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <h3 class="text-gray-600 text-sm font-medium mb-2">Total Stock Out</h3>
            <p class="text-xl font-semibold text-gray-800">{{ number_format($totalStockStats['totalProductsOut']) }}</p>
            <p class="text-sm text-gray-500 mt-2">Total Value: ${{ number_format($totalStockStats['totalStockValueOut'], 2) }}</p>
        </div>

        <!-- Current Stock Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <h3 class="text-gray-600 text-sm font-medium mb-2">Current Stock</h3>
            <p class="text-xl font-semibold text-gray-800">{{ number_format($totalStockStats['currentStock']) }}</p>
            <p class="text-sm text-gray-500 mt-2">Available Items</p>
        </div>

        <!-- Net Value Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <h3 class="text-gray-600 text-sm font-medium mb-2">Net Stock Value</h3>
            <p class="text-xl font-semibold text-gray-800">${{ number_format($totalStockStats['totalStockValueIn'] - $totalStockStats['totalStockValueOut'], 2) }}</p>
            <p class="text-sm text-gray-500 mt-2">Current Inventory Value</p>
        </div>
    </div>

    <!-- Top Products Table -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Top Products</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Product</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Quantity</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Total Value</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($topProducts as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->ProductName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">{{ number_format($product->total_quantity) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${{ number_format($product->total_value, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Transactions</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Product</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Quantity</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500">Value</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentTransactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->DateTime->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->product->ProductName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">{{ number_format($transaction->Quantity) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">${{ number_format($transaction->TotalPrice, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
