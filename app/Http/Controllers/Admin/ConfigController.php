<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:30',
            'app_footer' => 'required|string|max:50',
        ]);

        // Simpan ke .env (Sederhana untuk UKK)
        $path = base_path('.env');
        if (file_exists($path)) {
            $content = file_get_contents($path);
            
            $content = preg_replace('/APP_NAME=.*/', 'APP_NAME="' . $request->app_name . '"', $content);
            
            // Cek jika APP_FOOTER sudah ada, jika belum tambahkan
            if (str_contains($content, 'APP_FOOTER=')) {
                $content = preg_replace('/APP_FOOTER=.*/', 'APP_FOOTER="' . $request->app_footer . '"', $content);
            } else {
                $content .= "\nAPP_FOOTER=\"" . $request->app_footer . "\"";
            }

            file_put_contents($path, $content);
            
            // Penting: Clear cache agar perubahan langsung terlihat
            Artisan::call('config:clear');
        }

        return back()->with('success', 'Konfigurasi identitas sekolah berhasil diperbarui!');
    }
}