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
        if (Schema::hasTable('pm_tc_hasilpenunjang_temp')) {
            return;
        }

        Schema::create('pm_tc_hasilpenunjang_temp', function (Blueprint $table) {
            $table->increments('no');
            $table->integer('kode_trans_pelayanan')->nullable();
            $table->text('hasil')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('nama_tindakan', 250)->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->string('kode_penunjang', 50)->nullable();
            $table->text('standar_hasil_wanita')->nullable();
            $table->text('standar_hasil_pria')->nullable();
            $table->string('nama_pemeriksaan', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_tc_hasilpenunjang_temp');
    }
};
