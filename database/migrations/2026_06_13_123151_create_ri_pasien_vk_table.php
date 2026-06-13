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
        Schema::create('ri_pasien_vk', function (Blueprint $table) {
            $table->increments('id_pasien_vk');
            $table->dateTime('tgl_masuk')->nullable();
            $table->string('nama_pasien', 200)->nullable();
            $table->string('no_mr', 10)->nullable();
            $table->integer('kode_ri')->nullable();
            $table->integer('no_registrasi')->nullable();
            $table->integer('no_kunjungan')->nullable();
            $table->string('kode_bagian_asal', 50)->nullable();
            $table->integer('kode_klas')->nullable();
            $table->string('no_kamar_vk_old', 10)->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->tinyInteger('flag_vk')->nullable()->default(0);
            $table->string('no_kamar_vk', 50)->nullable();

            $table->primary(['id_pasien_vk'], 'pk_ri_pasien_vk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_pasien_vk');
    }
};
