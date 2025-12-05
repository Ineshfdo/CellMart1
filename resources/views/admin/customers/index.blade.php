<x-layouts.app title="Customers">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Customers</h1>
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

        <!-- Customers Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">Customer ID</th>
                            <th class="px-6 py-4">Customer Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Registered Date</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $customer->id }}</td>
                            <td class="px-6 py-4">{{ $customer->name }}</td>
                            <td class="px-6 py-4">{{ $customer->email }}</td>
                            <td class="px-6 py-4">{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.users.toggleType', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors"
                                            onclick="return confirm('Are you sure you want to set this user as Admin?');">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                        Set as Admin
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
