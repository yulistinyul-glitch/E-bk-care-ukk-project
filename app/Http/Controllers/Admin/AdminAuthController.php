<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.loginAdmin');
    }

    public function login(Request $request) {
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        
        if (Auth::user()->role !== 'Admin') {
            Auth::logout();
            return back()->withErrors(['username' => 'Anda bukan Admin!']);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'username' => 'Username atau password salah',
    ])->withInput();
}
}
