<x-layouts.app title="Products">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Products</h1>
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

        <!-- Products Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Subcategory</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4">
                                @if($product->image)
                                    @php
                                        // Check if image is a full URL or a local path
                                        $imageSrc = filter_var($product->image, FILTER_VALIDATE_URL) 
                                            ? $product->image 
                                            : asset($product->image);
                                    @endphp
                                    <img src="{{ $imageSrc }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3ENo Image%3C/text%3E%3C/svg%3E';">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 dark:bg-zinc-700 rounded-lg flex items-center justify-center">
                                        <span class="text-xs text-gray-400">No Image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category }}</td>
                            <td class="px-6 py-4">{{ $product->subcategory ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $product->currency }} {{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($product->description)
                                    <div class="max-w-xs">
                                        <div id="desc-short-{{ $product->id }}" class="inline">
                                            {{ Str::limit($product->description, 50) }}
                                        </div>
                                        <div id="desc-full-{{ $product->id }}" class="hidden">
                                            {{ $product->description }}
                                        </div>
                                        @if(strlen($product->description) > 50)
                                            <button onclick="toggleDescription({{ $product->id }})" 
                                                    id="toggle-btn-{{ $product->id }}"
                                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs font-medium ml-1">
                                                Show All
                                            </button>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors">
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
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function toggleDescription(productId) {
            const shortDesc = document.getElementById(`desc-short-${productId}`);
            const fullDesc = document.getElementById(`desc-full-${productId}`);
            const toggleBtn = document.getElementById(`toggle-btn-${productId}`);
            
            if (fullDesc.classList.contains('hidden')) {
                // Show full description
                shortDesc.classList.add('hidden');
                fullDesc.classList.remove('hidden');
                toggleBtn.textContent = 'Show Less';
            } else {
                // Show short description
                fullDesc.classList.add('hidden');
                shortDesc.classList.remove('hidden');
                toggleBtn.textContent = 'Show All';
            }
        }
    </script>
</x-layouts.app>
