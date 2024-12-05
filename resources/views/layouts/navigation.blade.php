<nav class="bg-white border-b border-gray-100" x-data="{ open: false, mobileMenuOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex justify-between h-16">
            <!-- Logo and primary navigation -->
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">XYshop</a>
                </div>

                <div class="hidden sm:ml-8 sm:flex sm:space-x-2">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-md transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('products.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-md transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Products
                    </a>
                    
                    <a href="{{ route('product-in.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('product-in.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-md transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Stock In
                    </a>
                    
                    <a href="{{ route('product-out.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('product-out.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-md transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                        Stock Out
                    </a>
                    
                    <a href="{{ route('stock-report.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium {{ request()->routeIs('stock-report.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }} rounded-md transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Report
                    </a>
                </div>
            </div>

            <!-- User dropdown -->
            <div class="flex items-center">
                <div class="relative">
                    <button @click="open = !open" 
                            class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none transition-colors duration-150 p-2 rounded-md hover:bg-gray-50">
                        <img class="h-8 w-8 rounded-full bg-indigo-100 p-1" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($shopkeeper->UserName) }}&color=4F46E5&background=EEF2FF" 
                             alt="{{ $shopkeeper->UserName }}">
                        <span>{{ $shopkeeper->UserName }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5"
                         style="display: none;">
                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 text-left">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" 
         @click.away="mobileMenuOpen = false"
         class="sm:hidden"
         style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }}">
                Dashboard
            </a>
            
            <a href="{{ route('products.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('products.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }}">
                Products
            </a>
            
            <a href="{{ route('product-in.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('product-in.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }}">
                Stock In
            </a>
            
            <a href="{{ route('product-out.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('product-out.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }}">
                Stock Out
            </a>
            
            <a href="{{ route('stock-report.index') }}" 
               class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('stock-report.*') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-500 hover:text-indigo-600 hover:bg-gray-50' }}">
                Report
            </a>
        </div>
    </div>
</nav>

<!-- Add Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
