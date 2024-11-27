@extends('layouts.app')

@section('title', 'Product Out List')

@section('content')

{{-- <div class="flex justify-between w-80 flex-row-reverse">
    <h1 class="text-slate-950 font-bold">Product Out - Stock Out List</h1>
</div> --}}

@if (session('success'))
<div class="text-center text-green-600 font-bold">
{{ session('success') }}</div>
@endif

<div id="loader" class="loader"></div>

<div class="flex gap-5 w-full flex-row">
    <a href="{{route("product-out.create")}}" class="p-2 bg-gray-800 rounded-md text-white">Stock Out</a>
    <h1 class="text-slate-950 font-bold">Stock Out List</h1>
</div>

<div class="flex justify-center  max-h-80 overflow-auto items-center flex-col gap-5 mt-5">

    <table class="border border-slate-900 border-separate rounded-md w-full text-center shadow-2xl">
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

