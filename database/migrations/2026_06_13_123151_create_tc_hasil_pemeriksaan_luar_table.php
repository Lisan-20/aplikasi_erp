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
        if (Schema::hasTable('tc_hasil_pemeriksaan_luar')) {
            return;
        }

        Schema::create('tc_hasil_pemeriksaan_luar', function (Blueprint $table) {
            $table->increments('id_luar');
            $table->integer('no_kunjungan')->nullable();
            $table->string('kesimpulan', 250)->nullable();
            $table->string('nama_file', 250)->nullable();
            $table->string('no_registrasi', 50)->nullable();
            $table->string('kode_dokter', 50)->nullable();
            $table->string('anjuran', 250)->nullable();
            $table->integer('no_urut')->nullable();
            $table->integer('nomor_urut')->nullable();
            $table->char('ext', 10)->nullable();
            $table->string('kode_bagian', 50)->nullable();
            $table->dateTime('delete_at')->nullable();
            $table->integer('user_delete')->nullable();
            $table->integer('kode_rm')->nullable();
            $table->string('no_mr', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tc_hasil_pemeriksaan_luar');
    }
};
