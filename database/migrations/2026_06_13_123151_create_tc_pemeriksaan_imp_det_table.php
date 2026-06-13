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
        Schema::create('tc_pemeriksaan_imp_det', function (Blueprint $table) {
            $table->increments('kode_tc_periksa');
            $table->string('no_kunjungan', 50)->nullable()->index('ix_no_kunjungan');
            $table->string('no_registrasi', 50)->nullable()->index('ix_no_registrasi');
            $table->text('hasil')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('id_user')->nullable();
            $table->dateTime('tgl_jam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pemeriksaan_imp_det');
    }
};
