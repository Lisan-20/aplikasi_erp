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
        Schema::create('riwayat_kesehatan', function (Blueprint $table) {
            $table->integer('id_riwayat_kesehatan');
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->string('hasil', 50)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kode_grup_tindakan', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('id_mt_fisik_det', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('id_mt_saran', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kesehatan');
    }
};
