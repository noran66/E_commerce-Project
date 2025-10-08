<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name'  => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'name.required' => 'Please enter your name.',
            'email.unique' => 'This email is already subscribed!',
        ]);

        
        Subscriber::create($validated);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}

