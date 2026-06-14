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
        if (Schema::hasTable('dc_wilayah_kerja')) {
            return;
        }

        Schema::create('dc_wilayah_kerja', function (Blueprint $table) {
            $table->increments('id_dc_wilayah_kerja');
            $table->integer('ko_wil')->unique('ix_dc_wilayah_kerja');
            $table->string('nawil_search', 8)->nullable();
            $table->string('nawil_kerja', 30)->nullable();
            $table->string('ket_wil_kerja', 50)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->integer('id_dc_kota')->nullable();
            $table->string('kota', 50)->nullable();
            $table->integer('id_dc_propinsi')->nullable();
            $table->string('propinsi', 50)->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('telpon', 30)->nullable();
            $table->string('fax', 30)->nullable();
            $table->string('keterangan', 50)->nullable();
            $table->string('nama_pimpinan', 50)->nullable();
            $table->string('NPWP', 20)->nullable();
            $table->string('pemotong_pajak', 50)->nullable();
            $table->string('alamat_KPJ', 50)->nullable();
            $table->string('kode_KLU', 20)->nullable();

            $table->primary(['id_dc_wilayah_kerja'], 'pk_dc_wilayah_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_wilayah_kerja');
    }
};
