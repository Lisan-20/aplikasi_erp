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
        if (Schema::hasTable('vk_pesan_ri')) {
            return;
        }

        Schema::create('vk_pesan_ri', function (Blueprint $table) {
            $table->increments('id_pesan_vk');
            $table->dateTime('tanggal')->nullable();
            $table->string('no_mr', 8)->nullable();
            $table->string('kode_bagian', 18)->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('kode_ri')->nullable();
            $table->integer('kode_kelompok')->nullable();
            $table->integer('kode_perusahaan')->nullable();
            $table->string('kode_dokter', 10)->nullable();
            $table->integer('kode_ruangan')->nullable();
            $table->string('nama_pasien', 100)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->tinyInteger('flag')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vk_pesan_ri');
    }
};
