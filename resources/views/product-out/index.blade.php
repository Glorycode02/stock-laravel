@extends('layouts.app')

@section('title', 'Product Out List')

@section('content')

<h1 class="text-center font-bold">Product  - Stock Out List</h1>

@if (session('success'))
<div class="text-center text-green-600 font-bold">
{{ session('success') }}</div>
@endif

<div id="loader" class="loader"></div>

<div class="flex justify-between w-full flex-row">
    <a href="{{route("product-out.create")}}" class="p-2 bg-gray-800 rounded-md text-white">Add Product Out</a>
</div>

<div class="flex justify-center bg-slate-900 max-h-80 overflow-auto items-center flex-col gap-5 mt-5">

    <table class="border border-slate-900 bg-slate-900 border-separate rounded-md w-full text-center shadow-xl">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="">
            @if ($productOuts->count())
                @foreach ($productOuts as $productOut)
                <tr>
                    <td>{{ $productOut->ProductCode }}</td>
                    <td><a href="{{route("product-in.show", $productOut->id)}}">{{ $productOut->product->ProductName }}</a></td>
                    <td>{{ $productOut->DateTime }}</td>
                    <td>{{ $productOut->Quantity }}</td>
                    <td>${{ number_format($productOut->UnitPrice, 2) }}</td>
                    <td>${{ number_format($productOut->TotalPrice, 2) }}</td>
                    <td>
        
                        <a href="{{route("product-out.edit", $productOut->id)}}" class="p-1 rounded-md bg-blue-600 text-white">Edit</a>
                        <form action="{{ route('product-out.destroy', $productOut->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="bg-red-600 rounded-md p-1  text-white">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
        </tbody>
    </table>
    <p>No Stocked out products?<a href="{{route("product-out.create")}}" class="underline text-blue-600">Add one</a></p>
    @endif
    
</div>
@endsection

