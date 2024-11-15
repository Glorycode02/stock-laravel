@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center font-bold text-xl">Stock Report</h1>
    <div id="loader" class="loader"></div>
    <!-- Report Type Filter -->
    <div class="flex justify-between">
        <form method="GET" action="{{ route('stock-report.index') }}">
            <div>
                <label for="report_type" class="text-xl text-slate-950 font-bold">Select Report Type:</label>
                <select name="report_type" id="report_type" onchange="this.form.submit()" class="border border-slate-500 outline-none">
                    <option value="daily" {{ $reportType == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ $reportType == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ $reportType == 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>
        </form>
        <button id="print-btn" onclick="printer()" class="p-2 bg-green-500 text-white rounded-md">Print</button>
    </div>

    <div class="flex justify-center bg-slate-900 max-h-80 overflow-auto items-center flex-col gap-5 mt-5">

        <table id="table" class="border border-slate-900 bg-slate-900 border-separate rounded-md w-full text-center shadow-xl">
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Total Stock In</th>
                    <th>Total Stock Out</th>
                    <th>Available Stock</th>
                    <th>Total Price (Stock In)</th>
                    <th>Total Price (Stock Out)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockData as $data)
                <tr>
                    <td>{{ $data['ProductCode'] }}</td>
                    <td>{{ $data['ProductName'] }}</td>
                    <td>{{ $data['TotalIn'] }}</td>
                    <td>{{ $data['TotalOut'] }}</td>
                    <td>{{ $data['AvailableStock'] }}</td>
                    <td>${{ number_format($data['TotalPriceIn'], 2) }}</td>
                    <td>${{ number_format($data['TotalPriceOut'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function printer() {
        const printContent = document.getElementById("table").innerHTML;
        const originalContent = document.body.innerHTML;

        // Add print-specific styles
        const styledContent = `
        <style>
            @media print {
                table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                    padding: 8px;
                    text-align: left;
                }
            }
        </style>
        ${printContent}
    `;

        document.body.innerHTML = styledContent;
        window.print();
        
        document.body.innerHTML = originalContent;
        location.reload();
    
    }
  
</script>
@endsection