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
        Schema::create('mt_acc_erm_bedah', function (Blueprint $table) {
            $table->increments('id_mt_kd');
            $table->string('kd_periksa', 8)->nullable();
            $table->string('kd_ref', 8)->nullable();
            $table->string('nama_pemeriksaan')->nullable();
            $table->integer('kd_lev')->nullable();
            $table->integer('kd_type')->nullable();
            $table->string('kd_utama', 2)->nullable();
            $table->string('kd_golongan', 2)->nullable();
            $table->string('kode_akun_detail', 2)->nullable();
            $table->text('ket')->nullable();
            $table->integer('value_2')->nullable();
            $table->string('value_3')->nullable();
            $table->integer('kd_kk')->nullable();
            $table->string('no_urut', 50)->nullable();
            $table->integer('id_pen4an')->nullable();
            $table->string('kd_periksa_awal', 8)->nullable();
            $table->string('kd_EWS', 8)->nullable();
            $table->integer('sekor')->nullable();
            $table->string('warna')->nullable();
            $table->integer('kode_rm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_acc_erm_bedah');
    }
};
