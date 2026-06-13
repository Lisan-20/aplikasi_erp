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
        if (Schema::hasTable('tc_fee_dokter')) {
            return;
        }

        Schema::create('tc_fee_dokter', function (Blueprint $table) {
            $table->bigIncrements('id_tc_fee_dokter');
            $table->integer('kode_dr')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->string('seri_kuitansi', 2)->nullable();
            $table->integer('no_kuitansi')->nullable();
            $table->dateTime('tgl_kuitansi')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->integer('flag_sppu')->nullable();
            $table->integer('no_sppu')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('kode_tarif')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('nama_tindakan')->nullable();
            $table->integer('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_fee_dokter');
    }
};
