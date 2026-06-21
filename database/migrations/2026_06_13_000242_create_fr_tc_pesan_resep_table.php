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
        if (Schema::hasTable('fr_tc_pesan_resep')) {
            return;
        }

        Schema::create('fr_tc_pesan_resep', function (Blueprint $table) {
            $table->integer('kode_pesan_resep');
            $table->string('kode_dokter', 10)->nullable();
            $table->string('kode_bagian', 20)->nullable();
            $table->dateTime('tgl_pesan')->nullable();
            $table->integer('status_tebus')->nullable();
            $table->integer('jumlah_r')->nullable();
            $table->string('lokasi_tebus', 20)->nullable();
            $table->string('keterangan', 20)->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_klas')->nullable();
            $table->integer('kode_profit')->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();

            $table->primary(['kode_pesan_resep'], 'pk__tc_pesan_resep__6251440d');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_tc_pesan_resep');
    }
};
