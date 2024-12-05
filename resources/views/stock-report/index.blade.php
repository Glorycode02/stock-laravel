@extends('layouts.app')

@section('content')
    <div class="card">
        <h1 class="text-2xl font-bold text-blue-900 mb-6">Stock Report</h1>

        <!-- Filters and Print Button -->
        <div class="flex justify-between items-center mb-6">
            <form method="GET" action="{{ route('stock-report.index') }}" class="flex items-center space-x-4">
                <label for="report_type" class="form-label text-green-700">Report Type:</label>
                <select name="report_type" id="report_type" onchange="this.form.submit()"
                    class="form-input w-40 border-gray-300 rounded-md shadow-sm">
                    <option value="daily" {{ $reportType == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ $reportType == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ $reportType == 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </form>
            <button id="print-btn" onclick="window.print()"
                class="btn btn-primary flex items-center bg-blue-500 text-white py-2 px-4 rounded shadow hover:bg-blue-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Report
            </button>
        </div>

        <!-- Table -->
        <div class="table-container overflow-x-auto bg-white shadow rounded-lg p-4">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="border border-gray-300 px-4 py-2">Product Code</th>
                        <th class="border border-gray-300 px-4 py-2">Product Name</th>
                        <th class="border border-gray-300 px-4 py-2">Total Stock In</th>
                        <th class="border border-gray-300 px-4 py-2">Total Stock Out</th>
                        <th class="border border-gray-300 px-4 py-2">Available Stock</th>
                        <th class="border border-gray-300 px-4 py-2">Total Price (Stock In)</th>
                        <th class="border border-gray-300 px-4 py-2">Total Price (Stock Out)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stockData as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $data['ProductCode'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $data['ProductName'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $data['TotalIn'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $data['TotalOut'] }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $data['AvailableStock'] > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $data['AvailableStock'] }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($data['TotalPriceIn'], 2) }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2">${{ number_format($data['TotalPriceOut'], 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">No stock data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
