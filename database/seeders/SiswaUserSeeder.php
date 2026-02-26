<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;


class SiswaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semuaSiswa = Siswa::all();

        foreach ($semuaSiswa as $siswa) {
            User::updateOrCreate(
                ['id_pengguna' => $siswa->id_pengguna],
                [
                    'username'       => $siswa->nama_siswa,
                    'password'       => Hash::make($siswa->NIPD), 
                    'role'           => 'Siswa',
                    'is_first_login' => 1, 
                    'email'          => null,
                ]
            );
        }
    }
}
