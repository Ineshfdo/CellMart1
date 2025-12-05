<x-layouts.app title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Products -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</span>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalProducts }}</span>
                </div>
            </div>

            <!-- Registered Customers -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Customers</span>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalCustomers }}</span>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</span>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalOrders }}</span>
                </div>
            </div>

            <!-- Accepted Orders -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm p-6 border border-gray-100 dark:border-zinc-700">
                <div class="flex flex-col">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Accepted Orders</span>
                    <span class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $acceptedOrdersCount }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total: {{ number_format($acceptedOrdersTotal, 2) }} LKR</span>
                </div>
            </div>
        </div>

        <!-- Latest Products -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-zinc-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Products</h2>
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Add New Product
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Product Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($latestProducts as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category }}</td>
                            <td class="px-6 py-4">{{ number_format($product->price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Orders -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-zinc-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Quantity</th>
                            <th class="px-6 py-4">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($latestOrders as $order)
                            @php
                                $products = is_string($order->products) ? json_decode($order->products, true) : $order->products;
                                $totalQuantity = collect($products)->sum('quantity');
                            @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                @if($order->user_name)
                                    {{ $order->user_name }}
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->user_email }}</div>
                                @else
                                    {{ $order->customer_name ?? 'Guest' }}
                                    @if($order->customer_email)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->customer_email }}</div>
                                    @endif
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
                            <td class="px-6 py-4">{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Customers -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-zinc-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Customers</h2>
                <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Customer ID</th>
                            <th class="px-6 py-4">Customer Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Registered Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($latestCustomers as $customer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $customer->id }}</td>
                            <td class="px-6 py-4">{{ $customer->name }}</td>
                            <td class="px-6 py-4">{{ $customer->email }}</td>
                            <td class="px-6 py-4">{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Feedback -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-zinc-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Feedback</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Subject</th>
                            <th class="px-6 py-4">Message</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($latestFeedback as $feedback)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $feedback->name }}</td>
                            <td class="px-6 py-4">{{ $feedback->email }}</td>
                            <td class="px-6 py-4">{{ $feedback->subject }}</td>
                            <td class="px-6 py-4 max-w-xs truncate" title="{{ $feedback->message }}">{{ $feedback->message }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">No feedback found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
