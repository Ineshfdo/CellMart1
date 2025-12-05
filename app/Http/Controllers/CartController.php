<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $key => $item) {
            // New cart structure with detailed items
            if (is_array($item) && isset($item['product_id'])) {
                $product = Products::find($item['product_id']);
                if ($product) {
                    $subtotal = $product->price * $item['quantity'];
                    $cartItems[] = [
                        'key' => $key,
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'color' => $item['color'],
                        'warranty' => $item['warranty'],
                        'subtotal' => $subtotal
                    ];
                    $total += $subtotal;
                }
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
            'color' => 'required|string|in:Black,White,Blue,Red,Green',
            'warranty' => 'required|string|in:1 Year Company Warranty,2 Years Extended Warranty'
        ]);

        $product = Products::findOrFail($id);
        $cart = session()->get('cart', []);

        // Create a unique key for this product variant (product_id + color + warranty)
        $cartKey = $id . '_' . $validated['color'] . '_' . $validated['warranty'];

        if (isset($cart[$cartKey])) {
            // If same product with same color and warranty exists, add to quantity
            $cart[$cartKey]['quantity'] += $validated['quantity'];
        } else {
            // Add new cart item with all details
            $cart[$cartKey] = [
                'product_id' => $id,
                'quantity' => $validated['quantity'],
                'color' => $validated['color'],
                'warranty' => $validated['warranty'],
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        
        foreach ($request->quantities as $key => $quantity) {
            if ($quantity > 0 && isset($cart[$key])) {
                $cart[$key]['quantity'] = $quantity;
            } elseif ($quantity <= 0 && isset($cart[$key])) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove($key)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            if (is_array($item) && isset($item['quantity'])) {
                $count += $item['quantity'];
            }
        }
        
        return $count;
    }
}
