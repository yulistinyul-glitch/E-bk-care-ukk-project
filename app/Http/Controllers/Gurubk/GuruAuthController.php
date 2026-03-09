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
        'username' => 'required', // NIP
        'password' => 'required', // Password dari Admin
    ]);

    // Laravel akan otomatis meng-hash password inputan 
    // dan mencocokkannya dengan hash di database
    if (Auth::attempt([
        'username' => $request->username, 
        'password' => $request->password, 
        'role'     => 'GuruBK'
    ])) {
        $request->session()->regenerate();
        return redirect()->intended(route('gurubk.dashboard'));
    }

    return back()->withErrors([
        'username' => 'NIP atau Password yang diberikan Admin salah.',
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