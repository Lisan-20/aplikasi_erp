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
        if (Schema::hasTable('gd_tc_cetak_racun')) {
            return;
        }

        Schema::create('gd_tc_cetak_racun', function (Blueprint $table) {
            $table->increments('id_cetak_racun');
            $table->string('no_mr', 6)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('tempat_kejadian')->nullable();
            $table->string('keluhan_utama')->nullable();
            $table->string('rps')->nullable();
            $table->string('opiat')->nullable();
            $table->string('amfetamin', 50)->nullable();
            $table->string('napza_lain', 50)->nullable();
            $table->string('pestisida', 50)->nullable();
            $table->string('makanan', 50)->nullable();
            $table->string('lain_lain', 50)->nullable();
            $table->string('perkiraan_jml', 50)->nullable();
            $table->string('tipe_kejadian')->nullable();
            $table->string('tipe_pemaparan')->nullable();
            $table->integer('l_p_menit')->nullable();
            $table->integer('l_p_jam')->nullable();
            $table->integer('l_p_hari')->nullable();
            $table->integer('wkt_menit')->nullable();
            $table->integer('wkt_jam')->nullable();
            $table->integer('wkt_hari')->nullable();
            $table->integer('kekerapan')->nullable();
            $table->integer('ket_pas_hamil')->nullable();
            $table->string('ket_pas_menyusui', 25)->nullable();
            $table->string('hamil')->nullable();

            $table->primary(['id_cetak_racun'], 'pk_gd_tc_cetak_racun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gd_tc_cetak_racun');
    }
};
