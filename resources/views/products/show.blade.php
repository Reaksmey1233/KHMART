@extends('layouts.app')

@section('title', $product->name . ' - KHmart')
@section('description', $product->description)

@section('content')
<div class="mb-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover rounded-lg">
            @else
                <div class="w-full h-96 bg-gray-300 rounded-lg flex items-center justify-center">
                    <i class="fas fa-image text-6xl text-gray-400"></i>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            
            <div class="flex items-center mb-4">
                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $product->category }}</span>
                @if($product->discount > 0)
                    <span class="ml-3 bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">
                        -{{ $product->discount }}% OFF
                    </span>
                @endif
            </div>

            <div class="mb-6">
                @if($product->discount > 0)
                    <div class="flex items-center gap-3">
                        <span class="text-3xl font-bold text-red-600">${{ number_format($product->discounted_price, 2) }}</span>
                        <span class="text-xl text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm text-gray-500">You save ${{ number_format($product->price - $product->discounted_price, 2) }}</span>
                    </div>
                @else
                    <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product->description ?: 'No description available.' }}</p>
            </div>

            @auth
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div>
                        <label for="qty" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <input type="number" id="qty" name="qty" value="1" min="1" max="99" 
                               class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                        <i class="fas fa-cart-plus mr-2"></i>Add to Cart
                    </button>
                </form>
            @else
                <div class="space-y-4">
                    <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                        Login to Add to Cart
                    </a>
                    <p class="text-sm text-gray-500 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a></p>
                </div>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200">
                            @if($relatedProduct->image)
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-32 object-cover">
                            @else
                                <div class="w-full h-32 bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">
                                <a href="{{ route('products.show', $relatedProduct) }}" class="hover:text-blue-600">
                                    {{ $relatedProduct->name }}
                                </a>
                            </h3>
                            
                            <div class="flex items-center justify-between">
                                @if($relatedProduct->discount > 0)
                                    <span class="text-sm font-bold text-red-600">${{ number_format($relatedProduct->discounted_price, 2) }}</span>
                                @else
                                    <span class="text-sm font-bold text-gray-900">${{ number_format($relatedProduct->price, 2) }}</span>
                                @endif
                                
                                <a href="{{ route('products.show', $relatedProduct) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
