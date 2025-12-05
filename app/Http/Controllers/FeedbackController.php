<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Backend validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000'
        ]);

        // Save feedback to database
        Feedback::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
