<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $key => $item) {
            if (is_array($item) && isset($item['product_id'])) {
                $product = Products::find($item['product_id']);
                if ($product) {
                    $subtotal = $product->price * $item['quantity'];
                    $cartItems[] = [
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

        // Get authenticated user data for auto-filling the form
        $user = auth()->user();

        return view('checkout.index', compact('cartItems', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'customer_name' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        $orderProducts = [];
        $total = 0;

        foreach ($cart as $key => $item) {
            if (is_array($item) && isset($item['product_id'])) {
                $product = Products::find($item['product_id']);
                if ($product) {
                    $subtotal = $product->price * $item['quantity'];
                    $orderProducts[] = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'color' => $item['color'],
                        'warranty' => $item['warranty'],
                        'subtotal' => $subtotal,
                        'image' => $product->image,
                        'currency' => $product->currency
                    ];
                    $total += $subtotal;
                }
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(), // Link order to logged-in user
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'delivery_address' => $request->delivery_address,
            'products' => $orderProducts,
            'total_amount' => $total,
            'currency' => $orderProducts[0]['currency'] ?? 'LKR',
            'status' => 'pending'
        ]);

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('checkout.success', compact('order'));
    }
}
