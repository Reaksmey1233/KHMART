@extends('layouts.app')

@section('title', 'Checkout - KHmart')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Summary -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                
                <div class="space-y-4">
                    @foreach($cartItems as $cartItem)
                        <div class="flex items-center space-x-4 py-3 border-b border-gray-100">
                            <div class="flex-shrink-0">
                                @if($cartItem->product->image)
                                    <img src="{{ asset('storage/' . $cartItem->product->image) }}" 
                                         alt="{{ $cartItem->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-md">
                                @else
                                    <div class="w-16 h-16 bg-gray-300 rounded-md flex items-center justify-center">
                                        <i class="fas fa-image text-xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $cartItem->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $cartItem->product->category }}</p>
                                <p class="text-sm text-gray-600">Qty: {{ $cartItem->qty }}</p>
                            </div>
                            
                            <div class="text-right">
                                @if($cartItem->product->discount > 0)
                                    <span class="font-semibold text-red-600">${{ number_format($cartItem->subtotal, 2) }}</span>
                                    <p class="text-xs text-gray-500 line-through">${{ number_format($cartItem->product->price * $cartItem->qty, 2) }}</p>
                                @else
                                    <span class="font-semibold text-gray-900">${{ number_format($cartItem->subtotal, 2) }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Subtotal ({{ $cartItems->sum('qty') }} items)</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="border-t border-gray-200 pt-2">
                        <div class="flex justify-between text-lg font-semibold text-gray-900">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Delivery Information</h2>
                
                <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-2">Delivery Address</label>
                        <textarea id="delivery_address" name="delivery_address" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Enter your complete delivery address">{{ old('delivery_address') }}</textarea>
                        @error('delivery_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required
                               value="{{ old('phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter your phone number">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                            <i class="fas fa-credit-card mr-2"></i>Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Methods</h2>
                
                <!-- KHQR Integration -->
                <div class="mb-6">
                    <h3 class="text-md font-medium text-gray-900 mb-3">KHQR Payment</h3>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <div class="w-32 h-32 bg-white mx-auto mb-3 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg">
                            <i class="fas fa-qrcode text-4xl text-gray-400"></i>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Scan KHQR code to pay</p>
                        <p class="text-xs text-gray-500">Amount: ${{ number_format($total, 2) }}</p>
                    </div>
                </div>

                <!-- Other Payment Options -->
                <div class="space-y-3">
                    <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                        <input type="radio" id="cod" name="payment_method" value="cod" class="mr-3">
                        <label for="cod" class="flex-1">
                            <span class="font-medium text-gray-900">Cash on Delivery</span>
                            <p class="text-sm text-gray-500">Pay when you receive your order</p>
                        </label>
                    </div>
                    
                    <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                        <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="mr-3">
                        <label for="bank_transfer" class="flex-1">
                            <span class="font-medium text-gray-900">Bank Transfer</span>
                            <p class="text-sm text-gray-500">Transfer to our bank account</p>
                        </label>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-medium text-blue-900 mb-2">Order Security</h4>
                    <p class="text-sm text-blue-700">Your order is protected by our secure payment system. We'll send you an email confirmation once your order is placed.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
