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
        if (Schema::hasTable('tc_kunjungan_terapi_detail')) {
            return;
        }

        Schema::create('tc_kunjungan_terapi_detail', function (Blueprint $table) {
            $table->increments('id_terapi_det');
            $table->integer('no_urut')->nullable();
            $table->dateTime('tgl_update')->nullable();
            $table->dateTime('tgl_hadir')->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('ttd')->nullable();
            $table->integer('id_terapi')->nullable();
            $table->dateTime('tgl_jadwal')->nullable();
            $table->dateTime('tgl_update_jadwal')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('kode_dokter')->nullable();
            $table->dateTime('tgl_entry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_kunjungan_terapi_detail');
    }
};
