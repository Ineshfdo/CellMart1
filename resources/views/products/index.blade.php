@extends('components.layouts.theme')

@section('title', 'Products')

@section('content')
<div class="bg-gray-100 min-h-screen" x-data="{ mobileFiltersOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            
            <div class="flex w-full md:w-auto gap-4">
                <!-- Mobile Filter Toggle -->
                <button @click="mobileFiltersOpen = !mobileFiltersOpen" class="lg:hidden px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filters
                </button>

                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET" class="relative w-full md:w-96">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('subcategory'))
                        <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                    @endif
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search products..." 
                        class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div 
                class="lg:w-64 flex-shrink-0"
                :class="{'block': mobileFiltersOpen, 'hidden': !mobileFiltersOpen, 'lg:block': true}"
            >
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-900">Categories</h2>
                        @if(request('category') || request('subcategory') || request('search'))
                            <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">Clear All</a>
                        @endif
                    </div>

                    <div class="space-y-2">
                        @foreach($categories as $categoryName => $subcategories)
                            <div x-data="{ open: {{ request('category') == $categoryName ? 'true' : 'false' }} }">
                                <button 
                                    @click="open = !open" 
                                    class="flex items-center justify-between w-full py-2 text-left group"
                                >
                                    <span class="font-medium {{ request('category') == $categoryName ? 'text-blue-600' : 'text-gray-700 group-hover:text-gray-900' }}">
                                        {{ $categoryName }}
                                    </span>
                                    <svg 
                                        class="w-4 h-4 text-gray-400 transition-transform duration-200" 
                                        :class="{'rotate-180': open}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div 
                                    x-show="open" 
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    class="pl-4 space-y-1 mt-1"
                                    style="display: none;"
                                >
                                    <!-- All in Category Link -->
                                    <a 
                                        href="{{ route('products.index', array_merge(request()->except(['subcategory', 'page']), ['category' => $categoryName])) }}" 
                                        class="block py-1 text-sm {{ request('category') == $categoryName && !request('subcategory') ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-900' }}"
                                    >
                                        All {{ $categoryName }}
                                    </a>

                                    <!-- Subcategories -->
                                    @foreach($subcategories as $sub)
                                        @if($sub->subcategory)
                                            <a 
                                                href="{{ route('products.index', array_merge(request()->except(['page']), ['category' => $categoryName, 'subcategory' => $sub->subcategory])) }}" 
                                                class="block py-1 text-sm {{ request('subcategory') == $sub->subcategory ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-900' }}"
                                            >
                                                {{ $sub->subcategory }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 h-full flex flex-col">
                                    
                                    <!-- Product Image -->
                                    <div class="w-full h-64 bg-gray-50 p-4">
                                        <img 
                                            src="{{ asset($product->image) }}" 
                                            alt="{{ $product->name }}" 
                                            class="w-full h-full object-contain mix-blend-multiply"
                                            onerror="this.src='{{ asset('images/no-image.png') }}'"
                                        >
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-5 flex-grow flex flex-col text-center">
                                        <div class="mb-2">
                                            <span class="text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 px-2 py-1 rounded-full">
                                                {{ $product->subcategory ?? $product->category }}
                                            </span>
                                        </div>

                                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-2 flex-grow">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="mt-auto">
                                            <p class="text-xl font-bold text-gray-900 mb-2">
                                                <span class="text-sm font-normal text-gray-500 relative top-0.1 mr-0.5">
                                                    {{ $product->currency }}
                                                </span>
                                                {{ number_format($product->price) }}
                                            </p>

                                            @if($product->ram || $product->storage)
                                                <div class="flex items-center justify-center gap-2 text-xs text-gray-500 border-t border-gray-100 pt-3">
                                                    @if($product->ram)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                                            {{ $product->ram }}
                                                        </span>
                                                    @endif
                                                    @if($product->ram && $product->storage)
                                                        <span class="text-gray-300">|</span>
                                                    @endif
                                                    @if($product->storage)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                                            {{ $product->storage }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                        <p class="text-gray-500 mt-2">Try adjusting your search or filters.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Clear all filters</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
