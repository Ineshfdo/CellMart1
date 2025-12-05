<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of all customers.
     */
    public function index()
    {
        $customers = User::where('type', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.customers.index', compact('customers'));
    }
}
