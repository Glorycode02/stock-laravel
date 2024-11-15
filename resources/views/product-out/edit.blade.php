@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center font-bold">Edit Product Out</h1>
    
    @if ($errors->any())
        <div class="text-center text-red-600 font-bold">>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-center">
    <form id="productInForm" action="{{ route('product-out.update', $productOut->id) }}" method="POST" class="border border-slate-900 shadow-md rounded-md p-4 w-1/2 flex gap-5 flex-col">
        @csrf
        @method('PUT')

        <div>
            <label for="ProductCode">Product Code:</label>
            <input type="text" name="ProductCode" id="ProductCode" value="{{ old('ProductCode', $productOut->ProductCode) }}" required class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" readonly>
        </div>

        <div>
            <label for="DateTime">Date:</label>
            <input type="datetime-local" name="DateTime" id="DateTime" value="{{ old('DateTime', $productOut->DateTime) }}" required class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none">
        </div>

        <div>
            <label for="Quantity">Quantity:</label>
            <input type="number" name="Quantity" id="Quantity" value="{{ old('Quantity', $productOut->Quantity) }}" required class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none">
        </div>

        <div>
            <label for="UnitPrice">Unit Price:</label>
            <input type="number" step="0.01" name="UnitPrice" id="UnitPrice" value="{{ old('UnitPrice', $productOut->UnitPrice) }}" required class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none">
        </div>

        <div>
            <button type="submit" class="bg-gray-900 p-4 w-full rounded-md text-white">Update Product Out</button>
        </div>
    </form>
</div>

<div>
</div>
@endsection
