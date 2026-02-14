<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginProses(Request $request) {
        $usernameInput = $request->username;
        $passwordInput = $request->password;

       $userByName = User::where('name', $request->username)->first();
     

       if($userByName && $userByName->is_first_login) {
        if ($passwordInput === $userByName->nipd) {
            Auth::login($userByName);
            return redirect()->route('password.new');
            }
       }
        if (Auth::attempt(['nipd' => $usernameInput, 'password' => $passwordInput])) {
            return redirect()->route('home');
        }
       
       return back()->with('error', 'Username atau Password salah!');
     }

     public function savePassword(Request $request)
     {
       $rules = [
        'password'=> 'required|min:6|confirmed',
       ];

       if ($request->type == 'first_login') {
        $rules['email'] = 'required|email|unique:users,email';
       }
       $request->validate($rules);

       $user = User::findOrFail($request->user_id);
       $user->password = Hash::make($request->password);
       $user->is_first_login = false;

       if ($request->has('email')) {
        $user->email = $request->email;
       }
       $user->save();

       if (Auth::check()) {
            Auth::logout();
       }
       return Redirect()->route('login.siswa')->with('success', 'Data Berhasil diperbaharui, silahkan login dengan password baru');
     }

    public function verifyAccount(Request $request)
    {
        $user = User::where('nipd', $request->nipd)->first();

        if($user) {
            $otp = rand(100000, 999999);
            $user->otp_code = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            
            // dd($user->email, $otp);

            
            Mail::to($user->email)->send(new OtpMail($otp));

            session(['otp_user_id' => $user->id]);
            return redirect()->route('otp.view');
        }

        return back()->with('error', 'NIPD tidak ditemukan dalam sistem kami.');
    }


     public function showResetPage(Request $request) {
    
    if(Auth::check()) {
        return view('login.reset-pass', [
            'type' => 'first_login', 
            'title' => 'Buat Password Keamanan',
            'user_id' => Auth::id()
        ]);
    }

    
    if (session()->has('reset_user_id')) {
        return view('login.reset-pass', [
            'type' => 'forgot_password',
            'title' => 'Atur ulang password',
            'user_id' => session('reset_user_id')
        ]);
    }

    return redirect()->route('login.siswa')->with('error', 'Silahkan verifikasi akun');
    }

     public function processOtp(Request $request) 
     {
        
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('login.siswa')->with('error', 'Sesi berakhir, silahkan mengulang verifikasi');
        }

        if($user->otp_code == $request->otp && Carbon::now()->lt($user->otp_expires_at)) {
            $user->otp_code = null;
            $user->otp_expires_at =null;
            $user->save();

            session(['reset_user_id' => $user->id]);

            return redirect()->route('password.new')->with('success', 'Kode sesuai! Silahkan atur password baru ');
        }

        return back()->with('error', 'Kode OTP salah atau sudah kadaluarsa!');
     }

     public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.siswa');
     }
}
