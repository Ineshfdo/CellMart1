@extends('components.layouts.theme')

@section('title', $product->name)

@section('content')
@section('content')
<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Main Product Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Product Image -->
                <div class="p-8 lg:p-12 flex items-center justify-center bg-gray-100">
                    <img src="{{ asset($product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="max-h-[500px] w-auto object-contain mix-blend-multiply hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/no-image.png') }}'">
                </div>

                <!-- Product Details -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="mb-2">
                        <span class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full">
                            {{ $product->subcategory ?? $product->category }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- Short Description / Key Specs -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                        @if($product->ram)
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                <span class="font-medium">{{ $product->ram }} RAM</span>
                            </div>
                        @endif
                        @if($product->storage)
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                <span class="font-medium">{{ $product->storage }} Storage</span>
                            </div>
                        @endif
                    </div>

                    <div class=" mb-8">
                        <div class="inline-flex items-baseline justify-center text-4xl font-bold text-gray-900">
                            <span class="text-2xl text-gray-500 font-normal mr-1">{{ $product->currency }}</span>
                            {{ number_format($product->price) }}
                        </div>
                    </div>
                    
                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Quantity <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-3">
                            <button type="button" id="decreaseQty" class="w-10 h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition font-bold text-lg">
                                -
                            </button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" readonly
                                   class="w-16 h-10 text-center border-2 border-gray-300 rounded-lg font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="button" id="increaseQty" class="w-10 h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition font-bold text-lg">
                                +
                            </button>
                        </div>
                    </div>

                    <!-- Color Selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Color <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <div class="color-option" data-color="Black">
                                <input type="radio" name="color" value="Black" id="color-black" class="hidden color-input" checked>
                                <label for="color-black" class="w-8 h-8 rounded-full bg-black border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="color-option" data-color="White">
                                <input type="radio" name="color" value="White" id="color-white" class="hidden color-input">
                                <label for="color-white" class="w-8 h-8 rounded-full bg-white border-2 border-gray-300 cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-800 hidden checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="color-option" data-color="Blue">
                                <input type="radio" name="color" value="Blue" id="color-blue" class="hidden color-input">
                                <label for="color-blue" class="w-8 h-8 rounded-full bg-blue-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="color-option" data-color="Red">
                                <input type="radio" name="color" value="Red" id="color-red" class="hidden color-input">
                                <label for="color-red" class="w-8 h-8 rounded-full bg-red-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                            <div class="color-option" data-color="Green">
                                <input type="radio" name="color" value="Green" id="color-green" class="hidden color-input">
                                <label for="color-green" class="w-8 h-8 rounded-full bg-green-500 border-2 border-transparent cursor-pointer hover:scale-110 transition-transform flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white hidden checkmark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <p id="selectedColor" class="text-sm text-gray-600 mt-2">Selected: <span class="font-semibold">Black</span></p>
                    </div>

                    <!-- Warranty Selector -->
                    <div class="mb-8">
                        <label for="warranty" class="block text-sm font-medium text-gray-700 mb-2">Warranty Plan <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="warranty" name="warranty" required
                                    class="block w-full pl-4 pr-10 py-3 text-base border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-xl bg-gray-50 transition">
                                <option value="1 Year Company Warranty">1 Year Company Warranty</option>
                                <option value="2 Years Extended Warranty">2 Years Extended Warranty</option>
                            </select>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                        <input type="hidden" name="color" id="colorInput" value="Black">
                        <input type="hidden" name="warranty" id="warrantyInput" value="1 Year Company Warranty">
                        
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 hover:shadow-xl">
                                Add To Cart
                            </button>
                            <a href="{{ url()->previous() }}" 
                                class="px-6 py-4 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition border border-gray-200">
                                Back
                            </a>
                        </div>
                    </form>

                    <script>
                        // Quantity controls
                        const quantityInput = document.getElementById('quantity');
                        const quantityHiddenInput = document.getElementById('quantityInput');
                        const decreaseBtn = document.getElementById('decreaseQty');
                        const increaseBtn = document.getElementById('increaseQty');

                        decreaseBtn.addEventListener('click', () => {
                            let value = parseInt(quantityInput.value);
                            if (value > 1) {
                                value--;
                                quantityInput.value = value;
                                quantityHiddenInput.value = value;
                            }
                        });

                        increaseBtn.addEventListener('click', () => {
                            let value = parseInt(quantityInput.value);
                            if (value < 99) {
                                value++;
                                quantityInput.value = value;
                                quantityHiddenInput.value = value;
                            }
                        });

                        // Color selection
                        const colorInputs = document.querySelectorAll('.color-input');
                        const colorHiddenInput = document.getElementById('colorInput');
                        const selectedColorText = document.getElementById('selectedColor');

                        colorInputs.forEach(input => {
                            input.addEventListener('change', function() {
                                // Update hidden input
                                colorHiddenInput.value = this.value;
                                
                                // Update selected text
                                selectedColorText.innerHTML = 'Selected: <span class="font-semibold">' + this.value + '</span>';
                                
                                // Update visual feedback
                                document.querySelectorAll('.color-option label').forEach(label => {
                                    label.classList.remove('ring-4', 'ring-blue-500', 'ring-offset-2');
                                });
                                document.querySelectorAll('.checkmark').forEach(check => {
                                    check.classList.add('hidden');
                                });
                                
                                this.nextElementSibling.classList.add('ring-4', 'ring-blue-500', 'ring-offset-2');
                                this.nextElementSibling.querySelector('.checkmark').classList.remove('hidden');
                            });
                        });

                        // Set initial state for black color
                        document.querySelector('#color-black').nextElementSibling.classList.add('ring-4', 'ring-blue-500', 'ring-offset-2');
                        document.querySelector('#color-black').nextElementSibling.querySelector('.checkmark').classList.remove('hidden');

                        // Warranty selection
                        const warrantySelect = document.getElementById('warranty');
                        const warrantyHiddenInput = document.getElementById('warrantyInput');

                        warrantySelect.addEventListener('change', function() {
                            warrantyHiddenInput.value = this.value;
                        });

                        // Form validation
                        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
                            const quantity = parseInt(quantityInput.value);
                            const color = colorHiddenInput.value;
                            const warranty = warrantyHiddenInput.value;

                            if (quantity < 1) {
                                e.preventDefault();
                                alert('Please select a valid quantity (minimum 1)');
                                return false;
                            }

                            if (!color) {
                                e.preventDefault();
                                alert('Please select a color');
                                return false;
                            }

                            if (!warranty) {
                                e.preventDefault();
                                alert('Please select a warranty plan');
                                return false;
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Description Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="bg-white rounded-3xl shadow-sm p-8 lg:p-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Product Overview
            </h2>
            
            <div class="prose prose-lg max-w-none text-gray-600">
                @if($product->description)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Key Features</h3>
                            <ul class="space-y-3">
                                @foreach(array_filter(array_map('trim', explode('.', $product->description))) as $point)
                                    @if(!empty($point) && strlen($point) < 100)
                                        <li class="flex items-start gap-3">
                                            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Detailed Specifications</h3>
                            <p class="leading-relaxed">
                                Experience the power of the {{ $product->name }}. 
                                @foreach(array_filter(array_map('trim', explode('.', $product->description))) as $point)
                                    @if(!empty($point) && strlen($point) >= 100)
                                        {{ $point }}.
                                    @endif
                                @endforeach
                                Designed for those who demand excellence, this device combines premium aesthetics with high-performance internals.
                            </p>
                        </div>
                    </div>
                @else
                    <p>No detailed description available for this product.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="max-w-7xl mx-auto p-6 pt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="block">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 max-w-xs mx-auto">
                        
                        <!-- Product Image -->
                        <div class="w-full h-64 bg-gray-50">
                            <img 
                                src="{{ asset($related->image) }}" 
                                alt="{{ $related->name }}" 
                                class="w-full h-full object-contain"
                                onerror="this.src='{{ asset('images/no-image.png') }}'"
                            >
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 text-center">
                            <!-- Product Name -->
                            <h3 class="text-lg font-semibold line-clamp-1">
                                {{ $related->name }}
                            </h3>

                            <!-- Price -->
                            <p class="text-gray-700 font-bold text-lg mt-1">
                                {{ $related->currency }} {{ number_format($related->price) }}
                            </p>

                            <!-- RAM & Storage -->
                            @if($related->ram || $related->storage)
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $related->ram ?? '' }}
                                    @if($related->ram && $related->storage) | @endif
                                    {{ $related->storage ?? '' }}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
