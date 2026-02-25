<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
    $gurus = DB::table('gurubks')->get();

    foreach ($gurus as $guru) {
        DB::table('users')->updateOrInsert(
            // Cari berdasarkan NIP (sebagai username)
            ['username' => $guru->NIP], 
            [
                // Gunakan nama kolom id_gurubk sesuai gambar phpMyAdmin kamu
                'id_pengguna'    => $guru->id_gurubk, 
                'password'       => Hash::make($guru->NIP), // Password default = NIP
                'role'           => 'GuruBK',
                'is_first_login' => 0,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]
        );
     }
    }
}
