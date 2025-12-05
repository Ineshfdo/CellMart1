@extends('components.layouts.theme')
@section('title', 'Shopping Cart')
@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Shopping Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <form action="{{ route('cart.update') }}" method="POST" id="updateCartForm">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Product</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Color</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Warranty</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Price</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Quantity</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Subtotal</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Remove</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($cartItems as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-6">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ asset($item['product']->image) }}" 
                                                     alt="{{ $item['product']->name }}"
                                                     class="w-20 h-20 object-contain rounded-lg bg-gray-50">
                                                <div>
                                                    <h3 class="font-bold text-gray-900">{{ $item['product']->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $item['product']->category }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                                @if($item['color'] == 'Black') bg-gray-800 text-white
                                                @elseif($item['color'] == 'White') bg-gray-100 text-gray-800 border border-gray-300
                                                @elseif($item['color'] == 'Blue') bg-blue-500 text-white
                                                @elseif($item['color'] == 'Red') bg-red-500 text-white
                                                @elseif($item['color'] == 'Green') bg-green-500 text-white
                                                @endif">
                                                {{ $item['color'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <span class="text-sm text-gray-700 font-medium">{{ $item['warranty'] }}</span>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <span class="font-semibold text-gray-900">
                                                {{ $item['product']->currency }} {{ number_format($item['product']->price) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex justify-center">
                                                <input type="number" 
                                                       name="quantities[{{ $item['key'] }}]" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       max="99"
                                                       class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <span class="font-bold text-gray-900">
                                                {{ $item['product']->currency }} {{ number_format($item['subtotal']) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6 text-center">
                                            <button type="button" 
                                                    onclick="removeItem('{{ $item['key'] }}')"
                                                    class="text-red-600 hover:text-red-800 font-semibold transition">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-50 px-6 py-6 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg">
                                Update Cart
                            </button>
                            <div class="text-right">
                                <p class="text-sm text-gray-600 mb-1">Total:</p>
                                <p class="text-3xl font-extrabold text-gray-900">
                                    {{ $cartItems[0]['product']->currency ?? 'LKR' }} {{ number_format($total) }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="{{ route('products.index') }}" 
                               class="flex-1 bg-white border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-bold text-center hover:bg-gray-50 transition">
                                Continue Shopping
                            </a>
                            <a href="{{ route('checkout.index') }}" 
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-center transition shadow-lg">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8">Start adding some products to your cart!</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold transition">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Hidden forms for remove actions -->
@foreach($cartItems ?? [] as $item)
    <form id="removeForm{{ str_replace(['_', ' '], '', $item['key']) }}" 
          action="{{ route('cart.remove', $item['key']) }}" 
          method="POST" 
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endforeach

<script>
function removeItem(cartKey) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        const formId = 'removeForm' + cartKey.replace(/[_ ]/g, '');
        document.getElementById(formId).submit();
    }
}
</script>
@endsection
