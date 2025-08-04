<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        if (Auth()->check()) {
            return redirect('/dashboard');
        }
        return view('/login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $redirectUrl = $request->session()->get('url.intended', route('dashboard'));
            return response()->json([
                'success' => true,
                'redirect' => $redirectUrl,
                'user' => [
                    'name' => Auth::user()->name,
                    'role' => Auth::user()->role ?? 'Quản trị viên' // Thêm trường role nếu có
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'email' => ['Email hoặc mật khẩu không đúng.']
            ]
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['success' => true, 'redirect' => '/login']);
    }
}
