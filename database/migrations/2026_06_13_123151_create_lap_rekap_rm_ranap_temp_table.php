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
        if (Schema::hasTable('lap_rekap_rm_ranap_temp')) {
            return;
        }

        Schema::create('lap_rekap_rm_ranap_temp', function (Blueprint $table) {
            $table->integer('Tanggal')->nullable();
            $table->integer('pasien_awal')->nullable();
            $table->integer('pasien_masuk')->nullable();
            $table->integer('pasien_pindahan')->nullable();
            $table->integer('jumlah_1')->nullable();
            $table->integer('pasien_dipindahkan')->nullable();
            $table->integer('pasien_keluar_hidup')->nullable();
            $table->integer('pasien_mati')->nullable();
            $table->integer('kurang_dr_48_jam')->nullable();
            $table->integer('lebih_dr_48_jam')->nullable();
            $table->integer('jumlah_2')->nullable();
            $table->integer('lama_dirawat')->nullable();
            $table->integer('pasien_keluar_masuk')->nullable();
            $table->integer('pasien_sisa')->nullable();
            $table->integer('kelas_vvip')->nullable();
            $table->integer('kelas_vip')->nullable();
            $table->integer('kelas_1')->nullable();
            $table->integer('kelas_2')->nullable();
            $table->integer('kelas_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_rekap_rm_ranap_temp');
    }
};
