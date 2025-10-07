<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // ✅ التحقق من المدخلات
       $validated = $request->validate([
            'name'  => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'name.required' => 'Please enter your name.',
            'email.unique' => 'This email is already subscribed!',
        ]);

        // ✅ حفظ البيانات
        
        Subscriber::create($validated);

        // ✅ الرد بعد الحفظ
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}

