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
        Schema::create('th_laporan_persalinan', function (Blueprint $table) {
            $table->increments('id_laporan_persalinan');
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->text('jalannya_persalinan')->nullable();
            $table->string('tensi', 10)->nullable();
            $table->string('nadi', 10)->nullable();
            $table->string('pernafasan', 10)->nullable();
            $table->string('suhu', 10)->nullable();
            $table->string('fundas_uteri', 10)->nullable();
            $table->string('kontraksinya', 10)->nullable();
            $table->string('plasenta1', 10)->nullable();
            $table->string('plasenta2', 10)->nullable();
            $table->string('pendarahan', 10)->nullable();
            $table->string('perincum', 15)->nullable();
            $table->string('dijahit_dgn', 10)->nullable();
            $table->string('keadaan_bayi', 10)->nullable();
            $table->string('jen_kel_bayi', 1)->nullable();
            $table->string('berat_bayi', 5)->nullable();
            $table->string('panjang_bayi', 5)->nullable();
            $table->string('dada_bayi', 5)->nullable();
            $table->string('kepala_bayi', 5)->nullable();
            $table->string('anus_bayi', 50)->nullable();
            $table->string('kongenital', 50)->nullable();
            $table->integer('jantung_bayi')->nullable();
            $table->integer('jantung_mnt1')->nullable();
            $table->integer('jantung_mnt5')->nullable();
            $table->integer('jantung_mnt10')->nullable();
            $table->integer('nafas_bayi')->nullable();
            $table->integer('nafas_mnt1')->nullable();
            $table->integer('nafas_mnt5')->nullable();
            $table->integer('nafas_mnt10')->nullable();
            $table->integer('otot_bayi')->nullable();
            $table->integer('otot_mnt1')->nullable();
            $table->integer('otot_mnt5')->nullable();
            $table->integer('otot_mnt10')->nullable();
            $table->integer('peka_bayi')->nullable();
            $table->integer('peka_mnt1')->nullable();
            $table->integer('peka_mnt5')->nullable();
            $table->integer('peka_mnt10')->nullable();
            $table->integer('warna_bayi')->nullable();
            $table->integer('warna_mnt1')->nullable();
            $table->integer('warna_mnt5')->nullable();
            $table->integer('warna_mnt10')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('tgl_input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_laporan_persalinan');
    }
};
