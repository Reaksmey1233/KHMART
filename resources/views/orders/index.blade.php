@extends('layouts.app')

@section('title', 'My Orders - KHmart')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Orders</h1>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Order Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-500">{{ $order->formatted_date }}</p>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0 text-right">
                                <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                                <div class="flex items-center justify-end space-x-2 mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($order->delivery === 'delivered') bg-green-100 text-green-800
                                        @elseif($order->delivery === 'shipped') bg-blue-100 text-blue-800
                                        @elseif($order->delivery === 'processing') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($order->delivery) }}
                                    </span>
                                    @if($order->paid)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Unpaid
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <h4 class="font-medium text-gray-900 mb-4">Order Items</h4>
                        <div class="space-y-3">
                            @foreach($order->orderDetails as $item)
                                <div class="flex items-center space-x-4 py-3 border-b border-gray-100 last:border-b-0">
                                    <div class="flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-16 h-16 object-cover rounded-md">
                                        @else
                                            <div class="w-16 h-16 bg-gray-300 rounded-md flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h5 class="font-medium text-gray-900">{{ $item->product->name }}</h5>
                                        <p class="text-sm text-gray-500">{{ $item->product->category }}</p>
                                        <p class="text-sm text-gray-600">Qty: {{ $item->qty }}</p>
                                    </div>
                                    
                                    <div class="text-right">
                                        <p class="font-medium text-gray-900">${{ number_format($item->subtotal, 2) }}</p>
                                        <p class="text-sm text-gray-500">${{ number_format($item->price, 2) }} each</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                <span><i class="fas fa-box mr-2"></i>{{ $order->orderDetails->count() }} items</span>
                                <span><i class="fas fa-calendar mr-2"></i>{{ $order->formatted_date }}</span>
                            </div>
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('orders.show', $order) }}" 
                                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                                
                                @if(!$order->paid)
                                    <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors text-sm font-medium">
                                        <i class="fas fa-credit-card mr-2"></i>Pay Now
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No orders yet</h3>
            <p class="text-gray-500 mb-6">Start shopping to see your orders here.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
