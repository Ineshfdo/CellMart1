<x-layouts.app title="Add New Product">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Product</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Create a new product listing</p>
            </div>
            <a href="{{ route('admin.products.index') }}" 
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                Back to Products
            </a>
        </div>

        <!-- Create Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 p-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="category" 
                               name="category" 
                               value="{{ old('category') }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subcategory -->
                    <div>
                        <label for="subcategory" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Subcategory
                        </label>
                        <input type="text" 
                               id="subcategory" 
                               name="subcategory" 
                               value="{{ old('subcategory') }}"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('subcategory')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price') }}"
                               step="0.01"
                               min="0"
                               required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Currency <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="currency" 
                               name="currency" 
                               value="{{ old('currency', 'LKR') }}"
                               required
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('currency')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RAM -->
                    <div>
                        <label for="ram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            RAM
                        </label>
                        <input type="text" 
                               id="ram" 
                               name="ram" 
                               value="{{ old('ram') }}"
                               placeholder="e.g., 8GB"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('ram')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Storage -->
                    <div>
                        <label for="storage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Storage
                        </label>
                        <input type="text" 
                               id="storage" 
                               name="storage" 
                               value="{{ old('storage') }}"
                               placeholder="e.g., 256GB"
                               class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">
                        @error('storage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Product Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Product Image
                        </label>
                        
                        <div class="border-2 border-dashed border-gray-300 dark:border-zinc-600 rounded-lg p-6 bg-gray-50 dark:bg-zinc-900">
                            <input type="file" 
                                   id="imageUpload" 
                                   name="image_file" 
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-500 dark:text-gray-400
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                          dark:file:bg-blue-900 dark:file:text-blue-300
                                          cursor-pointer"
                                   onchange="previewNewImage(event)">
                            
                            <!-- Preview for new upload -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Image Preview:</p>
                                <img id="previewImg" src="" alt="Preview" class="max-w-full h-48 object-contain rounded-lg border border-gray-200 dark:border-zinc-700">
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Accepted formats: JPG, PNG, GIF, WebP (Max 2MB)
                        </p>
                        @error('image_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-zinc-700 text-gray-900 dark:text-white">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-zinc-700">
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-6 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Create Product
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewNewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            
            if (file) {
                // Check file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    event.target.value = '';
                    previewContainer.classList.add('hidden');
                    return;
                }
                
                // Check file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG, GIF, or WebP)');
                    event.target.value = '';
                    previewContainer.classList.add('hidden');
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-layouts.app>
