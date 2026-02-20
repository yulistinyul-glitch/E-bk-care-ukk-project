<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Menghindari error constraint dan mengosongkan data lama
        Schema::disableForeignKeyConstraints();
        Service::truncate();
        Schema::enableForeignKeyConstraints();

$services = [
            [
                'title'       => 'Privacy Space',
                'slug'        => Str::slug('Privacy Space'),
                'icon'        => 'bi-chat-right-dots-fill',
                'description' => 'Sampaikan bebanmu melalui sesi chat rahasia bersama Guru BK untuk bimbingan profesional.',
            ],
            [
                'title'       => 'Voice of Change',
                'slug'        => Str::slug('Voice of Change'),
                'icon'        => 'bi-mailbox2',
                'description' => 'Salurkan aspirasi, keluhan, atau ide secara anonim untuk membangun lingkungan sekolah yang lebih baik.',
            ],
            [
                'title'       => 'Protection System',
                'slug'        => Str::slug('Protection System'),
                'icon'        => 'bi-shield-lock-fill',
                'description' => 'Laporkan perundungan atau bahaya secara aman. Kami lindungi identitasmu sepenuhnya.',
            ],
            [
                'title'       => 'Discipline Info',
                'slug'        => Str::slug('Discipline Info'),
                'icon'        => 'bi-file-earmark-bar-graph',
                'description' => 'Pantau data poin pelanggaran secara real-time. Transparansi penuh untuk menjaga integritas siswa.',
            ],
        ];
        foreach ($services as $service) {
            Service::create($service);
        }
    }
}