@extends('layouts.app')

@section('title', 'Order Placed Successfully - KHmart')

@section('content')
<div class="mb-8">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="mb-6">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                <i class="fas fa-check text-4xl text-green-600"></i>
            </div>
        </div>

        <!-- Success Message -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Order Placed Successfully!</h1>
        <p class="text-lg text-gray-600 mb-8">Thank you for your order. We've sent you a confirmation email with all the details.</p>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 text-left">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Details</h2>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-medium text-gray-900">#{{ $order->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Order Date</p>
                    <p class="font-medium text-gray-900">{{ $order->formatted_date }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Amount</p>
                    <p class="font-medium text-gray-900">${{ number_format($order->total, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        {{ ucfirst($order->delivery) }}
                    </span>
                </div>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 pt-4">
                <h3 class="font-medium text-gray-900 mb-3">Order Items</h3>
                <div class="space-y-3">
                    @foreach($order->orderDetails as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-200 rounded-md flex items-center justify-center">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-12 h-12 object-cover rounded-md">
                                    @else
                                        <i class="fas fa-image text-gray-400"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->qty }}</p>
                                </div>
                            </div>
                            <span class="font-medium text-gray-900">${{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-blue-900 mb-4">What happens next?</h3>
            <div class="space-y-3 text-left">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mt-0.5">
                        1
                    </div>
                    <div>
                        <p class="font-medium text-blue-900">Order Confirmation</p>
                        <p class="text-sm text-blue-700">We'll send you an email confirmation with your order details and invoice.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mt-0.5">
                        2
                    </div>
                    <div>
                        <p class="font-medium text-blue-900">Processing</p>
                        <p class="text-sm text-blue-700">Our team will process your order and prepare it for shipping.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium mt-0.5">
                        3
                    </div>
                    <div>
                        <p class="font-medium text-blue-900">Delivery</p>
                        <p class="text-sm text-blue-700">We'll deliver your order to the address you provided.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('orders.show', $order) }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition-colors font-semibold">
                <i class="fas fa-eye mr-2"></i>View Order Details
            </a>
            <a href="{{ route('products.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition-colors font-semibold">
                <i class="fas fa-shopping-bag mr-2"></i>Continue Shopping
            </a>
        </div>

        <!-- Contact Information -->
        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm text-gray-600 mb-2">Have questions about your order?</p>
            <p class="text-sm text-gray-600">Contact us at <a href="mailto:support@khmart.com" class="text-blue-600 hover:underline">support@khmart.com</a> or call <span class="text-blue-600">+855 123 456 789</span></p>
        </div>
    </div>
</div>
@endsection
