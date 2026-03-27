<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

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

            // ✅ SET LOGIN
            DB::table('users')
                ->where('id_pengguna', Auth::id())
                ->update([
                    'last_activity' => time()
                ]);

            return redirect()->intended(route('gurubk.dashboard'));
        }

        return back()->withErrors([
            'username' => 'NIP atau Password yang diberikan Admin salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        // ✅ SET LOGOUT
        if (Auth::check()) {
            DB::table('users')
                ->where('id_pengguna', Auth::id())
                ->update([
                    'last_activity' => 1
                ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gurubk.login');
    }
}