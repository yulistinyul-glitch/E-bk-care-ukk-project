<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Gurubk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    /**
     * Menampilkan Form Login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Proses Login Utama
     */
    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan!');
        }

        // 1. Logika Login Pertama Kali (First Login)
        if ($user->is_first_login) {
            $isValid = false;
            
            if ($user->role === 'Siswa' && $user->siswa) {
                if ($password === $user->siswa->nipd) $isValid = true;
            } elseif ($user->role === 'GuruBK' && $user->gurubk) {
                if ($password === $user->gurubk->NIP) $isValid = true;
            }

            if ($isValid) {
                Auth::login($user);
                return redirect()->route('password.new');
            }
        }

        // 2. Logika Login Normal (Bcrypt Hash)
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user());
        }

        return back()->with('error', 'Username atau password salah!');
    }

    /**
     * Helper untuk redirect berdasarkan role
     */
    private function redirectByRole($user)
    {
        return match ($user->role) {
            'Admin'  => redirect()->route('admin.dashboard'),
            'GuruBK' => redirect()->route('gurubk.dashboard'),
            'Siswa'  => redirect()->route('siswa.home'),
            default  => redirect()->route('login')
        };
    }

    /**
     * Menampilkan Halaman Ganti Password
     */
    public function showResetPage() 
    {
        if (Auth::check()) {
            return view('auth.reset-pass', [
                'type' => 'first_login', 
                'title' => 'Buat Password Keamanan',
                'user_id' => Auth::id()
            ]);
        }

        if (session()->has('reset_user_id')) {
            return view('auth.reset-pass', [
                'type' => 'forgot_password',
                'title' => 'Atur ulang password',
                'user_id' => session('reset_user_id')
            ]);
        }

        return redirect()->route('login')->with('error', 'Silahkan verifikasi akun atau login terlebih dahulu');
    }

    /**
     * Menyimpan Password Baru
     */
    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'user_id' => 'required'
        ]);

        // Sesuaikan primary key, biasanya 'id' atau 'id_pengguna'
        $user = User::where('id_pengguna', $request->user_id)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->is_first_login = false;

        if ($request->has('email')) {
            $user->email = $request->email;
        }
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }

    /**
     * Verifikasi Akun lewat NIP/NIPD untuk Reset
     */
    public function verifyAccount(Request $request)
    {
        $request->validate(['identitas' => 'required']);

        $siswa = Siswa::where('nipd', $request->identitas)->first();
        $gurubk = Gurubk::where('NIP', $request->identitas)->first();

        $user = null;
        if ($siswa) $user = User::where('id_pengguna', $siswa->id_pengguna)->first();
        elseif ($gurubk) $user = User::where('id_pengguna', $gurubk->id_pengguna)->first();

        if ($user && $user->email) {
            $otp = rand(100000, 999999);
            $user->otp_code = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            Mail::to($user->email)->send(new OtpMail($otp));

            session(['otp_user_id' => $user->id_pengguna]);
            return redirect()->route('otp.view');
        }

        return back()->with('error', 'Identitas tidak ditemukan atau email belum diatur.');
    }

    /**
     * Proses Cek OTP
     */
    public function processOtp(Request $request) 
    {
        $request->validate(['otp' => 'required|numeric']);
        $user = User::where('id_pengguna', session('otp_user_id'))->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Sesi berakhir.');
        }

        if ($user->otp_code == $request->otp && Carbon::now()->lt($user->otp_expires_at)) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            session(['reset_user_id' => $user->id_pengguna]);
            return redirect()->route('password.new')->with('success', 'OTP Benar!');
        }

        return back()->with('error', 'OTP salah atau kadaluarsa.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}