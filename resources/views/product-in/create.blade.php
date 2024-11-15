@extends('layouts.app')

@section('title', 'Add Product In')

@section('content')
<h1 class="text-center font-bold">Product In - Record Incoming Stock</h1>

@if ($errors->any())
<div class="text-center text-red-600 font-bold"></div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<a href="{{ route('product-in.index') }}" class="p-2 bg-gray-800 rounded-md text-white">Back to Product In List</a>
<div class="flex justify-center">
    
<form action="{{ route('product-in.store') }}" method="POST" class="border border-slate-600 w-1/2 mt-5 p-5 shadow-xl rounded-md flex flex-col gap-4">
    @csrf
    @method("POST")
    <div>
        <label for="ProductCode">Product Code:</label>
        <select id="ProductCode" name="ProductCode" required class="border border-slate-900 cursor-pointer outline-none px-2">
            <option value="" selected disabled>Select Product</option>
            @foreach($products as $product)
            <option value="{{ $product->ProductCode }}">{{ $product->ProductName }} ({{ $product->ProductCode }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="DateTime">Date:</label>
        <input type="datetime-local" id="DateTime" name="DateTime" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" required>
    </div>

    <div>
        <label for="Quantity">Quantity:</label>
        <input type="number" id="Quantity" name="Quantity" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" required>
    </div>

    <div>
        <label for="UnitPrice">Unit Price:</label>
        <input type="number" step="0.01" id="UnitPrice" name="UnitPrice" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" required>
    </div>

    <div>
        <label for="TotalPrice">Total Price:</label>
        <input type="number" step="0.01" id="TotalPrice" name="TotalPrice" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" readonly>
    </div>

    <button type="submit" class="bg-gray-900 p-4 w-full rounded-md text-white">Record Product In</button>
</form>

</div>

<script>
    document.getElementById('Quantity').addEventListener('input', calculateTotalPrice);
    document.getElementById('UnitPrice').addEventListener('input', calculateTotalPrice);

    function calculateTotalPrice() {
        const quantity = document.getElementById('Quantity').value;
        const unitPrice = document.getElementById('UnitPrice').value;
        const totalPrice = document.getElementById('TotalPrice');

        if (quantity && unitPrice) {
            totalPrice.value = (quantity * unitPrice).toFixed(2);
        }
    }
</script>
@endsection
