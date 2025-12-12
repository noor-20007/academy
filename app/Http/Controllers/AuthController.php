<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function showRegister()
    {
        $courses = \App\Models\Course::all();
        return view('auth.register', compact('courses'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'mobile' => 'nullable|string|max:30',
            'age' => 'nullable|integer|min:10|max:120',
            'requested_course_id' => 'nullable|exists:courses,id',
        ]);

        // Create student account but do not approve yet. Admin will approve and enroll.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'mobile' => $validated['mobile'] ?? null,
            'age' => $validated['age'] ?? null,
            'approved' => false,
            'requested_course_id' => $validated['requested_course_id'] ?? null,
        ]);

        // Do NOT auto-login. Show a pending message.
        return redirect('/')->with('status', 'تم إنشاء الحساب بنجاح. سيتم مراجعته من قبل الإدارة، ستتلقى إشعارًا عند الموافقة.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
