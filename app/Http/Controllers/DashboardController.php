<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product; // Assuming Product model exists, I'll check/create if needed
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Overview Stats
        $totalProducts = DB::table('products')->count();
        $totalCustomers = User::where('type', 'user')->count();
        $totalOrders = Order::count();

        // 2. Latest Products (Limit 5)
        $latestProducts = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 3. Latest Orders (Limit 5)
        // We need to process the 'products' JSON column to get product names if needed, 
        // but for the table view, we might just show the first product or a summary.
        // Based on the image, it shows "Products" column.
        $latestOrders = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.email as user_email')
            ->orderBy('orders.created_at', 'desc')
            ->limit(5)
            ->get();

        // 4. Latest Customers (Limit 5)
        $latestCustomers = User::where('type', 'user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 5. Latest Feedback (Limit 5)
        $latestFeedback = Feedback::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 6. Accepted Orders Stats
        $acceptedOrdersCount = DB::table('accepted_orders')->count();
        $acceptedOrdersTotal = DB::table('accepted_orders')->sum('total_amount');

        return view('dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'latestProducts',
            'latestOrders',
            'latestCustomers',
            'latestFeedback',
            'acceptedOrdersCount',
            'acceptedOrdersTotal'
        ));
    }
}
