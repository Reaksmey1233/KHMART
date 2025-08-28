@extends('layouts.app')

@section('title', 'My Profile - KHmart')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Profile</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Account Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Account Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Member Since</label>
                        <p class="text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors font-medium">
                        <i class="fas fa-edit mr-2"></i>Edit Profile
                    </button>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Recent Orders</h2>
                    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All Orders
                    </a>
                </div>
                
                @if($orders->count() > 0)
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-shopping-bag text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Order #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-500">{{ $order->formatted_date }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">${{ number_format($order->total, 2) }}</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($order->delivery === 'delivered') bg-green-100 text-green-800
                                            @elseif($order->delivery === 'shipped') bg-blue-100 text-blue-800
                                            @elseif($order->delivery === 'processing') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($order->delivery) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-600">
                                        <span>{{ $order->orderDetails->count() }} items</span>
                                    </div>
                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-600 mb-2">No orders yet</h3>
                        <p class="text-gray-500 mb-4">Start shopping to see your orders here.</p>
                        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors font-medium">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Orders</span>
                        <span class="font-semibold text-gray-900">{{ $user->orders()->count() }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Spent</span>
                        <span class="font-semibold text-gray-900">${{ number_format($user->orders()->sum('total'), 2) }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Cart Items</span>
                        <span class="font-semibold text-gray-900">{{ $user->cartItems()->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('products.index') }}" class="block w-full bg-blue-600 text-white text-center px-4 py-2 rounded-md hover:bg-blue-700 transition-colors font-medium">
                        <i class="fas fa-shopping-bag mr-2"></i>Browse Products
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="block w-full bg-green-600 text-white text-center px-4 py-2 rounded-md hover:bg-green-700 transition-colors font-medium">
                        <i class="fas fa-shopping-cart mr-2"></i>View Cart
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="block w-full bg-purple-600 text-white text-center px-4 py-2 rounded-md hover:bg-purple-700 transition-colors font-medium">
                        <i class="fas fa-list mr-2"></i>My Orders
                    </a>
                </div>
            </div>

            <!-- Account Security -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Security</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Password</span>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Change
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Two-Factor Auth</span>
                        <span class="text-sm text-gray-500">Not enabled</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Login Sessions</span>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Manage
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
