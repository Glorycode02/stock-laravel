<nav class="bg-gray-800 p-4 nav">
    <div class="container mx-auto px-5 flex justify-between">
        <a href="/" class="text-white font-bold text-lg">XY shop</a>

        <div class="flex space-x-4">
            <a href="{{ route('dashboard') }}" 
               class="text-white px-3 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                Dashboard
            </a>
            
            <a href="{{ route('products.index') }}" 
               class="text-white px-3 py-2 rounded-md {{ request()->routeIs('products.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                Products
            </a>
            
            <a href="{{ route('product-in.index') }}" 
               class="text-white px-3 py-2 rounded-md {{ request()->routeIs('product-in.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                Stock In
            </a>
            
            <a href="{{ route('product-out.index') }}" 
               class="text-white px-3 py-2 rounded-md {{ request()->routeIs('product-out.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                Stock Out
            </a>
            
            <a href="{{ route('stock-report.index') }}" 
               class="text-white px-3 py-2 rounded-md {{ request()->routeIs('stock-report.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                Report
            </a>
        </div>

        <div class="relative group">
            <button class="text-white focus:outline-none">
                <span class="text-xl">🤖</span>
                <span class="ml-2">{{ $shopkeeper->UserName }}</span>
            </button>
            
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block">
                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                    @csrf
                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
