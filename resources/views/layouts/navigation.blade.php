<nav class="bg-gray-800 p-4 nav">
    <div class="container mx-auto px-5 flex justify-between">

        <a href="/" class="text-white font-bold text-lg">XY shop</a>

        <div class="flex space-x-4">
            <a href="{{ route('products.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md">Products</a>
            <a href="{{ route('product-in.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md">Stock In</a>
            <a href="{{ route('product-out.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md">Stock Out</a>
            <a href="{{ route('stock-report.index') }}" class="text-white hover:bg-gray-700 px-3 py-2 rounded-md">Report</a>
        </div>

        <div class="w-10 h-10 rounded-full flex items-center justify-center relative group">
            <label>
                <span class="text-xl text-white cursor-pointer">🤖</span>
            </label>

            <div class="absolute top-10 left-0 bg-gray-800 p-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="text-white">
                        Logout ({{ ucfirst(explode(' ', $shopkeeper->UserName)[0]) }})
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
