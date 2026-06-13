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
        Schema::create('tc_pem2fisik_det', function (Blueprint $table) {
            $table->integer('kode_tc_pem2fisik_det');
            $table->string('kode_pemeriksaan', 50)->nullable();
            $table->string('no_kunjungan', 50)->nullable();
            $table->string('id_mt_fisik_det', 50)->nullable();
            $table->string('id_mt_saran', 50)->nullable();
            $table->string('kode_grup_tindakan', 50)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->string('id_mt_kesimpulan', 50)->nullable();
            $table->string('kode_tc_pem2fisik', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_pem2fisik_det');
    }
};
