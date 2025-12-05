<x-layouts.app title="Users">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Users</h1>
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

        <!-- Users Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50 text-xs uppercase font-semibold text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Registered Date</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->type === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.users.toggleType', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-2 {{ $user->type === 'admin' ? 'bg-orange-600 hover:bg-orange-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white text-xs font-medium rounded-lg transition-colors"
                                            onclick="return confirm('Are you sure you want to change this user\'s type to {{ $user->type === 'admin' ? 'User' : 'Admin' }}?');">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                        {{ $user->type === 'admin' ? 'Set as User' : 'Set as Admin' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
