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
        Schema::create('th_tc_rencana_operasi', function (Blueprint $table) {
            $table->string('no_registrasi', 50)->nullable();
            $table->string('no_mr', 50)->nullable();
            $table->string('nama_pasien', 250)->nullable();
            $table->dateTime('tgl_rencana')->nullable();
            $table->string('jenis_op', 50)->nullable();
            $table->string('kode_booking', 50)->nullable();
            $table->integer('flag_kirim_th')->nullable();
            $table->integer('RowNum')->nullable();
            $table->integer('xx')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_tc_rencana_operasi');
    }
};
