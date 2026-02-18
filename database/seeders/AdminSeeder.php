<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // ==============================
        // akun user untuk admin
        // ==============================
        $user = User::create([
            'id_pengguna' => 'USR001',
            'username'    => 'superadmin',
            'password'    => Hash::make('admin123'), 
            'role'        => 'Admin',
        ]);

        // ==============================
        //  data admin
        // ==============================
        Admin::create([
            'id_admin'    => 'ADM001',
            'id_pengguna' => $user->id_pengguna,
            'nama_admin'  => 'Admin Utama',
            'JK'          => 'L',
            'no_telp'     => '08123456789',
            'email'       => 'admin@domain.com',
            'alamat'      => 'Jl. Contoh No.1',
        ]);
    }
}
