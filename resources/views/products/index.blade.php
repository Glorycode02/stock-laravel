@extends('layouts.app')

@section('content')
<div class="flex justify-between w-60 flex-row-reverse">
    <h1 class="text-slate-950 font-bold">Products</h1>
    <a href="{{route("products.create")}}" class="p-2 bg-gray-800 rounded-md text-white">Add product</a>
</div>
@if ($errors->any())
<div class="text-center text-red-600 font-bold">>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@elseif(session('error'))
<script>
    alert('Can not delete stocked product')
</script>
@endif

<div id="loader" class="loader"></div>
<div class="flex justify-center bg-slate-900 max-h-80 overflow-auto flex-col items-center gap-5">
    <table class="border border-slate-900 border-separate rounded-md w-1/2 text-center shadow-xl">
        <thead>
            <tr>
                <th class="">Product Code</th>
                <th>Product Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->count())
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->ProductCode }}</td>
                <td><a href="{{ route('products.show', $product->ProductCode) }}">{{ $product->ProductName }}</a></td>
                <td class="p-2">
                    <a href="{{ route('products.edit', $product->ProductCode) }}" class="p-1 rounded-md bg-blue-600 text-white">Edit</a>
                    <form action="{{ route('products.destroy', $product->ProductCode) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 rounded-md p-1  text-white">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else

        </tbody>
    </table>
    <p>No Products? <a href="{{route('products.create')}}" class="underline text-blue-600">Add one</a></p>
    @endif
</div>
@endsection