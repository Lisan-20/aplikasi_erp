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
        Schema::create('tc_cuti', function (Blueprint $table) {
            $table->increments('id_htc_cuti');
            $table->bigInteger('npp')->nullable();
            $table->integer('id_dd_jenis_cuti')->nullable();
            $table->dateTime('tgl_pengajuan')->nullable();
            $table->dateTime('tgl_izin')->nullable();
            $table->string('no_surat_izin', 50)->nullable();
            $table->dateTime('tgl_mulai_cuti')->nullable();
            $table->dateTime('tgl_akhir_cuti')->nullable();
            $table->integer('jumlah_hari')->nullable();
            $table->string('keterangan', 300)->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->integer('flag_ver')->nullable();
            $table->dateTime('tgl_ver')->nullable();
            $table->integer('user_ver')->nullable();
            $table->string('nama_file', 250)->nullable();
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
        Schema::dropIfExists('tc_cuti');
    }
};
