@extends('layouts.app')

@section('title', 'Welcome to KHmart - Your Online Store')

@section('content')
<div class="text-center py-16">
    <!-- Hero Section -->
    <div class="max-w-4xl mx-auto mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-6">
            Welcome to <span class="text-blue-600">KHmart</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8">
            Your trusted online shopping destination for quality products. 
            Discover amazing deals and shop with confidence.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg">
                <i class="fas fa-shopping-bag mr-2"></i>Start Shopping
            </a>
            @guest
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-lg">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </a>
            @endguest
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shipping-fast text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast Delivery</h3>
            <p class="text-gray-600">Quick and reliable delivery to your doorstep</p>
        </div>
        
        <div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shield-alt text-2xl text-green-600"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure Shopping</h3>
            <p class="text-gray-600">Safe and secure payment options including KHQR</p>
        </div>
        
        <div class="text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-headset text-2xl text-purple-600"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">24/7 Support</h3>
            <p class="text-gray-600">Round-the-clock customer support</p>
        </div>
    </div>

    <!-- Categories Preview -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('products.index', ['category' => 'Electronics']) }}" class="group">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-mobile-alt text-4xl text-blue-600 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-semibold text-gray-900">Electronics</h3>
                </div>
            </a>
            
            <a href="{{ route('products.index', ['category' => 'Fashion']) }}" class="group">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-tshirt text-4xl text-green-600 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-semibold text-gray-900">Fashion</h3>
                </div>
            </a>
            
            <a href="{{ route('products.index', ['category' => 'Sports']) }}" class="group">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-dumbbell text-4xl text-purple-600 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-semibold text-gray-900">Sports</h3>
                </div>
            </a>
            
            <a href="{{ route('products.index', ['category' => 'Home & Kitchen']) }}" class="group">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center">
                    <i class="fas fa-home text-4xl text-orange-600 mb-3 group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-semibold text-gray-900">Home & Kitchen</h3>
                </div>
            </a>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600 text-white py-12 px-6 rounded-lg">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Shopping?</h2>
        <p class="text-xl mb-6">Join thousands of satisfied customers and discover amazing products today.</p>
        <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
            Browse Products
        </a>
    </div>
</div>
@endsection
