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
        Schema::create('lap_kunjungan_pm_tind_temp', function (Blueprint $table) {
            $table->integer('kode_tarif')->nullable();
            $table->integer('jmlTind')->nullable();
            $table->string('kode_bagian', 10)->nullable();
            $table->integer('tgl')->nullable();
            $table->integer('bln')->nullable();
            $table->integer('thn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lap_kunjungan_pm_tind_temp');
    }
};
