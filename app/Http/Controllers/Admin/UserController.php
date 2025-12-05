<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Toggle user type between 'user' and 'admin'.
     */
    public function toggleType($id)
    {
        $user = User::findOrFail($id);

        // Toggle between 'user' and 'admin'
        $user->type = ($user->type === 'admin') ? 'user' : 'admin';
        $user->save();

        $newType = $user->type === 'admin' ? 'Admin' : 'User';

        return redirect()->route('admin.users.index')
            ->with('success', "User type changed to {$newType} successfully!");
    }
}
