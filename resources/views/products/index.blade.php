@extends('layouts.app')

@section('title', 'Products - KHmart')
@section('description', 'Browse our wide selection of products at KHmart')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Our Products</h1>
    
    <!-- Search and Filter -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search products..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="w-full md:w-48">
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="all">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </form>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">{{ $product->category }}</span>
                            @if($product->discount > 0)
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                    -{{ $product->discount }}%
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            @if($product->discount > 0)
                                <div>
                                    <span class="text-lg font-bold text-red-600">${{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                                </div>
                            @else
                                <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="qty" value="1" min="1" max="99" 
                                       class="w-16 px-2 py-2 border border-gray-300 rounded-md text-center">
                                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gray-600 text-white text-center px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                                Login to Add to Cart
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
            <p class="text-gray-500">Try adjusting your search or filter criteria.</p>
        </div>
    @endif
</div>
@endsection
