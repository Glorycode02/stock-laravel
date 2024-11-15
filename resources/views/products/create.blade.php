@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<h1 class="text-center text-lg">Add New Product</h1>

@if ($errors->any())
<div class="text-center text-red-600 font-bold">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="">
    <a href="{{ route('products.index') }}" class="p-2 bg-gray-800 rounded-md text-white">Back to Products List</a>
</div>
<div class="flex justify-center">

    <form id="productForm" action="{{ route('products.store') }}" method="POST" class="flex justify-center w-96 flex-col border border-blue-900 shadow-xl rounded-md p-4 gap-4">
        @csrf

        <div class="flex">
            <label for="ProductCode">Product Code:</label>
            <input type="text" id="ProductCode" name="ProductCode" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" required>
            <span id="codeError" style="color:red; display:none;">Product Code already exists!</span>
        </div>

        <div>
            <label for="ProductName">Product Name:</label>
            <input type="text" id="ProductName" name="ProductName" class="w-60 bg-none rounded-md px-2 border border-slate-400 outline-none" required>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-gray-900 p-4 w-full rounded-md text-white">Add Product</button>
        </div>
    </form>

</div>

<script>
    document.getElementById('ProductCode').addEventListener('blur', function() {
        const productCode = this.value;

        // Check if the product code already exists in the database
        fetch(`/products/check-code/${productCode}`)
            .then(response => response.json())
            .then(data => {
                const codeError = document.getElementById('codeError');
                if (data.exists) {
                    codeError.style.display = 'inline';
                    document.getElementById('productForm').querySelector('button[type="submit"]').disabled = true;
                } else {
                    codeError.style.display = 'none';
                    document.getElementById('productForm').querySelector('button[type="submit"]').disabled = false;
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection