<?php

namespace App\Http\Controllers\Gurubk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruAuthController extends Controller
{
   
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', 
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'username' => $request->username, 
            'password' => $request->password, 
            'role'     => 'GuruBK'
        ])) {
            $request->session()->regenerate();

            return redirect()->intended(route('gurubk.dashboard'));
        }

        return back()->withErrors([
            'username' => 'NIP atau Password yang Anda masukkan salah.',
        ])->withInput($request->only('username'));
    }

 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gurubk.login');
    }
}