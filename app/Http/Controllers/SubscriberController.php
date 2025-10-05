<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // ✅ التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // ✅ حفظ البيانات
        Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // ✅ الرد بعد الحفظ
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}

