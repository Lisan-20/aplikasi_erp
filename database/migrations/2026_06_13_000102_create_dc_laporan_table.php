<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('dc_laporan')) {
            return;
        }

        Schema::create('dc_laporan', function (Blueprint $table) {
            $table->increments('id_dc_laporan');
            $table->string('kode_laporan', 12)->nullable();
            $table->string('nama_laporan', 100)->nullable();
            $table->string('judul_laporan', 100)->nullable();
            $table->string('keterangan_lap')->nullable();
            $table->string('jenis_kertas', 2)->nullable();
            $table->string('posisi_cetak', 1)->nullable();
            $table->tinyInteger('id_jenis_printout')->nullable();
            $table->string('kop', 50)->nullable();
            $table->integer('num_per_page')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_laporan');
    }
};
