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
        Schema::create('tc_permintaan_rekanan', function (Blueprint $table) {
            $table->increments('id_tc_permintaan_rekanan');
            $table->string('nomor_permintaan', 50);
            $table->dateTime('tgl_permintaan')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_bagian_kirim', 12)->nullable();
            $table->tinyInteger('status_batal')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->integer('id_dd_user')->nullable();
            $table->string('nomor_pengiriman', 50)->nullable();
            $table->dateTime('tgl_pengiriman')->nullable();
            $table->string('yg_serah', 50)->nullable();
            $table->string('yg_terima', 50)->nullable();
            $table->dateTime('tgl_input_terima')->nullable();
            $table->integer('id_dd_user_terima')->nullable();
            $table->string('keterangan_kirim', 50)->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('status_kirim', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_permintaan_rekanan');
    }
};
