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
        if (Schema::hasTable('dc_struktur_organisasi')) {
            return;
        }

        Schema::create('dc_struktur_organisasi', function (Blueprint $table) {
            $table->increments('id_dc_struktur_organisasi');
            $table->string('kode_level', 10)->nullable();
            $table->string('nama_struktur', 50)->nullable();
            $table->string('kode_level_org', 10)->nullable();
            $table->string('kode_level_ref', 10)->nullable();
            $table->integer('ko_wil')->nullable();
            $table->integer('jenis_struktur')->nullable();
            $table->integer('default_modul')->nullable();

            $table->primary(['id_dc_struktur_organisasi'], 'pk_dc_struktur_organisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_struktur_organisasi');
    }
};
