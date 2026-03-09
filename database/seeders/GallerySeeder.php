<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['title' => 'Layanan Orientasi & Informasi', 'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800'],
            ['title' => 'Konseling Perorangan', 'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800'],
            ['title' => 'Diskusi Konseling Kelompok', 'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800'],
            ['title' => 'Penempatan & Penyaluran Siswa', 'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800'],
            ['title' => 'Layanan Advokasi Siswa', 'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800'],
            ['title' => 'Kegiatan BK Online', 'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800'],
            ['title' => 'Pelaporan Mandiri (Self Report)', 'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800'],
            ['title' => 'Monitoring Pelanggaran Poin', 'image' =>  'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800'],
             ['title' => 'Monitoring Pelanggaran Poin', 'image' =>  'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=800'],
        ];

        foreach ($data as $item) {
            Gallery::create($item);
        }
    }
}