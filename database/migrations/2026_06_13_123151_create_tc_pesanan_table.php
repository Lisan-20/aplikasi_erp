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
        Schema::create('tc_pesanan', function (Blueprint $table) {
            $table->increments('id_tc_pesanan');
            $table->dateTime('tgl_pesanan')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('umur', 50)->nullable();
            $table->integer('no_poli')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->dateTime('jam_pesanan')->nullable();
            $table->integer('pagi_sore')->nullable()->default(0)->comment('1:pagi 08:00-12:00,2:sore:15:00-18:00;malam:18:00-21:00');
            $table->string('no_induk', 50)->nullable();
            $table->dateTime('input_tgl')->nullable();
            $table->string('kode_bagian', 40)->nullable();
            $table->string('ket_antrian')->nullable();

            $table->primary(['id_tc_pesanan'], 'id_tc_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pesanan');
    }
};
