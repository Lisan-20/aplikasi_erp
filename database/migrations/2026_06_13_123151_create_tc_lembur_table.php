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
        Schema::create('tc_lembur', function (Blueprint $table) {
            $table->increments('id_hrtc_lembur');
            $table->bigInteger('npp')->nullable();
            $table->dateTime('tgl_lembur')->nullable();
            $table->string('kegiatan', 200)->nullable();
            $table->dateTime('jam_mulai_lembur')->nullable();
            $table->dateTime('jam_akhir_lembur')->nullable();
            $table->integer('jumlah_jam_lembur')->nullable();
            $table->decimal('jumlah_uang_makan', 19, 4)->nullable();
            $table->decimal('jumlah_uang_lembur', 19, 4)->nullable();
            $table->string('surat_perintah', 50)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('flag_gol_lembur')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->integer('flag')->nullable();
            $table->integer('no_urut_periodik')->nullable();
            $table->integer('flag_ver_ka_unit')->nullable();
            $table->dateTime('tgl_ver_ka_unit')->nullable();
            $table->integer('user_ver_ka_unit')->nullable();
            $table->string('ket_ka_unit', 250)->nullable();
            $table->integer('flag_ver_ka_bid')->nullable();
            $table->dateTime('tgl_ver_ka_bid')->nullable();
            $table->integer('user_ver_ka_bid')->nullable();
            $table->string('ket_ka_bid', 250)->nullable();
            $table->integer('flag_ver_wadir')->nullable();
            $table->dateTime('tgl_ver_wadir')->nullable();
            $table->integer('user_ver_wadir')->nullable();
            $table->string('ket_wadir', 250)->nullable();
            $table->dateTime('tgl_tolak')->nullable();
            $table->string('alasan_tolak', 250)->nullable();
            $table->integer('user_tolak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_lembur');
    }
};
