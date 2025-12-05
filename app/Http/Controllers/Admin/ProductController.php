<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index()
    {
        $products = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'ram' => 'nullable|string|max:50',
            'storage' => 'nullable|string|max:50',
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048', // 2MB max
            'description' => 'nullable|string',
        ]);

        // Handle file upload if present
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/products');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/images/products
            $file->move($uploadPath, $filename);
            
            // Add image path to validated data
            $validated['image'] = 'images/products/' . $filename;
        }

        // Remove image_file from the insert data (we only store the path in 'image' column)
        unset($validated['image_file']);

        // Add timestamps
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        DB::table('products')->insert($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product not found.');
        }

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'ram' => 'nullable|string|max:50',
            'storage' => 'nullable|string|max:50',
            'image' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048', // 2MB max
            'description' => 'nullable|string',
        ]);

        // Handle file upload if present
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/products');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public/images/products
            $file->move($uploadPath, $filename);
            
            // Update validated data with new image path
            $validated['image'] = 'images/products/' . $filename;
            
            // Delete old image if it exists and is a local file
            $oldProduct = DB::table('products')->where('id', $id)->first();
            if ($oldProduct && $oldProduct->image && !filter_var($oldProduct->image, FILTER_VALIDATE_URL)) {
                $oldImagePath = public_path($oldProduct->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            // If no file uploaded, keep the URL from the text field
            // Remove image_file from validated data
            unset($validated['image_file']);
        }

        // Remove image_file from the update data (we only store the path in 'image' column)
        unset($validated['image_file']);

        DB::table('products')
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
