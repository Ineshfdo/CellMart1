<x-layouts.app title="Orders">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Orders</h1>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Quantity</th>
                            <th class="px-6 py-4">Total Amount</th>
                            <th class="px-6 py-4">Delivery Address</th>
                            <th class="px-6 py-4">Order Date</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($orders as $order)
                            @php
                                $products = is_string($order->products) ? json_decode($order->products, true) : $order->products;
                            @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4">
                                @if($order->user_email)
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $order->user_email }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->user_name }}</div>
                                @else
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $order->customer_email ?? 'No email' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->customer_name ?? 'Guest' }}</div>
                                @endif
                                @if($order->customer_phone)
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->customer_phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @foreach($products as $product)
                                        <div class="text-sm">{{ $product['name'] ?? 'Unknown Product' }}</div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @foreach($products as $product)
                                        <div class="text-sm">{{ $product['quantity'] ?? 0 }}</div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $order->currency ?? 'LKR' }} {{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $order->delivery_address }}">
                                {{ Str::limit($order->delivery_address, 40) }}
                            </td>
                            <td class="px-6 py-4 text-xs">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <!-- Accept Button -->
                                    <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-colors"
                                                onclick="return confirm('Accept this order?');">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Accept
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this order?');">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
