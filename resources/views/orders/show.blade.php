@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - KHmart')

@section('content')
<div class="mb-8">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('orders.index') }}" class="hover:text-blue-600">My Orders</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Order #{{ $order->id }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Header -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                        <p class="text-gray-600">{{ $order->formatted_date }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0 text-right">
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                        <div class="flex items-center justify-end space-x-2 mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($order->delivery === 'delivered') bg-green-100 text-green-800
                                @elseif($order->delivery === 'shipped') bg-blue-100 text-blue-800
                                @elseif($order->delivery === 'processing') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($order->delivery) }}
                            </span>
                            @if($order->paid)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Paid
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    Unpaid
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Progress -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Progress</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-medium">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Order Placed</p>
                                    <p class="text-sm text-gray-500">{{ $order->formatted_date }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 @if(in_array($order->delivery, ['processing', 'shipped', 'delivered'])) bg-green-600 text-white @else bg-gray-300 text-gray-500 @endif rounded-full flex items-center justify-center text-sm font-medium">
                                    @if(in_array($order->delivery, ['processing', 'shipped', 'delivered']))
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-cog"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Processing</p>
                                    <p class="text-sm text-gray-500">Preparing your order</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 @if(in_array($order->delivery, ['shipped', 'delivered'])) bg-green-600 text-white @else bg-gray-300 text-gray-500 @endif rounded-full flex items-center justify-center text-sm font-medium">
                                    @if(in_array($order->delivery, ['shipped', 'delivered']))
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-truck"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Shipped</p>
                                    <p class="text-sm text-gray-500">On the way to you</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 @if($order->delivery === 'delivered') bg-green-600 text-white @else bg-gray-300 text-gray-500 @endif rounded-full flex items-center justify-center text-sm font-medium">
                                    @if($order->delivery === 'delivered')
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-home"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Delivered</p>
                                    <p class="text-sm text-gray-500">Order received</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->orderDetails as $item)
                        <div class="flex items-center space-x-4 py-4 border-b border-gray-100 last:border-b-0">
                            <div class="flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-20 h-20 object-cover rounded-md">
                                @else
                                    <div class="w-20 h-20 bg-gray-300 rounded-md flex items-center justify-center">
                                        <i class="fas fa-image text-2xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->product->category }}</p>
                                <p class="text-sm text-gray-600">Qty: {{ $item->qty }}</p>
                                <a href="{{ route('products.show', $item->product) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Product
                                </a>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                                <p class="text-sm text-gray-500">${{ number_format($item->price, 2) }} each</p>
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
                        <span>Subtotal</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between text-lg font-semibold text-gray-900">
                            <span>Total</span>
                            <span>${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                @if(!$order->paid)
                    <div class="mb-6">
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors font-semibold">
                            <i class="fas fa-credit-card mr-2"></i>Pay Now
                        </button>
                    </div>
                @endif

                <div class="space-y-4">
                    <a href="{{ route('products.index') }}" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                        <i class="fas fa-shopping-bag mr-2"></i>Continue Shopping
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="block w-full bg-gray-600 text-white text-center px-4 py-2 rounded-md hover:bg-gray-700 transition-colors font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Orders
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Need Help?</h4>
                    <p class="text-sm text-gray-600 mb-2">Contact our support team:</p>
                    <p class="text-sm text-gray-600">Email: <a href="mailto:support@khmart.com" class="text-blue-600 hover:underline">support@khmart.com</a></p>
                    <p class="text-sm text-gray-600">Phone: <span class="text-blue-600">+855 123 456 789</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
