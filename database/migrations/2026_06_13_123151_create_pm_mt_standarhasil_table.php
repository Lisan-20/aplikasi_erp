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
        Schema::create('pm_mt_standarhasil', function (Blueprint $table) {
            $table->string('kode_mt_hasilpm')->nullable();
            $table->string('kode_tarif')->nullable();
            $table->string('nama_pemeriksaan')->nullable();
            $table->string('kode_bagian')->nullable();
            $table->text('standar_hasil_wanita')->nullable();
            $table->text('standar_hasil_pria')->nullable();
            $table->text('standar_hasil_0_2')->nullable();
            $table->text('standar_hasil_2_6')->nullable();
            $table->text('standar_hasil_6_6t')->nullable();
            $table->text('standar_hasil_6t_18t')->nullable();
            $table->string('pregnance', 500)->nullable();
            $table->string('satuan')->nullable();
            $table->integer('urutan')->nullable();
            $table->decimal('shw_min', 18)->nullable();
            $table->decimal('shw_max', 18)->nullable();
            $table->decimal('shp_min', 18)->nullable();
            $table->decimal('shp_max', 18)->nullable();
            $table->integer('flag_baca')->nullable();
            $table->integer('w_char')->nullable();
            $table->integer('p_char')->nullable();
            $table->integer('flag_std_hasil')->nullable();
            $table->string('std_text_p', 100)->nullable();
            $table->string('std_text_l', 100)->nullable();
            $table->decimal('sha_min', 18)->nullable();
            $table->decimal('sha_max', 18)->nullable();
            $table->decimal('shn_min', 18)->nullable();
            $table->decimal('shn_max', 18)->nullable();
            $table->text('catatan')->nullable();
            $table->string('kode_pemeriksaan', 150)->nullable();
            $table->string('kode_pemeriksaan_det', 150)->nullable();
            $table->string('kode_speciment', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_mt_standarhasil');
    }
};
