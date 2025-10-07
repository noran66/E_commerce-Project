<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // عرض الصفحة
    public function showForm()
    {
        return view('auth.auth');
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/user-dashboard')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->with('error', 'بيانات الدخول غير صحيحة')->withInput();
    }

    // التسجيل
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/user-dashboard')->with('success', 'تم إنشاء الحساب وتسجيل الدخول');
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect('/auth')->with('success', 'تم تسجيل الخروج');
    }
}
