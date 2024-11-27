@extends('layouts.app')

@section('title', 'Product In List')

@section('content')

@if (session('success'))
<div class="text-center">
    <p class="text-green-600 font-bold">{{ session('success') }}</p>
</div>
@elseif(session('error'))
<div class="text-center text-red-600 font-bold"></div>
    <p>{{ session('error') }}</p>
</div>
@endif
<div id="loader" class="loader"></div>

<div class="flex w-full gap-5">
    <a href="{{route("product-in.create")}}" class="p-2 bg-gray-800 rounded-md text-white">Stock In</a>
    <h1 class="text-slate-950 font-bold">Stock In List</h1>
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
            @if ($productAll->count())
                @foreach ($productIns as $productIn)
                <tr>
                    <td>{{ $productIn->ProductCode }}</td>
                    <td><a href="{{route("product-in.show", $productIn->id)}}">{{ $productIn->product->ProductName }}</a></td>
                    <td>{{ $productIn->DateTime }}</td>
                    <td>{{ $productIn->Quantity }}</td>
                    <td>${{ number_format($productIn->UnitPrice, 2) }}</td>
                    <td>${{ number_format($productIn->TotalPrice, 2) }}</td>
                    <td>
        
                        <a href="{{route("product-in.edit", $productIn->id)}}" class="p-1 rounded-md bg-blue-600 text-white">Edit</a>
                        <form action="{{ route('product-in.destroy', $productIn->id) }}" method="POST" style="display:inline;">
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
    <p>No Stocked products</p>
    @endif
    
</div>

@endsection