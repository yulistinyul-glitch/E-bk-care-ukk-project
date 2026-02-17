<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('e_surats', function (Blueprint $table) {
            $table->enum('status',
                ['draft','pdf','emailed','selesai'])
                ->default('draft')
                ->after('keterangan_tambahan');
        });
    }

    public function down()
    {
        Schema::table('e_surats', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
