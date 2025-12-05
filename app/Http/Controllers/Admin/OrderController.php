<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.email as user_email')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Accept an order - move it to accepted_orders table.
     */
    public function accept($id)
    {
        // Get the order
        $order = DB::table('orders')->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('admin.orders.index')
                ->with('error', 'Order not found.');
        }

        // Insert into accepted_orders
        DB::table('accepted_orders')->insert([
            'user_id' => $order->user_id,
            'customer_name' => $order->customer_name,
            'customer_email' => $order->customer_email,
            'customer_phone' => $order->customer_phone,
            'delivery_address' => $order->delivery_address,
            'products' => $order->products,
            'total_amount' => $order->total_amount,
            'currency' => $order->currency ?? 'LKR',
            'status' => 'accepted',
            'accepted_at' => now(),
            'created_at' => $order->created_at,
            'updated_at' => now(),
        ]);

        // Delete from orders table
        DB::table('orders')->where('id', $id)->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order accepted successfully!');
    }

    /**
     * Delete an order.
     */
    public function destroy($id)
    {
        DB::table('orders')->where('id', $id)->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
