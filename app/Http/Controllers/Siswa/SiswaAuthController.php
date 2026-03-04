<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;



class SiswaAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
    $request->validate([
        'username' => 'required', 
        'password' => 'required', 
    ]);

    $siswa = \App\Models\Siswa::where('nama_siswa', $request->username)
                ->where('NIPD', $request->password)
                ->first();

    if ($siswa) {
        $user = $siswa->user; 

        if ($user && $user->is_first_login == 1) {
            Auth::login($user);
            return redirect()->route('siswa.setup-password');
        }
    }

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'role' => 'Siswa'])) {
        return redirect()->intended(route('siswa.home'));
    }

    return back()->withErrors(['username' => 'Nama/NIPD atau Password salah.']);
    }

    public function showForgotForm() {
        return view('auth.forgetpw'); 
    }

    public function sendOtp(Request $request) 
    {
        $request->validate([
            'username' => 'required|exists:users,username'
        ]);

        $user = User::where('username', $request->username)
                    ->where('role', 'Siswa')
                    ->first();

        if (!$user || !$user->email) {
            return back()->withErrors(['username' => 'Akun Anda belum diaktivasi atau NIPD tidak ditemukan.']);
        }

        $otp = rand(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        $hiddenEmail = substr($user->email, 0, 3) . '****' . substr($user->email, strpos($user->email, "@"));
        
        return redirect()->route('siswa.verify-otp-page', ['username' => $user->username])
                 ->with('success', "Kode OTP telah dikirim...");
    }

   
    public function showVerifyOtpForm($username) {
        return view('auth.verify-code', ['username' => $username]);
    }

    public function verifyOtp(Request $request) {
        $request->validate([
            'username' => 'required', // Kita gunakan username untuk cari user
            'otp' => 'required|digits:6',
            'new_password' => 'required|min:8|confirmed'
        ]);

        $user = User::where('username', $request->username)
                    ->where('otp_code', $request->otp)
                    ->where('otp_expires_at', '>', Carbon::now())
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        return redirect()->route('siswa.login')->with('success', 'Password berhasil direset.');
    }

    public function checkOtp(Request $request) {
        $request->validate([
            'username' => 'required',
            'otp' => 'required|digits:6'
        ]);

        $user =  User::where('username', $request->username)
                     ->where('otp_code', $request->otp)
                     ->where('otp_expires_at', '>', now())
                     ->first();
        
        if (!$user) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau kadaluarsa']);
        }

        return redirect()->route('siswa.reset-password', [
            'username' => $user->username,
            'otp' => $user->otp_code
        ]);
    }

    public function showResetPasswordForm($username, $otp) {
        return view('auth.reset-pass', compact('username', 'otp'));
    }

    public function updatePassword(Request $request) {
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Ambil user yang sedang login (dari proses Alur A tadi)
    $user = User::with('siswa')->find(Auth::id());
    
    if (!$user || !$user->siswa) {
        return redirect()->route('siswa.login')->withErrors(['error' => 'Data tidak ditemukan.']);
    }

    // Update data di tabel users
    $user->update([
        'username' => $user->siswa->NIPD,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_first_login' => 0 
    ]);

    Auth::logout(); 
    
    return redirect()->route('siswa.login')->with('success', 'Akun aktif! Silakan login menggunakan NIPD kamu.');
    }

    public function showSetupForm() {
        return view('auth.new-pass');
    }
    
    public function updatePasswordReset(Request $request) {
    $request->validate([
        'username' => 'required',
        'otp' => 'required',
        'new_password' => 'required|min:8|confirmed', // Mencari input 'new_password_confirmation'
    ]);

    // Cari user berdasarkan username dan otp
    // PASTIKAN: nama kolom di database sudah kamu ubah dari 'otp_exprires_at' jadi 'otp_expires_at'
    $user = User::where('username', $request->username)
                ->where('otp_code', $request->otp)
                ->first();

    if (!$user) {
        return back()->withErrors(['otp' => 'Kode OTP salah atau sesi telah berakhir.']);
    }

    $user->update([
        'password' => Hash::make($request->new_password),
        'otp_code' => null,
        'otp_expires_at' => null
    ]);

    return redirect()->route('siswa.login')->with('success', 'Password berhasil diubah!');
}
}