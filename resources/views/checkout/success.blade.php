@extends('components.layouts.theme')
@section('title', 'Order Successful')
@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-lg p-8 md:p-12 text-center">
            <!-- Success Icon -->
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Thank You for Your Order!</h1>
            <p class="text-lg text-gray-600 mb-8">
                Your order has been successfully placed. Here's a summary of your purchase:
            </p>

            <!-- Order Details -->
            <div class="bg-gray-50 rounded-2xl p-6 mb-8 text-left">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order ID</p>
                        <p class="font-bold text-gray-900">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order Date</p>
                        <p class="font-bold text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                @if($order->customer_name || $order->customer_email || $order->customer_phone)
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Customer Information</p>
                        @if($order->customer_name)
                            <p class="text-gray-900 mb-1">{{ $order->customer_name }}</p>
                        @endif
                        @if($order->customer_email)
                            <p class="text-gray-600 mb-1">{{ $order->customer_email }}</p>
                        @endif
                        @if($order->customer_phone)
                            <p class="text-gray-600">{{ $order->customer_phone }}</p>
                        @endif
                    </div>
                @endif

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Delivery Address</p>
                    <p class="text-gray-900">{{ $order->delivery_address }}</p>
                </div>
            </div>

            <!-- Products Table -->
            <div class="overflow-x-auto mb-8">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-900">Product</th>
                            <th class="px-4 py-3 text-center text-sm font-bold text-gray-900">Price</th>
                            <th class="px-4 py-3 text-center text-sm font-bold text-gray-900">Quantity</th>
                            <th class="px-4 py-3 text-right text-sm font-bold text-gray-900">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($order->products as $product)
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset($product['image']) }}" 
                                             alt="{{ $product['name'] }}"
                                             class="w-16 h-16 object-contain rounded-lg bg-gray-50">
                                        <span class="font-semibold text-gray-900">{{ $product['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-gray-900">
                                    {{ $product['currency'] }} {{ number_format($product['price']) }}
                                </td>
                                <td class="px-4 py-4 text-center text-gray-900">
                                    {{ $product['quantity'] }}
                                </td>
                                <td class="px-4 py-4 text-right font-bold text-gray-900">
                                    {{ $product['currency'] }} {{ number_format($product['subtotal']) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 border-t-2 border-gray-300">
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-right font-bold text-gray-900">Total:</td>
                            <td class="px-4 py-4 text-right text-2xl font-extrabold text-gray-900">
                                {{ $order->currency }} {{ number_format($order->total_amount) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Action Button -->
            <a href="{{ route('products.index') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold transition shadow-lg">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection
