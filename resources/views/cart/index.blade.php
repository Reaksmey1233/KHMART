@extends('layouts.app')

@section('title', 'Shopping Cart - KHmart')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Shopping Cart</h1>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Cart Items ({{ $cartItems->count() }})</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $cartItem)
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        @if($cartItem->product->image)
                                            <img src="{{ asset('storage/' . $cartItem->product->image) }}" 
                                                 alt="{{ $cartItem->product->name }}" 
                                                 class="w-20 h-20 object-cover rounded-md">
                                        @else
                                            <div class="w-20 h-20 bg-gray-300 rounded-md flex items-center justify-center">
                                                <i class="fas fa-image text-2xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-gray-900">
                                            <a href="{{ route('products.show', $cartItem->product) }}" class="hover:text-blue-600">
                                                {{ $cartItem->product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $cartItem->product->category }}</p>
                                        
                                        <div class="flex items-center mt-2">
                                            @if($cartItem->product->discount > 0)
                                                <span class="text-lg font-bold text-red-600">${{ number_format($cartItem->product->discounted_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($cartItem->product->price, 2) }}</span>
                                            @else
                                                <span class="text-lg font-bold text-gray-900">${{ number_format($cartItem->product->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $cartItem) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="qty" value="{{ $cartItem->qty }}" min="1" max="99" 
                                                   class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center">
                                            <button type="submit" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900">${{ number_format($cartItem->subtotal, 2) }}</p>
                                        <p class="text-sm text-gray-500">{{ $cartItem->qty }} × ${{ number_format($cartItem->product->discounted_price, 2) }}</p>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <div class="flex-shrink-0">
                                        <form action="{{ route('cart.remove', $cartItem) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" 
                                                    onclick="return confirm('Are you sure you want to remove this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal ({{ $cartItems->sum('qty') }} items)</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between text-lg font-semibold text-gray-900">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout') }}" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold text-center block">
                        Proceed to Checkout
                    </a>
                    
                    <div class="mt-4 text-center">
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-arrow-left mr-1"></i>Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Your cart is empty</h3>
            <p class="text-gray-500 mb-6">Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
