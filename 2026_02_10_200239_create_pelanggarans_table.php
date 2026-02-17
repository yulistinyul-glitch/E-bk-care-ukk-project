<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggarans', function (Blueprint $table) {

            $table->string('id_pelanggaran', 6)->primary();

            $table->enum('kategori_pelanggaran', [
                'Keterlambatan',
                'Kehadiran',
                'Kelengkapan Seragam',
                'Kepribadian',
                'Ketertiban',
                'Merokok',
                'Media Konten Negatif',
                'Senjata',
                'MIRAS & NARKOBA',
                'Perkelahian',
                'Etika & Moral',
                'Perjudian'
            ]);

            $table->string('jenis_kegiatan', 100);
            $table->enum('tingkatan', ['ringan', 'sedang', 'berat']);
            $table->unsignedInteger('poin_pelanggaran');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggarans');
    }
};
