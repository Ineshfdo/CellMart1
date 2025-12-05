<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        // Get 4 iPhones
        $iphones = Products::where('category', 'Mobile Phones')
            ->where('subcategory', 'Apple iPhone')
            ->limit(4)
            ->get();
        
        // Get 4 Samsung phones (from any Samsung subcategory)
        $samsung = Products::where('category', 'Mobile Phones')
            ->where('subcategory', 'LIKE', 'Samsung%')
            ->limit(4)
            ->get();
        
        // Get 4 Google Pixel phones
        $pixels = Products::where('category', 'Mobile Phones')
            ->where('subcategory', 'Google Pixel')
            ->limit(4)
            ->get();
        
        // Combine all products
        $products = $iphones->concat($samsung)->concat($pixels);
        
        return view('index', compact('products')); 
    }

    public function show($id)
    {
        // Fetch product by ID
        $product = Products::findOrFail($id);
        
        // Get related products (same subcategory, excluding current)
        $relatedProducts = Products::where('subcategory', $product->subcategory)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        // If not enough related products, fill with products from same category
        if ($relatedProducts->count() < 4) {
             $moreRelated = Products::where('category', $product->category)
                ->where('id', '!=', $id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->limit(4 - $relatedProducts->count())
                ->get();
             $relatedProducts = $relatedProducts->concat($moreRelated);
        }
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function allProducts(Request $request)
    {
        $query = Products::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('subcategory', 'LIKE', "%{$search}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Subcategory Filter
        if ($request->filled('subcategory')) {
            $query->where('subcategory', $request->subcategory);
        }

        $products = $query->orderBy('category', 'desc')->paginate(12)->withQueryString();

        // Get Categories and Subcategories for Sidebar
        $categories = Products::select('category', 'subcategory')
            ->distinct()
            ->orderBy('category')
            ->orderBy('subcategory')
            ->get()
            ->groupBy('category')
            ->sortBy(function ($subcategories, $key) {
                return $key === 'Mobile Phones' ? 0 : 1;
            });

        return view('products.index', compact('products', 'categories'));
    }
}
