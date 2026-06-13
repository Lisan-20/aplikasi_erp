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
        if (Schema::hasTable('tc_status_pegawai')) {
            return;
        }

        Schema::create('tc_status_pegawai', function (Blueprint $table) {
            $table->increments('id_tc_status_peg');
            $table->string('npp', 30)->nullable();
            $table->string('nama_pegawai', 50)->nullable();
            $table->integer('id_status')->nullable();
            $table->integer('input_id')->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->integer('status')->nullable();
            $table->dateTime('status_tgl')->nullable();
            $table->dateTime('berakhir_tgl')->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->dateTime('awal_tgl')->nullable();
            $table->integer('ko_wil')->nullable();
            $table->integer('kontrak_ke')->nullable();
            $table->text('ket_status')->nullable();
            $table->string('alasan', 250)->nullable();
            $table->integer('no_urut')->nullable();
            $table->text('catatan_kerja')->nullable();
            $table->string('ort_no_srt', 250)->nullable();
            $table->integer('ort_npp')->nullable();
            $table->dateTime('ort_tgl_terbit')->nullable();
            $table->string('sk_no_srt', 250)->nullable();
            $table->integer('sk_npp')->nullable();
            $table->dateTime('sk_tgl_terbit')->nullable();
            $table->string('sk_dir_no_srt', 250)->nullable();
            $table->integer('sk_dir_npp')->nullable();
            $table->dateTime('sk_dir_tgl_terbit')->nullable();
            $table->integer('id_dc_pendidikan_sk_dir')->nullable();
            $table->integer('id_dc_bd_keahlian_ort')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_status_pegawai');
    }
};
