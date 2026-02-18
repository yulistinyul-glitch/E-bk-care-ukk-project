<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;      
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Support\Str;              
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan halaman login
public function showLogin()
{
    if (Auth::check()) {
        $user = Auth::user();
        return match ($user->role) {
            'Admin'  => redirect()->route('admin.dashboard'),
            'GuruBK' => redirect()->route('gurubk.dashboard'),
            'Siswa'  => redirect()->route('siswa.home'),
            default  => redirect()->route('login')
        };
    }

    return view('auth.login');
}


    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);                 // Login user
            $request->session()->regenerate();   // Regenerate session untuk keamanan

            // Redirect sesuai role
            return match ($user->role) {
                'Admin'  => redirect()->route('admin.dashboard'),
                'GuruBK' => redirect()->route('gurubk.dashboard'),
                'Siswa'  => redirect()->route('siswa.home'),
                default  => redirect()->route('login')
            };
        }

        // Jika gagal
        return back()->withErrors(['username' => 'Username atau password salah!'])
                     ->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Form lupa password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Kirim link reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'username' => ['required', 'exists:users,username']
        ]);

        $token = Str::random(60);

        // Simpan token di tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['username' => $request->username],
            [
                'token'      => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Redirect ke form reset password (bisa kirim email di sini)
        return redirect()->route('password.reset', [
            'token'    => $token,
            'username' => $request->username
        ])->with('status', 'Link reset password dibuat!');
    }

    // Form reset password
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token'    => $token,
            'username' => $request->username
        ]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'username' => 'required|exists:users,username',
            'password' => 'required|min:6|confirmed'
        ]);

        $record = DB::table('password_reset_tokens')
                    ->where('username', $request->username)
                    ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['username' => 'Token tidak valid']);
        }

        $user = User::where('username', $request->username)->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')
          ->where('username', $request->username)
          ->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset!');
    }
}
