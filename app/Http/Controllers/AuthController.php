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

<<<<<<< HEAD
        if ($user->is_first_login && ($role === 'Siswa' || $role === 'GuruBK'))
        {
            $isValid = false;
            if ($role === 'Siswa' && $user->siswa) {
                if ($password === $user->siswa->nipd) $isValid = true;
            } elseif ($role === 'GuruBK' && $user->gurubk) {
                if ($password === $user->gurubk->NIP) $isValid = true;
            }

            if ($isValid) {
                Auth::login($user);
                return redirect()->route('password.new');
            }
        }

        if (Auth::attempt(['username' => $input, 'password' => $password]))
            {
                $request->session()->regenerate();

                return match ($user->role) {
                'Admin' => redirect()->route('admin.dashboard'),
                'GuruBK' => redirect()->route('gurubk.dashboard'),
                'Siswa' => redirect()->route('home'), 
                default => redirect('/'),
                 };
            }

            return back()->with('error', 'Username atau password salah!');
    }

  public function login($role) 
    {
    $validRoles = ['Siswa', 'GuruBK', 'Admin'];
    if (!in_array($role, $validRoles)) {
        return redirect()->route('choose.role');
    }

   
    return view('auth.login', compact('role'));
    }

    public function showResetPage() {
    if(Auth::check()) {
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

    return redirect()->route('choose.role')->with('error', 'Silahkan verifikasi akun atau login terlebih dahulu');
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'user_id' => 'required'
        ]);

        $user = User::where('id_pengguna', $request->user_id)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->is_first_login = false;

        if ($request->has('email')) {
            $user->email = $request->email;
        }
        $user->save();

        Auth::logout();
        return redirect()->route('choose.role')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }

    public function verifyAccount(Request $request)
    {
        // Cari identitas (NIPD atau NIP) di tabel terkait
        $siswa = Siswa::where('nipd', $request->identitas)->first();
        $gurubk = Gurubk::where('NIP', $request->identitas)->first();

        $user = null;
        if ($siswa) $user = User::find($siswa->id_pengguna);
        elseif ($gurubk) $user = User::find($gurubk->id_pengguna);

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

    public function processOtp(Request $request) 
    {
        $request->validate(['otp' => 'required|numeric']);
        $user = User::find(session('otp_user_id'));

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
=======
        // Jika gagal
        return back()->withErrors(['username' => 'Username atau password salah!'])
                     ->onlyInput('username');
>>>>>>> 7b861502c2ee8ee4f554d080ca4e2b398ab534af
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
